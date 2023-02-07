<?php

namespace App\Http\Services\Scrapy;

abstract class Parser
{
    protected string $product_url;

    abstract public function parse() : array;

    public function __construct( string $product_url )
    {
        $this->product_url = $product_url;
    }
}
