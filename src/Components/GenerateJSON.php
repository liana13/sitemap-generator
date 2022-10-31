<?php

namespace Ltsat\SitemapGenerator\Components;

use JsonException;
use Ltsat\SitemapGenerator\Abstracts\GenerateFormat;

class GenerateJSON extends GenerateFormat
{
    /**
     * Run to create sitemap.
     *
     * @param array $links
     * @return string
     * @throws JsonException
     */
    public function run(array $links): string
    {
        return json_encode($links, JSON_THROW_ON_ERROR);
    }
}
