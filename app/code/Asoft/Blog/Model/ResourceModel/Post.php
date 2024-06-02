<?php

namespace Asoft\Blog\Model\ResourceModel;

use Asoft\Blog\Helper\Data as BlogHelper;
use Magento\Framework\Model\AbstractModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    private $_helper;

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        BlogHelper $helper
    ) {
        $this->_helper = $helper;
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('blog_post', 'entity_id');
    }


    protected function _beforeSave(AbstractModel $object)
    {
        $object->setUrlKey($this->_helper->generateUrlKey($object->getName()));
        return $this;
    }
}
