<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HTMLSanitizer
{
    protected $purifier;

    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $this->purifier = new HTMLPurifier($config);
    }

    public function sanitize($html)
    {
        return $this->purifier->purify($html);
    }
}
