<?php

namespace Magefan\Faq\Block;

use Magefan\Faq\Model\FaqmodelFactory;
use Magefan\Faq\Model\FaqRepository;
use Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\View\Element\Template;

class Display extends \Magento\Framework\View\Element\Template
{
    private $collectionFactory;
    /**
     * @var FaqmodelFactory
     */
    private $faqFactory;
    /**
     * @var FaqRepository
     */
    private $faqRepository;
    private $filterBuilder;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Display constructor.
     *
     * @param Template\Context $context
     * @param FilterBuilder $filterBuilder
     * @param CollectionFactory $collectionFactory
     * @param FaqmodelFactory $faqFactory
     * @param FaqRepository $faqRepository
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FilterBuilder $filterBuilder,
        CollectionFactory $collectionFactory,
        FaqmodelFactory $faqFactory,
        FaqRepository $faqRepository,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->filterBuilder = $filterBuilder;
        $this->collectionFactory = $collectionFactory;
        $this->faqRepository = $faqRepository;
        $this->faqFactory = $faqFactory;
    }

    public function sayHello()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $searchCriteriaBuilder = $objectManager->create('Magento\Framework\Api\SearchCriteriaBuilder');
        $searchCriteria = $searchCriteriaBuilder->addFilter('status', '1', 'eq')->create();
        $faqs = $this->faqRepository->getList($searchCriteria);
        return $faqs->getItems();

        /**
            $collection = $this->collectionFactory->create();
            $collection->addFieldToFilter('status', 1);
            return $collection->getItems();
        */
    }
}
