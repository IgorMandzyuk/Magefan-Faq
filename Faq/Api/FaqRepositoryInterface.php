<?php

// app/code/[Vendor]/[Module]/Api/FaqRepositoryInterface.php

namespace Magefan\Faq\Api;

use Magefan\Faq\Api\Data\FaqInterface;
use Magefan\Faq\Api\Data\FaqSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqRepositoryInterface
{

    /**
     * Save faq
     *
     * @param FaqInterface $faq
     * @return FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\FaqInterface $faq);

    /**
     * Retrieve faq
     *
     * @param int $faqId
     * @return FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($faqId);

    /**
     * Retrieve faqs matching the specified criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return FaqSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete faq
     *
     * @param FaqInterface $faq
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\FaqInterface $faq);

    /**
     * Delete faq by ID
     *
     * @param int $faqId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId);
}