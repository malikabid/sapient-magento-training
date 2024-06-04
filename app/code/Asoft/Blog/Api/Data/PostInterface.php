<?php

namespace Asoft\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface PostInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const CONTENT = 'content';

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getPostId(): int;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getContent(): string;


    /**
     * Undocumented function
     *
     * @param integer $postId
     * @return void
     */
    public function setPostId(int $postId): void;

    /**
     * Undocumented function
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Undocumented function
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void;
}
