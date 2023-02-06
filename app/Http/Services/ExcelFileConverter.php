<?php

namespace App\Http\Services;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExcelFileConverter
{
    public static function convert( string $file_path ) : array
    {
        try
        {
            $reader      = new Xlsx();
            $spreadsheet = $reader->load( $file_path );
            $sheetData   = $spreadsheet->getActiveSheet()->toArray();

            $result      = [
                'status' => true,
                'data'   => $sheetData,
            ];
        } catch ( \Exception $e )
        {
            $result = [
              'status'  => false,
              'data'    => [],
              'message' => $e->getMessage()
            ];
        }

        return $result;
    }
}
