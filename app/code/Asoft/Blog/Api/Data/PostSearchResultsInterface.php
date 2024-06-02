<?php

namespace Asoft\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get items.
     *
     * @return \Asoft\Blog\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set items.
     *
     * @param \Asoft\Blog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
