<?php

namespace Asoft\Breadcrumb\Plugin;

use Magento\Theme\Block\Html\Footer;

class ModifyFooter
{
    public function afterGetCopyright(Footer $subject, $result)
    {
        return $result . "| Some Custom Footer";
    }
}
