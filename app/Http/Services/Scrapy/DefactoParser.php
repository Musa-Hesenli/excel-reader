<?php

namespace App\Http\Services\Scrapy;

use Goutte\Client;
use Illuminate\Support\Facades\Log;

class DefactoParser extends Parser
{
    public function parse(): array
    {
        $client = new Client();
        $crawler = $client->request( 'GET', $this->product_url );

        $nameNode     = $crawler->filter( '.breadcrumb__container .breadcrumb__item.active' )->first();
        $nodeImage    = $crawler->filter( '.product-card__image-slider--container .swiper-wrapper .swiper-slide:first-child img' )->first();
        $nodePrice    = $crawler->filter( '.product-card__info div.product-card__price--new' )->first();
        $nodeOldPrice = $crawler->filter( '.product-card__info div.product-card__price--old' )->first();

        $productDetails = [
            'name'          => $nameNode->count() > 0 ? $nameNode->text() : '',
            'image'         => $nodeImage->count() > 0 ? 'https:' . $nodeImage->attr( 'data-src' ) : '',
            'current_price' => $nodePrice->count() > 0 ? $nodePrice->text() : '',
            'old_price'     => $nodeOldPrice->count() > 0 ? $nodeOldPrice->text() : ''
        ];

        if ( empty( $productDetails[ 'name' ] ) || empty( $productDetails[ 'current_price' ] ) )
        {
            return [
              'status'  => 'error',
              'message' => 'Product not found'
            ];
        }

        return [
            'data' => $productDetails,
            'status' => 'success'
        ];
    }
}
