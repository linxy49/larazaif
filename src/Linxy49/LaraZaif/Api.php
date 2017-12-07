<?php

namespace Linxy49\LaraZaif;

/**
 * Bitflyer API consts class
 */
final class Api
{
    const ENDPOINT      = 'https://api.zaif.jp';

    /**
     * 現物公開API
     */
    /* 板情報 */
    const DEPTH         = '/api/1/depth/';
    /* 現在の終値 */
    const LASTPRICE     = '/api/1/last_price/';
    /* Ticker */
    const TICKER        = '/api/1/ticker/';
    /* 全ての取引履歴 */
    const TRADES        = '/api/1/trades/';
}
