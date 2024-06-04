<?php

namespace Asoft\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface PostInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const CONTENT = 'content';

    public function getPostId(): int;

    public function getName(): string;

    public function getContent(): string;
}
