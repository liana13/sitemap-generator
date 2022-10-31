<?php

namespace Ltsat\SitemapGenerator\Components;

use Ltsat\SitemapGenerator\Abstracts\GenerateFormat;

class GenerateXML extends GenerateFormat
{
    /**
     * Run to create sitemap.
     *
     * @param array $links
     * @return string
     */
    public function run(array $links): string
    {
        $sitemap = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        foreach ($links as $url) {
            $sitemap .= '<url>';
            foreach ($url as $key => $value) {
                $sitemap .= '<' . $key . '>';
                $sitemap .= $value;
                $sitemap .= '</' . $key . '>' . "\n";
            }

            $sitemap .= '</url>' . "\n";
        }

        $sitemap .= '</urlset>';

        return $sitemap;
    }
}
