<?php


namespace Magefan\Faq\ViewModel;

use Magento\Framework\View\Element\Template;

class Dummy implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    public function getTitle()
    {
        return 'Hello World';
    }
}
