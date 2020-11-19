<?php

namespace Magefan\Faq\Block;

use Magefan\Faq\Model\FaqmodelFactory;
use Magefan\Faq\Model\FaqRepository;
use Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Api\SearchCriteriaBuilder;

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
     * @var SearchCriteriaBuilder
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
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FilterBuilder $filterBuilder,
        CollectionFactory $collectionFactory,
        FaqmodelFactory $faqFactory,
        FaqRepository $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->filterBuilder = $filterBuilder;
        $this->collectionFactory = $collectionFactory;
        $this->faqRepository = $faqRepository;
        $this->faqFactory = $faqFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function sayHello()
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('status', '1', 'eq')->create();
        $faqs = $this->faqRepository->getList($searchCriteria);
        return $faqs->getItems();

    }
}
