<?php

namespace Magefan\Faq\Controller\Index;

use Magefan\Faq\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;


class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    /**
     * @var ForwardFactory
     */
    private $_forwardFactory;
    /**
     * @var Data
     */
    private $_helper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magefan\Faq\Helper\Data $helper,
        \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_helper = $helper;
        $this->_forwardFactory = $forwardFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $moduleStatus = $this->_helper->getConfig();
        if ($moduleStatus){
            return $this->_pageFactory->create();

        }
        $resultForward = $this->_forwardFactory->create();
        $resultForward->setController('index');
        $resultForward->forward('defaultNoRoute');
        return $resultForward;
    }
}