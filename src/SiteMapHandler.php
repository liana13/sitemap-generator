<?php

namespace Ltsat\SitemapGenerator;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Ltsat\SitemapGenerator\Abstracts\GenerateFormat;
use Ltsat\SitemapGenerator\Components\GenerateXML;
use Ltsat\SitemapGenerator\Components\GenerateCSV;
use Ltsat\SitemapGenerator\Components\GenerateJSON;
use Illuminate\Support\Facades\File;

class SiteMapHandler
{
    /** @const string TYPE_XML */
    public const TYPE_XML = 'xml';
    /** @const string TYPE_CSV */
    public const TYPE_CSV = 'csv';
    /** @const string TYPE_JSON */
    public const TYPE_JSON = 'json';
    /** @const string TYPE_DEFOULT */
    public const TYPE_DEFOULT = 'json';
    /**
     * @var array $links
     */
    protected $links;

    /**
     * @var string $filetype
     */
    protected $filetype;

    /**
     * @var string $filetype
     */
    protected $filepath;

    /**
     * Initialize the package
     * @param array $links
     * @param string|null $filetype
     * @param string $filepath
     */
    public function __construct(array $links, ?string $filetype, string $filepath)
    {
        $filetype = $filetype ?: self::TYPE_XML;
        $this->links = $links;
        $this->filetype = $filetype;
        $this->filepath = $filepath;
    }

    /**
     * @param string $filetype
     * @throws BindingResolutionException
     */
    public function handle(string $filetype = self::TYPE_XML): void
    {
        if (count($this->links) === 0) {
            throw new \RuntimeException("Error Processing Request", 1);
        }
        $sitemap = self::getInstance($filetype)->run($this->links);
        $this->createFile($sitemap, $filetype);
    }

    /**
     * Create new file
     * @param string $sm
     * @param string $filetype
     *
     * @return void
     */
    public function createFile(string $sm, string $filetype): void
    {
        File::ensureDirectoryExists($this->filepath);

        $filename = 'sitemap' . $this->filetype;

        $file = fopen($filename, 'wb') or die("Unable to open file!");
        fwrite($file, $sm);
        fclose($file);

        $file->move($this->filepath, $filename);
    }

    /**
     * get particular operation instance of implementation
     * @param string $filetype
     *
     * @return GenerateFormat
     * @throws BindingResolutionException
     */
    public static function getInstance(string $filetype): GenerateFormat
    {
        switch ($filetype) {

            case self::TYPE_CSV:
                $className = GenerateCSV::class;
                break;

            case self::TYPE_JSON:
                $className = GenerateJSON::class;
                break;

            default:
                $className = GenerateXML::class;
                break;
        }

        return app()->make($className);
    }

    /**
     * Get all available types for generating files
     *
     * @return array
     */
    public function availableTypes(): array
    {
        return [self::TYPE_XML, self::TYPE_CSV, self::TYPE_JSON];
    }

    /**
     * Set file type
     *
     * @return void
     */
    public function setGenerateType($type): void
    {
        $this->filetype = $type;
    }
}
