<?php
namespace Magefan\Faq\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Result\PageFactory;
use Magefan\Faq\Model\FaqmodelFactory;
use Magefan\Faq\Model\FaqRepository;

class Save extends Action
{

    const ADMIN_RESOURCE = 'Magefan_Faq::magefan_faq';

    protected $resultPageFactory;
    protected $faqmodelFactory;
    /**
     * @var FaqRepository
     */
    private $faqRepository;
    /**
     * @var Http
     */
    private $request;

    public function __construct(
        Http $request,
        Context $context,
        PageFactory $resultPageFactory,
        FaqmodelFactory $faqmodelFactory,
        FaqRepository $faqRepository
    ) {
        $this->request = $request;
        $this->faqRepository = $faqRepository;
        $this->resultPageFactory = $resultPageFactory;
        $this->faqmodelFactory = $faqmodelFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                /**" $id = $this->getRequest()->getParam ( 'id' ); */
                 $id = (int)$this->getRequest()->getParam('id');
                try {
                    $contact = $this->faqRepository->getById($id);
                } catch (\Exception $e) {
                    $contact = $this->faqmodelFactory->create();
                }

                $data = array_filter($data, function ($value) {
                    return $value !== '';
                });

                $contact->setData($data);
                 /**  $contact->save(); */
                $this->faqRepository->save($contact);

                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id') ]);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
