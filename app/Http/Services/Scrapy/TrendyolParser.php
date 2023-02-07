<?php

namespace App\Http\Services\Scrapy;

use Goutte\Client;
use Illuminate\Support\Facades\Log;

class TrendyolParser extends Parser
{
    public function parse() : array
    {
        $client  = new Client();
        $crawler = $client->request( 'GET', $this->product_url );

        $nodeProductName  = $crawler->filter( '.container-right-content  .pr-new-br' )->first();
        $nodeCurrentPrice = $crawler->filter( '.container-right-content .product-price-container  .prc-dsc' )->first();
        $nodeOldPrice     = $crawler->filter( '.container-right-content .product-price-container  .prc-org' )->first();
        $nodeProductImg   = $crawler->filter( '.gallery-modal .gallery-modal-content img' )->first();

        if ( $nodeProductName->count() === 0 || $nodeProductImg->count() === 0 || $nodeCurrentPrice->count() === 0 )
        {
            return [
                'status'  => 'error',
                'message' => 'Product Not found'
            ];
        }

        return [
            'data'   => [
                'name'          => $nodeProductName->text(),
                'current_price' => $nodeCurrentPrice->text(),
                'old_price'     => $nodeOldPrice->count() > 0 ? $nodeOldPrice->text() : '',
                'image'         => $nodeProductImg->attr( 'src' )
            ],
            'status' => 'success'
        ];
    }

}
