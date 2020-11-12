<?php

namespace Magefan\Faq\Block;

use Magento\Framework\View\Element\Template;

class Faq extends \Magento\Framework\View\Element\Template
{
    private $collectionFactory;
    /**
     * @var \Magefan\Faq\Model\ResourceModel\Faqmodel
     */
    private $faqmodel;
    /**
     * @var \Magefan\Faq\Model\FaqmodelFactory
     */
    private $faqFactory;
    private $faqRepository;
    private $searchCriteriaBuilder;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param \Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magefan\Faq\Model\FaqRepository $faqRepository,
        \Magefan\Faq\Model\ResourceModel\Faqmodel $faqmodel,
        \Magefan\Faq\Model\FaqmodelFactory $faqFactory,
        Template\Context $context,
        \Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->faqRepository = $faqRepository;
        $this->faqmodel = $faqmodel;
        $this->faqFactory = $faqFactory;
        $this->logger = $logger;
    }

    public function getFaqItem()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $searchCriteriaBuilder = $objectManager->create('Magento\Framework\Api\SearchCriteriaBuilder');
        try {
            return $this->faqRepository->getById($this->_request->getParam('id'));
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }

      //  $faq = $this->faqFactory->create();
      //  $result = $this->faqmodel->load($faq, $this->_request->getParam('id'));
      //  var_dump($faq->debug());
      //  return $faq;
    }
}
