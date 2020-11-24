<?php


namespace Magefan\Faq\Block\Adminhtml\Contact\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\UrlInterface;


class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(
        RequestInterface $request,
        Context $context,
        Registry $registry,
        UrlInterface $urlBuilder
    ) {
        parent::__construct($context,$registry);
        $this->request = $request;
        $this->urlBuilder = $urlBuilder;
    }

    public function getButtonData()
    {
        return [
            'label' => __('Delete Question'),
            'on_click' => 'deleteConfirm(\'' .
                __('Are you sure you want to delete this question ?') . '\', \'' . $this->getDeleteUrl() . '\')',
            'class' => 'delete',
            'sort_order' => 20
        ];
    }

    public function getDeleteUrl()
    {

        $id = $this->context->getRequest()->getParam('id');
        return $this->getUrl('*/*/delete', ['id' => $id]);

    }
}
