<?php

namespace Magefan\Faq\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Faqmodel extends AbstractModel implements IdentityInterface, \Magefan\Faq\Api\Data\FaqInterface
{
    const CACHE_TAG = 'magefan_faq';

    protected function _construct()
    {
        $this->_init(\Magefan\Faq\Model\ResourceModel\Faqmodel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
