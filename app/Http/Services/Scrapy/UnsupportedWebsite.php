<?php

namespace App\Http\Services\Scrapy;

class UnsupportedWebsite extends Parser
{
    public function parse(): array
    {
        return [
            'message'   => "Unsupported website",
            'status'    => "error"
        ];
    }
}
