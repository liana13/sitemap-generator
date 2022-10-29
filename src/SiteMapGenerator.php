<?php
namespace Ltsat\App;
use Ltsat\App\Components\GenerateXML;
use Ltsat\App\Components\GenerateCSV;
use Ltsat\App\Components\GenerateJSON;

class SiteMapGenerator {
    /** @const string TYPE_XML */
    public const TYPE_XML = 'xml';
    /** @const string TYPE_CSV */
    public const TYPE_CSV = 'csv';
    /** @const string TYPE_JSON */
    public const TYPE_JSON = 'json';
    /**
     * array $links
     */
    protected $links;

    /**
     * string $filetype
     */
    protected $filetype;

    /**
     * string $filetype
     */
    protected $filepath;

    /**
     * SiteMapGenerator constructor.
     */
    public function __construct(array $links, string $filetype, string $filepath)
    {
        $this->links = $links;
        $this->filetype = $filetype;
        $this->filepath = $filepath;
    }

    public function handle()
    {
        $sitemap = $this->getInstance($this->filetype)->run($this->links);
        return $this->createFile($sitemap);
    }

    public function createFile(string $sm)
    {
        // code...
    }

    /**
     * get particular operation instance of implementation
     * @param string $filetype
     */
    public static function getInstance(string $filetype)
    {
        switch ($filetype) {
            case self::TYPE_XML:
                $className = GenerateXML;
                break;

            case self::TYPE_CSV:
                $className = GenerateCSV;
                break;

            case self::TYPE_JSON:
                $className = GenerateJSON;
                break;

            default:
                $className = GenerateXML;
                break;
        }

        $generator = new $className;
        return $generator;
    }
}
