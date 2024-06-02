<?php

namespace Asoft\Blog\Controller\Adminhtml\Post;

use Magento\Backend\Model\View\Result\ForwardFactory;

class NewAction extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Asoft_Blog::save';

    const PAGE_TITLE = 'Add New Blog';


    protected $resultForwardFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ForwardFactory $forwardFactory

    ) {
        $this->resultForwardFactory = $forwardFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
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
