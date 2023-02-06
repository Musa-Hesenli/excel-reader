<?php

namespace Database\Seeders;

use App\Http\Helpers\ExcelConverterHelper;
use App\Http\Services\ExcelFileConverter;
use App\Models\Tarif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ExcelFileConverter::convert( public_path( 'files/data.xlsx' ) );
        if ( isset( $data[ 'status' ] ) && ! $data[ 'status' ] )
        {
            return;
        }

        Log::debug("bura girdim");

        $beatifiedData = ExcelConverterHelper::formatData( $data[ 'data' ] );
        if ( ! empty( $beatifiedData ) )
        {
            Tarif::truncate(); // DELETE ALL RESULTS FROM DB
            foreach ( $beatifiedData as $item )
            {
                $tarif = new Tarif();
                $tarif->zone_id     = $item[ 'zone_id' ];
                $tarif->zone_name   = $item[ 'zone' ];
                $tarif->price       = $item[ 'price' ];
                $tarif->from_weight = $item[ 'from_weight' ];
                $tarif->to_weight   = $item[ 'to_weight' ];
                $tarif->save();
            }
        }

    }
}
