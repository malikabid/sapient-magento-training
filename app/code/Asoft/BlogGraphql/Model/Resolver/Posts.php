<?php

namespace Asoft\BlogGraphql\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Asoft\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class Posts implements ResolverInterface
{

    private $_postCollectionFactory;

    public function __construct(
        PostCollectionFactory $postCollectionFactory
    ) {
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, ?array $value = null, ?array $args = null)
    {

        $postCollection = $this->_postCollectionFactory->create();

        if (isset($args['id'])) {
            $postCollection->addFieldToFilter('entity_id', $args['id']);
        }
        $posts = [];
        foreach ($postCollection as $post) {
            $posts[] = [
                'post_id' => $post->getId(),
                'name' => $post->getName(),
                'content' => $post->getContent()
            ];
        }

        return $posts;
    }
}
