<?php

namespace Magefan\Frankenstein\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\State;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class CustomerRestriction
 * @package Steven\Restriction\Observer
 */
class Restrictcmspage implements ObserverInterface
{
    /**
     * @var RedirectInterface
     */
    protected $redirect;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var State
     */
    protected $state;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * CustomerRestriction constructor.
     * @param Session $customerSession
     * @param RedirectInterface $redirect
     * @param State $state
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Session $customerSession,
        RedirectInterface $redirect,
        State $state,
        StoreManagerInterface $storeManager
    ) {
        $this->customerSession = $customerSession;
        $this->redirect = $redirect;
        $this->state = $state;
        $this->storeManager = $storeManager;
    }

    /**
     * @param Observer $observer
     * @return $this
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        if ($this->getArea() === 'frontend' && !$this->customerSession->getCustomerGroupId() ) {
            $controllerName = $observer->getEvent()->getRequest()->getControllerName();
            $controller = $observer->getControllerAction();

            if ($observer->getEvent()->getRequest()->getFullActionName() === 'cms_index_index') {
                return $this;
            }

            if ($observer->getEvent()->getRequest()->getOriginalPathInfo() === '/contact/') {
                return $this;
            }

            if ($controllerName === 'account' || $controllerName === 'section') {
                return $this;
            }

               $this->redirect->redirect($controller->getResponse(), '/');

        }
    }

    /**
     * @return mixed
     * @throws LocalizedException
     */
    private function getArea()
    {
        return $this->state->getAreaCode();
    }
}
