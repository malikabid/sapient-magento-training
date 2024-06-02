<?php

namespace Asoft\Blog\Controller\Adminhtml\Post;

use Asoft\Blog\Model\Post;



class Save extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Asoft_Blog::save';
    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,

    ) {

        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $model = $this->_objectManager->create(Post::class);
            if (!$data['entity_id']) {
                unset($data['entity_id']);
            }
            $model->setData($data);
            $model->save();
        }

        $id = $model->getId();

        if ($id) {
            $this->messageManager->addSuccessMessage(__('Post was save successfully'));
        } else {
            $this->messageManager->addErrorMessage(__('Something went wrong save the post'));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);

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
