<?php

namespace Asoft\Blog\Controller\Adminhtml\Post;

use Asoft\Blog\Model\Post;
use Exception;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Asoft_Blog::delete';


    protected $postModel;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Post $postModel,

    ) {
        $this->postModel = $postModel;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $this->postModel->load($id);
                $this->postModel->delete();

                $this->messageManager->addSuccessMessage(__('The post is deleted successfully'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(__('something went wrong deleting the post'));
                $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        } else {
            $this->messageManager->addErrorMessage(_('Post not found'));
        }

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
