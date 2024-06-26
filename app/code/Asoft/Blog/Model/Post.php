<?php

namespace Asoft\Blog\Model;

use Asoft\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;


class Post extends AbstractModel implements PostInterface
{
    private $_helper;

    const CACHE_TAG = 'asoft_blog_post';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'post';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Asoft\Blog\Helper\Data $helper,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_helper = $helper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Asoft\Blog\Model\ResourceModel\Post');
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getPostUrl()
    {
        return $this->_helper->getBlogUrl($this);
    }


    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getPostId(): int
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    public function setPostId(int $postId): void
    {
        $this->setData(self::ENTITY_ID, $postId);
    }

    public function setName(string $title): void
    {
        $this->setData(self::NAME, $title);
    }

    public function setContent(string $content): void
    {
        $this->setData(self::CONTENT, $content);
    }
}
