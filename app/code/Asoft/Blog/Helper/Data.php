<?php

namespace Asoft\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Filter\TranslitUrl;

class Data extends AbstractHelper
{
    private $_translitUrl;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        TranslitUrl $translitUrl
    ) {
        $this->_translitUrl = $translitUrl;
        return parent::__construct($context);
    }

    public function generateUrlKey($name)
    {
        return $this->_translitUrl->filter($name);
    }

    public function getBlogUrl($urlKey)
    {
        if (is_object($urlKey)) {
            $urlKey = $urlKey->getUrlKey();
        }

        /**
         * line with bugs $url = $this->getUrl('blog/', [$urlKey]); 
         * solution: replace , with . 
         * improvement: remove 'blog/'
         */

        $url = $this->getUrl($urlKey);
        $url = explode('?', $url);
        $url = $url[0];

        return rtrim($url, '/');
    }

    public function getUrl($route, $params = [])
    {
        return $this->_urlBuilder->getUrl($route, $params);
    }
}
