<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ExcelConverterHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Services\ExcelFileConverter;
use App\Models\Tarif;

class TarifController extends Controller
{
    public function index()
    {
        return ResponseHelper::OK( Tarif::all() );
    }


    // This function will read data from Excel file and return it in array format
    public function process()
    {
        $data = ExcelFileConverter::convert( public_path( 'files/data.xlsx' ) );
        if ( isset( $data[ 'status' ] ) && ! $data[ 'status' ] )
        {
            return ResponseHelper::ERROR( $data[ 'message' ], 500 );
        }

        $beatifiedData = ExcelConverterHelper::formatData( $data[ 'data' ] );

        return ResponseHelper::OK( $beatifiedData );
    }
}
