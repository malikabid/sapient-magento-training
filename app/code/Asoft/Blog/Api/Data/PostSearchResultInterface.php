<?php

namespace Asoft\Blog\Api\Data;

use Asoft\Blog\Api\Data\PostInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultInterface extends SearchResultsInterface
{

    public function getItems(): PostInterface;
}
