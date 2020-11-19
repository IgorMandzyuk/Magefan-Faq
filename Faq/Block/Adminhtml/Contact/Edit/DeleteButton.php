<?php


namespace Magefan\Faq\Block\Adminhtml\Contact\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\UrlInterface;
class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    public function __construct(
        Context $context,
        Registry $registry,
        UrlInterface $urlBuilder
    ) {
        parent::__construct($context,$registry);
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
        $url = $this->urlBuilder->getCurrentUrl();

        $parts = explode('/', parse_url($url, PHP_URL_PATH));

        $id = $parts[8];

        return $this->getUrl('*/*/delete', ['id' => $id]);
    }
}
