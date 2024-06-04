<?php

namespace Asoft\Blog\Api;

use Asoft\Blog\Api\Data\PostInterface;
use Asoft\Blog\Api\Data\PostSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface PostRepositoryInterface
{
    /**
     * Get Post List function
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Get Post with given id
     *
     * @param integer $id
     * @return \Asoft\Blog\Api\Data\PostInterface
     */
    public function get(int $id): PostInterface;
}
