<?php

namespace Asoft\Blog\Model\Api;

use Asoft\Blog\Api\PostRepositoryInterface;
use Asoft\Blog\Api\Data\PostInterface;
use Asoft\Blog\Api\Data\PostSearchResultsInterfaceFactory;
use Asoft\Blog\Model\PostFactory;
use Asoft\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class PostRepository implements PostRepositoryInterface
{

    private $postFactory;
    private $postCollectionFactory;
    private $searchResultsFactory;
    private $collectionProcessor;


    public function __construct(
        PostFactory $postFactory,
        PostCollectionFactory $postCollectionFactory,
        PostSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        $collection = $this->postCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function get(int $id): PostInterface
    {
        $post = $this->postFactory->create()->load($id);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('The post with the "%1" ID doesn\'t exist.', $id));
        }
        return $post;
    }
}
