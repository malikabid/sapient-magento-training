<?php

namespace Asoft\Blog\Controller\Adminhtml\Post;

use Exception;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Asoft\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    private $_filter;
    private $_postCollectionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        PostCollectionFactory $posCollectionFactory

    ) {

        $this->_filter = $filter;
        $this->_postCollectionFactory = $posCollectionFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_postCollectionFactory->create());

        try {
            $collection->walk('delete');
            $this->messageManager->addSuccessMessage(__('Posts have been deleted'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong..'));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        return $resultRedirect;
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
    }
}
