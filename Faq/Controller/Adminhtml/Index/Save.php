<?php
namespace Magefan\Faq\Controller\Adminhtml\Index;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magefan\Faq\Model\FaqmodelFactory;

class Save extends Action
{

    const ADMIN_RESOURCE = 'Index';

    protected $resultPageFactory;
    protected $faqmodelFactory;

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
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if($data)
        {
            try{
                $id = $data['id'];

                $contact = $this->faqmodelFactory->create()->load($id);

                $data = array_filter($data, function($value) {return $value !== ''; });

                $contact->setData($data);
                $contact->save();
                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/');
            }
            catch(Exception $e)
            {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $contact->getId()]);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
