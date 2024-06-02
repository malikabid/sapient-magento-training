<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Asoft\CustomAttributes\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Setup\CategorySetupFactory;


/**
 * Patch is mechanism, that allows to do atomic upgrade data changes
 */
class AddIngredientsToProduct implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;


    private $categorySetupFactory;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup, CategorySetupFactory $categorySetupFactory)
    {
        $this->categorySetupFactory = $categorySetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $catalogSetup =  $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);

        $catalogSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'ingredients');
        $catalogSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'ingredients',
            [
                'type' => 'varchar',
                'label' => "Ingredients",
                'visible_on_frontend' => 1,
                'user_defined' => 1,
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                'input' => 'multiselect',
                'source' => \Asoft\CustomAttributes\Model\Entity\Attribute\Source\Ingredients::class,
                'backend' => \Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend::class
            ]
        );

        $ATTRIBUTE_GROUP = 'General';
        $groupId = $catalogSetup->getAttributeGroupId(\Magento\Catalog\Model\Product::ENTITY,  4, $ATTRIBUTE_GROUP);
        $catalogSetup->addAttributeToGroup(
            \Magento\Catalog\Model\Product::ENTITY,
            4,
            $groupId,
            'ingredients',
            null
        );


        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
