<?php

namespace Asoft\Blog\Ui\DataProvider;

use Asoft\Blog\Model\PostFactory;
use Asoft\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;

class PostDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $dataPersistor;
    protected $loadedData;
    protected $postFactory;
    protected $request;


    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        PostCollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        PostFactory $postFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->postFactory = $postFactory;
        $this->request = $request;
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $postId = $this->request->getParam('id');

        if ($postId) {
            $post = $this->collection->getFirstItem();
            $this->loadedData[$post->getId()] = $post->getData();
        }

        $data = $this->dataPersistor->get('blog_post');

        if (!empty($data)) {
            $this->loadedData[$postId] = $post->getData();
        }

        return $this->loadedData;
    }
}
