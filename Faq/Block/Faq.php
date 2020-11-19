<?php

namespace Magefan\Faq\Block;

use Magefan\Faq\Api\Data\FaqInterface;
use Magefan\Faq\Model\FaqmodelFactory;
use Magefan\Faq\Model\FaqRepository;
use Magefan\Faq\Model\ResourceModel\Faqmodel;
use Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Element\Template;
use Psr\Log\LoggerInterface;

class Faq extends \Magento\Framework\View\Element\Template
{
    private $collectionFactory;
    /**
     * @var Faqmodel
     */
    private $faqmodel;
    /**
     * @var FaqmodelFactory
     */
    private $faqFactory;
    private $faqRepository;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Display constructor.
     *
     * @param ObjectManagerInterface $objectmanager
     * @param LoggerInterface $logger
     * @param FaqRepository $faqRepository
     * @param Faqmodel $faqmodel
     * @param FaqmodelFactory $faqFactory
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        ObjectManagerInterface $objectmanager,
        LoggerInterface $logger,
        FaqRepository $faqRepository,
        Faqmodel $faqmodel,
        FaqmodelFactory $faqFactory,
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->objectManager = $objectmanager;
        $this->collectionFactory = $collectionFactory;
        $this->faqRepository = $faqRepository;
        $this->faqmodel = $faqmodel;
        $this->faqFactory = $faqFactory;
        $this->logger = $logger;
    }

    /**
     * @return FaqInterface|string
     */
    public function getFaqItem()
    {
        try {
            return $this->faqRepository->getById($this->_request->getParam('id'));
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return "This id don`t exist, please try another id!";
        }
    }
}
