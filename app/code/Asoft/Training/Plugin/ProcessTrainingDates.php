<?php

namespace Asoft\Training\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\AlreadyExistsException;


use Asoft\Training\Model\TrainingDate;
use Asoft\Training\Model\TrainingDateFactory;
use Asoft\Training\Model\ResourceModel\TrainingDate as TrainingDateResourceModel;
use Asoft\Training\Model\ResourceModel\TrainingDate\CollectionFactory as TrainingDateCollectionFactory;

class ProcessTrainingDates
{

    /**  @var TrainingDateFactory  */
    private $_trainingDateFactory;

    /** @var TrainingDateCollectionFactory */
    private $_collectionFactory;

    /** @var TrainingDateResourceModel */
    private $_resourceModel;

    public function __construct(
        TrainingDateFactory $trainingDateFactory,
        TrainingDateCollectionFactory $collectionFactory,
        TrainingDateResourceModel $resourceModel,

    ) {
        $this->_trainingDateFactory = $trainingDateFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_resourceModel = $resourceModel;
    }

    public function afterGet(ProductRepositoryInterface $productRepositoryInterface, ProductInterface $product)
    {
        $trainingDatesModel = $this->getTrainingDatesByProduct($product);

        if ($trainingDatesModel === null) {
            return $product;
        }

        $extensionAttributes = $product->getExtensionAttributes();
        if (is_callable([$extensionAttributes, 'setTrainingDateStart'])) {
            $product->getExtensionAttributes()->setTrainingDateStart($trainingDatesModel->getTrainingDateStart());
        }

        if (is_callable([$extensionAttributes, 'setTrainingDateEnd'])) {
            $product->getExtensionAttributes()->setTrainingDateEnd($trainingDatesModel->getTrainingDateStart());
        }

        return $product;
    }

    public function afterGetById(ProductRepositoryInterface $productRepository, ProductInterface $product)
    {
        $trainingDatesModel = $this->getTrainingDatesByProduct($product);

        if ($trainingDatesModel === null) {
            return $product;
        }

        $extensionAttributes = $product->getExtensionAttributes();
        if (is_callable([$extensionAttributes, 'setTrainingDateStart'])) {
            $product->getExtensionAttributes()->setTrainingDateStart($trainingDatesModel->getTrainingDateStart());
        }

        if (is_callable([$extensionAttributes, 'setTrainingDateEnd'])) {
            $product->getExtensionAttributes()->setTrainingDateEnd($trainingDatesModel->getTrainingDateEnd());
        }

        return $product;
    }


    private function getTrainingDatesByProduct(ProductInterface $product): TrainingDate
    {
        $collection = $this->_collectionFactory->create();
        $collection->addFieldToFilter('product_id', $product->getId());

        /** @var TrainingDate $firstItem */
        $firstItem = $collection->getFirstItem();

        return $firstItem;
    }
}
