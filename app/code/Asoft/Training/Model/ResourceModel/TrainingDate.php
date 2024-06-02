<?php
namespace Asoft\Training\Model\ResourceModel;

class TrainingDate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('training_dates', 'entity_id');
    }
}
