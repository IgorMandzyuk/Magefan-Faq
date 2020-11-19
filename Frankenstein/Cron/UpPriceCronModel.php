<?php

namespace Magefan\Frankenstein\Cron;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class UpPriceCronModel
{
    /**
     * @var CollectionFactory
     */
    private $productCollectionFactory;

    public function __construct(
        CollectionFactory $productCollectionFactory
    )
    {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    public function execute()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        foreach ($collection as $product) {
            $product->setPrice($product->getPrice() + 1);
            $product->save();
        }
    }
}
