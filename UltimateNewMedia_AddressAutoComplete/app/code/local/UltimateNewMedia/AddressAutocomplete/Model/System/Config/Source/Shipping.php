<?php

class UltimateNewMedia_AddressAutocomplete_Model_System_Config_Source_Shipping
{
    /**
     * Return list of potential shipping
     * address fields to use for autocomplete
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'shipping:street1', 'label' => Mage::helper('core')->__('Shipping Street Line 1')),
            array('value' => 'shipping:street2', 'label' => Mage::helper('core')->__('Shipping Street Line 2')),
            array('value' => 'shipping:city', 'label' => Mage::helper('core')->__('Shipping City')),
            array('value' => 'shipping:postcode', 'label' => Mage::helper('core')->__('Shipping Postcode')),
        );
    }
}