<?php


namespace Magefan\Faq\Controller\Index;

use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * @method norouteAction()
 */
class View extends \Magento\Framework\App\Action\Action
{
    protected $helper;
    protected $pageFactory;
    /**
     * @var ForwardFactory
     */
    private $_forwardFactory;
    /**
     * @var ForwardFactory
     */
    private $forwardFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magefan\Faq\Helper\Data $helper,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        ForwardFactory $forwardFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->helper = $helper;
        $this->forwardFactory = $forwardFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $moduleStatus = $this->helper->getConfig();
        if ($moduleStatus) {
            return $this->pageFactory->create();
        }
        $resultForward = $this->forwardFactory->create();
        $resultForward->setController('view');
        $resultForward->forward('defaultNoRoute');
        return $resultForward;
    }
}
