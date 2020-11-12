<?php

namespace Magefan\Faq\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magefan\Faq\Model\FaqmodelFactory;

class Delete extends Action
{

    const ADMIN_RESOURCE = 'Index';

    protected $resultPageFactory;
    protected $faqmodelFactory;

    /**
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param FaqmodelFactory $faqmodelFactory
     */


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        FaqmodelFactory $faqmodelFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->faqmodelFactory = $faqmodelFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $contact = $this->faqmodelFactory->create()->load($id);

        if(!$contact)
        {
            $this->messageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }

        try{
            $contact->delete();
            $this->messageManager->addSuccess(__('Your question has been deleted !'));
        }
        catch(\Exception $e)
        {
            $this->messageManager->addError(__('Error while trying to delete question'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
