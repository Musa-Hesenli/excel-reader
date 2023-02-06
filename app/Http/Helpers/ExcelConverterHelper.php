<?php

namespace App\Http\Helpers;

class ExcelConverterHelper
{
    /**
     * @param $data
     * @return array
     *
     * should make an array like this
     * [
     *      "zona"  => "Zona 1",
     *      "start" => 0,
     *      "end"   => 0.5,
     *      "price" => 11.425
     * ]
     */

    public static function formatData($data ) : array
    {
        $newData = [];
        $labels = $data[ 0 ];

        foreach ( $data as $key => $items )
        {
            $zone_id = rand(1, 20);
            if ( $key === 0 ) continue;
            foreach ( $items as $index => $single_price )
            {
                if ( $index === 0 || is_null( $items[ 0 ] ) ) continue; // bu sert yoxlayirki eger Zona1, Zona2 ... Zona9 bitdise daha kecmir novbeti rowa
                $newData[] = [
                    'zone'         => $items[ 0 ],
                    'from_weight'  => $index === 1 ? 0 : $labels[ $index - 1 ],
                    'to_weight'    => $labels[ $index ],
                    'price'        => is_numeric( $single_price ) ? $single_price : 0,
                    'zone_id'      => $zone_id
                ];
            }
        }

        return $newData;
    }
}
