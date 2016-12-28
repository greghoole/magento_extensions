<?php
$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId = $setup->getEntityTypeId('customer');
$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$installer->addAttribute("customer", "complete_sf_form",  array(
    "type" => "int",
    "backend" => "",
    "label" => "Completed SalesForce Form",
    "input" => "select",
    "source" => "eav/entity_attribute_source_boolean",
    "visible" => 1,
    "required" => 0,
    "default" => "0",
    "user_defined" => 1,
));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "complete_sf_form");

$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'complete_sf_form',
    '999'  //sort_order
);

$used_in_forms = array();
$used_in_forms[] = "adminhtml_customer";

$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
;
$attribute->save();

$installer->endSetup();