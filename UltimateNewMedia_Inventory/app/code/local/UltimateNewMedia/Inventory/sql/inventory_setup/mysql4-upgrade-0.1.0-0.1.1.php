<?php

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->removeAttribute('catalog_product', 'unm_inventory_threshold');
$setup->addAttribute('catalog_product', 'unm_inventory_threshold', array(
    'group' => 'General',
    'input' => 'text',
    'type' => 'int',
    'label' => 'Inventory Out of Stock Threshold',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'default_value' => '0',
    'user_defined' => true,
));

$installer->endSetup();
