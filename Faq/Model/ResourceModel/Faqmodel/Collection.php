<?php


namespace Magefan\Faq\Model\ResourceModel\Faqmodel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Magefan\Faq\Model\Faqmodel', 'Magefan\Faq\Model\ResourceModel\Faqmodel');
    }
}
