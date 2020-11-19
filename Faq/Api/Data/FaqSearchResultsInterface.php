<?php

namespace Magefan\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface FaqSearchResultsInterface extends SearchResultsInterface
{

    /**
     * @return FaqInterface[]
     */
    public function getItems();

    /**
     * @param  FaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
