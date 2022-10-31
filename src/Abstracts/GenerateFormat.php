<?php

namespace Ltsat\SitemapGenerator\Abstracts;

abstract class GenerateFormat
{
    /**
     * Run to create sitemap.
     * @param array $links
     * @return string
     */
    abstract public function run(array $links): string;
}