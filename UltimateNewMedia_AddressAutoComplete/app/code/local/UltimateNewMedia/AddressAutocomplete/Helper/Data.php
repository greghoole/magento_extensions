<?php

class UltimateNewMedia_AddressAutocomplete_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Check module has been enabled in the admin
     * @return bool
     */
    public function isModuleEnabledInAdmin()
    {
        return Mage::getStoreConfigFlag('autocomplete/general/enable');
    }
}