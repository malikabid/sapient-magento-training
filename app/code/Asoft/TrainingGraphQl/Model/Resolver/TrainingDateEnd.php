<?php

namespace Asoft\TrainingGraphQl\Model\Resolver;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class TrainingDateEnd implements ResolverInterface
{
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        // $product = $this->productRepository->getById($value['id']);
        $product = $value['model'];
        $product =  $this->productRepository->getById($product->getId());
        $trainingDateEnd = $product->getExtensionAttributes()->getTrainingDateEnd();
        return $trainingDateEnd ?? null;
    }
}
