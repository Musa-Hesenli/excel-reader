<?php

namespace App\Http\Services\Scrapy;

class ParserWebsiteFactory
{
    public static function getParser( string $link ) : Parser
    {
        if ( preg_match( "/trendyol.com/", $link ) )
        {
            return new TrendyolParser( $link );
        }

        if ( preg_match( '/defacto.com/', $link ) )
        {
            return new DefactoParser($link);
        }

        if ( preg_match( '/hepsiburada.com/', $link ) )
        {
            return new HepsiBuradaParser($link);
        }

        return new UnsupportedWebsite( $link );
    }
}
