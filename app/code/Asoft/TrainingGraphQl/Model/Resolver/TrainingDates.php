<?php

namespace Asoft\TrainingGraphQl\Model\Resolver;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Psr\Log\LoggerInterface;

class TrainingDates implements ResolverInterface
{
    protected $productRepository;
    protected $logger;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        LoggerInterface $logger
    ) {
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($value['entity_id'])) {
            $this->logger->error("Product ID is not available in the resolver context", ['context' => $value]);
            throw new \Exception("Product ID is not available in the resolver context");
        }

        $product = $this->productRepository->getById($value['entity_id']);
        $attributeCode = $field->getName();

        switch ($attributeCode) {
            case 'training_date_start':
                return $product->getExtensionAttributes()->getTrainingDateStart() ?? null;
            case 'training_date_end':
                return $product->getExtensionAttributes()->getTrainingDateEnd() ?? null;
            default:
                return null;
        }
    }
}
