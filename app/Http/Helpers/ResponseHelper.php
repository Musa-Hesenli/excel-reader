<?php

namespace App\Http\Helpers;

class ResponseHelper
{
    public static function OK( $data )
    {
        return response()->json( [
            'data'   => $data,
            'status' => true
        ], 200 );
    }

    public static function ERROR( $errorMessage, $statusCode = 400 )
    {
        return response()->json( [
            'error_msg'  => $errorMessage,
            'error_code' => $statusCode
        ], $statusCode );
    }
}
