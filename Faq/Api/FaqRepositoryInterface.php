<?php

namespace Magefan\Faq\Api;

use Magefan\Faq\Api\Data\FaqInterface;
use Magefan\Faq\Api\Data\FaqSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface FaqRepositoryInterface
{

    /**
     * Save faq
     *
     * @param  FaqInterface $faq
     * @return FaqInterface
     * @throws LocalizedException
     */
    public function save(Data\FaqInterface $faq);

    /**
     * Retrieve faq
     *
     * @param  int $faqId
     * @return FaqInterface
     * @throws LocalizedException
     */
    public function getById($faqId);

    /**
     * Retrieve faqs matching the specified criteria
     *
     * @param  SearchCriteriaInterface $searchCriteria
     * @return FaqSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete faq
     *
     * @param  FaqInterface $faq
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(Data\FaqInterface $faq);

    /**
     * Delete faq by ID
     *
     * @param  int $faqId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($faqId);
}
