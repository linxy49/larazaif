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

    private function _format(array $data)
    {
        $asks = $this->_lastest($this->_sort($data['asks']), 10, false);
        $bids = $this->_lastest($this->_sort($data['bids']), 10, true);
        $result['price'] = $data['price'];
        $result['asks'] = $asks;
        $result['bids'] = $bids;
        return $result;
    }

    /**
     *　ソート
     */
    private function _sort($array)
    {
        uasort($array, function ($a, $b) {
            if($a[0] == $b[0]) {
                return 0;
            }
            return ($a[0] > $b[0]) ? -1 : 1;
        });
        return $array;
    }

    /**
     * 最新の情報を取得する
     * @param $array
     * @param $length 件数
     * @param $type true:先頭 | false:末尾
     */
    private function _lastest($array, $length, $type)
    {
        if ($type) {
            return array_slice($array, 0, $length);
        } else {
            $count = count($array) - $length;
            return array_slice($array, $count, $length);
        }
    }
}
