<?php

namespace Asoft\Blog\Api\Data;

use Asoft\Blog\Api\Data\PostInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultInterface extends SearchResultsInterface
{

    /**
     * Undocumented function
     *
     * @return \Asoft\Blog\Api\Data\PostInterface[]
     */
    public function getItems();
}
