<?php

namespace Magefan\Frankenstein\Cron;

class UpPriceCronModel
{
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productCollectionFactory = $objectManager->get(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory::class);
        $collection = $productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        foreach ($collection as $product) {
            $product->setPrice($product->getPrice() + 1);
            $product->save();
        }
    }
}
