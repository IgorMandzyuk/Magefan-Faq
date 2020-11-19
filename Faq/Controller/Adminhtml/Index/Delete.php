<?php

namespace Magefan\Faq\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
//use Magefan\Faq\Model\FaqmodelFactory;
use Magefan\Faq\Model\FaqRepository;

class Delete extends Action
{

    const ADMIN_RESOURCE = 'Magefan_Faq::magefan_faq';

    protected $resultPageFactory;
    protected $faqmodelFactory;
    /**
     * @var FaqRepository
     */
    private $faqRepository;
    private $faqRepitory;

    /**
     *
     * @param Context         $context
     * @param FaqRepository   $faqRepository
     * @param PageFactory     $resultPageFactory
     * @param FaqmodelFactory $faqmodelFactory
     */

    public function __construct(
        Context $context,
        FaqRepository $faqRepository,
        PageFactory $resultPageFactory
        //FaqmodelFactory $faqmodelFactory
    ) {
        $this->faqRepository = $faqRepository;
        $this->resultPageFactory = $resultPageFactory;
         //$this->faqmodelFactory = $faqmodelFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            //$id = $this->faqRepository->getById($this->_request->getParam('id'));
            $id = (int)$this->getRequest()->getParam('id');
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addError(__('This id don`t exist!'));
        }
        // $id = $this->getRequest()->getParam('id');
        $contact = $this->faqRepository->getById($id);
        //$contact = $this->faqRepository->create()->load("$id");

        if (!$contact) {
            $this->mesDeletesageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', ['_current' => true]);
        }

        try {
             $this->faqRepository->deleteById($id);
          /**  // $contact->delete(); */
            $this->messageManager->addSuccess(__('Your question has been deleted !'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete question'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['_current' => true]);
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', ['_current' => true]);
    }
}
