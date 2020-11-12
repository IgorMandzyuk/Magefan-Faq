<?php


namespace Magefan\Faq\Controller\Index;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * @method norouteAction()
 */
class View extends \Magento\Framework\App\Action\Action
{
    protected $_helper;
    protected $_pageFactory;
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    private $_forwardFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magefan\Faq\Helper\Data $helper,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory)
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
     $resultForward->setController('view');
     $resultForward->forward('defaultNoRoute');
     return $resultForward;
 }
}