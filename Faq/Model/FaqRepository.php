<?php

namespace Magefan\Faq\Model;

use Magefan\Faq\Api\Data\FaqInterface;
use Magefan\Faq\Api\Data\FaqSearchResultsInterface;
use Magefan\Faq\Api\Data\FaqSearchResultsInterfaceFactory;
use Magefan\Faq\Api\FaqRepositoryInterface;
use Magefan\Faq\Model\ResourceModel\Faqmodel as ResourceFaq;
use Magefan\Faq\Model\ResourceModel\Faqmodel\CollectionFactory as FaqCollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class FaqRepository implements FaqRepositoryInterface
{

    /**
     * @var ResourceFaq
     */
    protected $resource;

    /**
     * @var FaqFactory
     */
    protected $faqFactory;

    /**
     * @var FaqCollectionFactory
     */
    protected $faqCollectionFactory;

    /**
     * @var FaqSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var FaqInterface[]
     */
    protected $instances = [];

    /**
     * @param ResourceFaq $resource
     * @param FaqFactory $faqFactory
     * @param FaqCollectionFactory $faqCollectionFactory
     * @param FaqSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceFaq $resource,
        FaqFactory $faqFactory,
        FaqCollectionFactory $faqCollectionFactory,
        FaqSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->faqFactory = $faqFactory;
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param  FaqInterface $faq
     * @return FaqInterface
     * @throws CouldNotSaveException
     */
    public function save(FaqInterface $faq)
    {
        try {
            $this->resource->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        unset($this->instances[$faq->getId()]);
        return $faq;
    }

    /**
     * @param  int $faqId
     * @return FaqInterface
     * @throws NoSuchEntityException
     */
    public function getById($faqId)
    {
        if (!isset($this->instances[$faqId])) {
            $faq = $this->faqFactory->create();
            $this->resource->load($faq, $faqId);
            if (!$faq->getId()) {
                throw new NoSuchEntityException(__('Faq with id "%1" does not exist.', $faqId));
            }
            $this->instances[$faqId] = $faq;
        }

        return $this->instances[$faqId];
    }

    /**
     * @param  SearchCriteriaInterface $searchCriteria
     * @return FaqSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->faqCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param  FaqInterface $faq
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(FaqInterface $faq)
    {
        try {
            $faqId = $faq->getId();
            $this->resource->delete($faq);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        unset($this->instances[$faqId]);
        return true;
    }

    /**
     * @param  int $faqId
     * @return bool true on success
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($faqId)
    {
        return $this->delete($this->getById($faqId));
    }
}
