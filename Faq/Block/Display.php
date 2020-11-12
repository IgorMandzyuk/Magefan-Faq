<?php

namespace Magefan\Faq\Block;

use Magento\Framework\View\Element\Template;

class Display extends \Magento\Framework\View\Element\Template
{
    private $collectionFactory;
    /**
     * @var \Magefan\Faq\Model\FaqmodelFactory
     */
    private $faqFactory;
    /**
     * @var \Magefan\Faq\Model\FaqRepository
     */
    private $faqRepository;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param \Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory $collectionFactory,
        \Magefan\Faq\Model\FaqmodelFactory $faqFactory,
        \Magefan\Faq\Model\FaqRepository $faqRepository,

        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->faqRepository = $faqRepository;
        $this->faqFactory = $faqFactory;
    }

    public function sayHello()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $searchCriteriaBuilder = $objectManager->create('Magento\Framework\Api\SearchCriteriaBuilder');
        $searchCriteria = $searchCriteriaBuilder->create();
        $faqs = $this->faqRepository->getList($searchCriteria);
        return $faqs->getItems();


        //$collection = $this->collectionFactory->create();
        //$collection->addFieldToFilter('status', 1);
        //return $collection->getItems();

    }

}
