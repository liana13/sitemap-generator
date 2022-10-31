<?php
namespace Ltsat\App\Components;

class GenerateJSON {
    /**
     * Run to create sitemap.
     *
     * @return string
     */
    public function run(array $links) : string
    {
        return json_encode($links);
    }
}
