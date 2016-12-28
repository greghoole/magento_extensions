<?php

class Alpine_Cfid_Model_Log extends Mage_Core_Model_Abstract
{
    public function log($message)
    {
        if(Mage::helper('cfid')->getCfidValue('cfid_section1/advanced/cfid_debug')){
          Mage::log($message,null,'cfid.log');
        }
    }
}
?>