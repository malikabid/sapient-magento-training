<?php

namespace Asoft\Blog\Controller\Adminhtml\Post;

use Exception;
use Asoft\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class MassStatus extends \Magento\Backend\App\Action
{
    private $_filter;
    private $_postCollectionFactory;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        PostCollectionFactory $posCollectionFactory

    ) {

        $this->_filter = $filter;
        $this->_postCollectionFactory = $posCollectionFactory;
        return parent::__construct($context);
    }


    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_postCollectionFactory->create());
        $status = (int) $this->getRequest()->getParam('enabled');

        $postsUpdated = 0;

        foreach ($collection as $post) {
            try {
                $post->setEnabled($status)->save();
                $postsUpdated++;
            } catch (Exception $e) {
                $this->_getSession()->addException(
                    $e,
                    __('Something went wrong')
                );
            }
        }

        if ($postsUpdated) {
            $this->messageManager->addSuccessMessage(__('%1 record(s) udpated', $postsUpdated));
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
