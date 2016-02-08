<?php

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->removeAttribute('catalog_product', 'use_manufacturer_part_no');
$setup->addAttribute('catalog_product', 'use_manufacturer_part_no', array(
    'group' => 'General',
    'input' => 'select',
    'type' => 'int',
    'label' => 'Use Manufacturer Part No.',
    'source' => 'eav/entity_attribute_source_boolean',
    'backend' => 'eav/entity_attribute_backend_array',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'default_value' => '0'
));

$installer->endSetup();
