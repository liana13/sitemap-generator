<?php

namespace Ltsat\SitemapGenerator\Components;

use Ltsat\SitemapGenerator\Abstracts\GenerateFormat;

class GenerateCSV extends GenerateFormat
{
    /**
     * Run to create sitemap.
     *
     * @param array $links
     * @return string
     */
    public function run(array $links): string
    {
        $sitemap = implode(';', array_keys($links[0])) . "\n";

        foreach ($links as $url) {
            $sitemap .= implode(';', array_values($url)) . "\n";
        }

        return $sitemap;
    }
}
