<?php

namespace Ltsat\SitemapGenerator\Facade;

use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Facade;

class SiteMap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'siteMap';
    }
}