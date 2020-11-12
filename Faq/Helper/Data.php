<?php

namespace Magefan\Faq\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    protected $storeManager;
    protected $objectManager;

    const XML_PATH_FAQ = 'faq/group_id/field_id';
    /**
     * @var \Magento\Framework\App\Response\Http
     */
    private $_response;
    /**
     * @var \Magento\Framework\UrlFactory
     */

    /**
     * @var \Magento\Framework\App\Action\Context
     */
    private $context;
    private  $response;
    private  $redirect;
    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $url;
    private $resultForwardFactory;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->context = $context;
        $this->response = $context->getResponse();
        $this->redirect = $context->getRedirect();
        $this->url = $url;
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfig()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_FAQ, $storeScope);
    }
}