<?php

namespace Magefan\Frankenstein\Plugin;

class Product
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        if ($this->getCustomer()->getGroupId() == 2) {
            return $result;
        } else {
            return '';
        }
    }
}
