<?php

namespace Asoft\EventExample\Observer;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\RequestInterface;

class RequestLogger implements \Magento\Framework\Event\ObserverInterface
{
    private $_logger;
    private $_request;

    public function __construct(
        LoggerInterface $logger,
        RequestInterface $request
    ) {
        $this->_logger = $logger;
        $this->_request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->_logger->info(
            'Request URI: ' . $this->_request->getModuleName()
        );
    }
}
