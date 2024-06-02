<?php

namespace Asoft\Breadcrumb\Plugin;

use Magento\Catalog\Model\Product;

class WholesaleDiscountPrice
{
    public function aroundGetFinalPrice(
        Product $subject,
        callable $proceed,
        $qty = null
    ) {
        $originalPrice = $proceed($qty);

        $finalPrice = $originalPrice - ($originalPrice * 0.1);

        return $finalPrice;
    }
}
