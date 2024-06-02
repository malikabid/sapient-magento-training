<?php

namespace Asoft\CustomerMailer\Observer;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Translate\Inline\StateInterface;

class CustomMailer implements \Magento\Framework\Event\ObserverInterface
{
    protected $_transportBuilder;
    protected $_storeManager;
    protected $_inlineTranslation;

    public function __construct(
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation
    ) {
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        $this->_inlineTranslation = $inlineTranslation;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $store = $this->_storeManager->getStore();

        $this->_inlineTranslation->suspend();

        $transport = $this->_transportBuilder
            ->setTemplateIdentifier('custom_email_template')
            ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $store->getId()])
            ->setTemplateVars(['order' => $order])
            ->setFrom(['email' => 'sender@example.com', 'name' => 'Sender Emailer'])
            ->addTo(['receiver01@office.com', 'The Big boss'])
            ->getTransport();

        $transport->sendMessage();

        $this->_inlineTranslation->resume();
    }
}
