<?php

namespace Magefan\Faq\Block;

use Magento\Framework\View\Element\Template;

class Display extends \Magento\Framework\View\Element\Template
{
    private $collectionFactory;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param \Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory $collectionFactory,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    public function sayHello()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('status', 1);
        return $collection->getItems();

    }

}
