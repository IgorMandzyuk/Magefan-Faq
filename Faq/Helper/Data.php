<?php

namespace Magefan\Faq\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Response\Http;
use Magento\Framework\UrlFactory;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    protected $storeManager;
    protected $objectManager;

    const XML_PATH_FAQ = 'faq/general/active';
    /**
     * @var Http
     */
    private $_response;
    /**
     * @var UrlFactory
     */

    /**
     * @var \Magento\Framework\App\Action\Context
     */
    private $context;
    private $response;
    private $redirect;
    /**
     * @var UrlInterface
     */
    private $url;
    private $resultForwardFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        UrlInterface $url,
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
