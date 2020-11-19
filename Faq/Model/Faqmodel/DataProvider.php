<?php


namespace Magefan\Faq\Model\Faqmodel;

use Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $collection;
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $faqCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $faqCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $contact) {
            $this->loadedData[$contact->getId()] = $contact->getData();
        }

        return $this->loadedData;
    }
}
