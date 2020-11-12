<?php

namespace Magefan\Frankenstein\Plugin;



class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{

    function afterToHtml(\Magento\Catalog\Pricing\Render\FinalPriceBox $subject, $result)
    {
        if ($this->getCustomer()->getGroupId() == 2) {
            return $result;
        } else {
            return '';
        }
    }

}