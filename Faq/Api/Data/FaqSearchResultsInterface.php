<?php

namespace Magefan\Faq\Api\Data;


use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface FaqSearchResultsInterface
 * @package Magefan\Faq\Api\Data
 * @api
 */
interface FaqSearchResultsInterface extends SearchResultsInterface
{

    /**
     * @return \Magefan\Faq\Api\Data\FaqInterface[]
     */
    public function getItems();

    /**
     * @param \Magefan\Faq\Api\Data\FaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}