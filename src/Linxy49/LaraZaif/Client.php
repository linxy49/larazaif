<?php

namespace Linxy49\LaraZaif;

use GuzzleHttp\Client as Guzclient;
use Linxy49\LaraZaif\Api;

class Client
{
    protected $_client;

    function __construct($client = null)
    {
        $this->_client = is_null($client)
            ? new Guzclient(['base_uri' => Api::ENDPOINT]) : $client;
    }

    public function getBoard($product_code = 'btc_jpy')
    {
        $response = $this->_client->get(Api::DEPTH . $product_code, []);
        $json = $response->getBody()->getContents();
        $depth = json_decode($json, true);

        $response = $this->_client->get(Api::LASTPRICE . $product_code, []);
        $json = $response->getBody()->getContents();
        $last_price = json_decode($json, true);

        $data['price'] = $last_price['last_price'];
        $data['asks'] = $depth['asks'];
        $data['bids'] = $depth['bids'];
        return $data;
    }
}
