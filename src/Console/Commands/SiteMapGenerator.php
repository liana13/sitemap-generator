<?php

namespace Ltsat\SitemapGenerator\Commands;

use Ltsat\SitemapGenerator\SiteMapHandler;

class SiteMapGenerator extends \Illuminate\Console\Command
{
    /**
     * The Class generator
     * @var SiteMapGenerator $generator
     */
    protected SiteMapGenerator $generator;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map:generate 
                           {type? : The type which file should generated}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate site map for given type[json,xml,csv],';

    /**
     * Create a new command instance.
     * @param array $links
     * @param null|string $filetype
     * @param string $filepath
     *
     * @return void
     */
    public function __construct(array $links, ?string $filetype, string $filepath)
    {
        parent::__construct();
        $this->generator = new SiteMapHandler($links, $filetype, $filepath);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //When generate file type give from console it should be set to the package
        //OtherWise It should be executed defaulty
        $this->ensureGenerateTypeDefined($this->argument('type'));
        //after that we should generate map file
        $this->generator->handle();
        return 0;
    }

    private function ensureGenerateTypeDefined($generateType)
    {
        $generateType = $generateType ?: SiteMapHandler::TYPE_DEFOULT;

        if (!in_array($generateType, $this->generator->availableTypes())) {
            exit('The type should be one of these types : ' . implode(" | ", $this->generator->availableTypes()));
        }
        $this->generator->setGenerateType($generateType);
    }
}