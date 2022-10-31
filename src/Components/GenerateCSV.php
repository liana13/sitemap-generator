<?php
namespace Ltsat\App\Components;

class GenerateCSV {
    /**
     * Run to create sitemap.
     *
     * @return string
     */
    public function run(array $links) : string
    {
        $sitemap = implode(';', array_keys($links[0])) . "\n";

        foreach ($links as $url) {
            $sitemap .= implode(';', array_values($url)) . "\n";
        }

        return $sitemap;
    }
}
