<?php

namespace Asoft\EventExample\Observer;

class PriceModifier implements \Magento\Framework\Event\ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $finalPrice = $observer->getEvent()->getQty();


        $newPrice = $product->getPrice() * 0.8;
        $product->setFinalPrice($newPrice);
    }
}
