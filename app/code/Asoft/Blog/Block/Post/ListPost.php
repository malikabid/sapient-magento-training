<?php

namespace Asoft\Blog\Block\Post;

use Asoft\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollection;

class ListPost extends \Magento\Framework\View\Element\Template
{

    private $_postCollection;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        PostCollection $postCollection,
        array $data = []
    ) {
        $this->_postCollection = $postCollection;
        parent::__construct($context, $data);
    }

    public function getPostList()
    {
        $posts = $this->_postCollection->create()->addFieldToFilter('enabled', 1);
        return $posts->getItems();
    }
}
