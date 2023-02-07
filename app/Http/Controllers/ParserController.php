<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\ParserRequest;
use App\Http\Services\Scrapy\ParserWebsiteFactory;
use Illuminate\Http\Request;


class ParserController extends Controller
{
    public function parseLink( ParserRequest $request )
    {
        $link = $request->post( 'link' );

        $parser = ParserWebsiteFactory::getParser( $link );
        $result = $parser->parse();

        if ( empty( $result ) )
        {
            return ResponseHelper::ERROR( 'Something went wrong' );
        }

        if ( $result[ 'status' ] === 'error' )
        {
            return ResponseHelper::ERROR( $result[ 'message' ] );
        }

        return ResponseHelper::OK( $result[ 'data' ] );
    }
}
