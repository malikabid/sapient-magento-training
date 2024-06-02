<?php

namespace Asoft\Breadcrumb\Plugin;

use Magento\Theme\Block\Html\Breadcrumbs;

class ModifyBreadcrumbs
{
    public function beforeAddCrumb(Breadcrumbs $subject, $crumbName, $crumbInfo)
    {
        $crumbInfo['label'] .= " Special";
        return [$crumbName, $crumbInfo];
    }
}
