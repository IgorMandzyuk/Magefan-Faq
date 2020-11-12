<?php
namespace Magefan\PriceRound\Plugin;

class Currency
{
    public function AfterConvert($subject, $proceed, $price, $toCurrency = null)
    {
        $price = $proceed($price, $toCurrency);
         $priceRound = round($price);
        return $priceRound;
    }
}
