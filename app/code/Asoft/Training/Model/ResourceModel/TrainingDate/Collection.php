<?php
namespace Asoft\Training\Model\ResourceModel\TrainingDate;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
	protected $_eventPrefix = 'asoft_training_training_date_collection';
	protected $_eventObject = 'training_date_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Asoft\Training\Model\TrainingDate', 'Asoft\Training\Model\ResourceModel\TrainingDate');
    }
}
