<?php
namespace Magefan\PriceRound\Plugin;

class Product
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return round($result);
    }
}
