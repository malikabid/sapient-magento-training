<?php

namespace Asoft\BlogGraphql\Model\Resolver;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Asoft\Blog\Api\PostRepositoryInterface;

class Posts implements ResolverInterface
{

    private $searchCriteriaBuilder;
    private $filterBuilder;
    private $sortOrderBuilder;
    private $postRepository;


    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        PostRepositoryInterface $postRepository
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->postRepository = $postRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, ?array $value = null, ?array $args = null)
    {

        if (isset($args['filter']['id'])) {
            $idFilter = $args['filter']['id'];
            foreach ($idFilter as $condition => $value) {
                $filter = $this->filterBuilder
                    ->setField('entity_id')
                    ->setConditionType($condition)
                    ->setValue($value)
                    ->create();
                $this->searchCriteriaBuilder->addFilters([$filter]);
            }
        }

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $postCollection = $this->postRepository->getList($searchCriteria)->getItems();

        $posts = [];

        foreach ($postCollection as $post) {
            $posts[] = [
                'post_id' => $post->getPostId(),
                'name' => $post->getName(),
                'content' => $post->getContent()
            ];
        }

        return $posts;
    }
}
