<?php

namespace Asoft\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Asoft\Blog\Api\Data\PostInterface;
use Asoft\Blog\Api\Data\PostSearchResultsInterface;

/**
 * An interface for the REST WebAPI to get blog posts
 * @api
 */

interface PostRepositoryInterface
{
    /**
     * Get Post List
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Get Post with Id
     *
     * @param int $id
     * @return PostInterface
     */
    public function get(int $id): PostInterface;
}
