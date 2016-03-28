<?php

class Alpine_Cfid_Helper_Data extends Mage_Core_Helper_Abstract 
{
    public function getCfidValue($xpath)
    {
        $value = Mage::getStoreConfig($xpath);
        return $value;
    }

    public function login($userData)
    {
        $userFound = false;
        $newUser = false;

        $customer = Mage::getModel('customer/customer')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
            ->loadByEmail($userData->email);

        if($customer->getId()){
          $customer->setEmail($userData->email);
          $customer->setCrossfitid($userData->cfid);
          $customer->setFirstname($userData->first);
          $customer->setLastname($userData->last);
          if($customer->save()){
            Mage::getModel('cfid/log')->log('Cross Fit Id - Updating Magento User by Email: ' . $customer->getEmail());
          }
          $userFound = true;
        }
        else {
          // check all users by crossfitid attribute
          $customer  = Mage::getResourceModel('customer/customer_collection')
              ->addAttributeToSelect('*')
              ->addAttributeToFilter('crossfitid', $userData->cfid)
              ->getFirstItem();

          if($customer->getId()){
            $customer->setEmail($userData->email);
            $customer->setCrossfitid($userData->cfid);
            $customer->setFirstname($userData->first);
            $customer->setLastname($userData->last);
            if($customer->save()){
              Mage::getModel('cfid/log')->log('Cross Fit Id - Updating Magento User by CFID: ' . $customer->getEmail());
            }
            $userFound = true;
          }

          if(!$userFound){
            $customer = Mage::getModel('customer/customer');
            $customer->setEmail($userData->email);
            $customer->setCrossfitid($userData->cfid);
            $customer->setFirstname($userData->first);
            $customer->setLastname($userData->last);
            if($customer->save()){
              Mage::getModel('cfid/log')->log('Cross Fit Id - Creating New Magento User: ' . $customer->getEmail());
              $userFound = true;
              $newUser = true;
            }
          }
        }

        if($customer->getId()){
          if($userData->level_1_trainer){
            $customer->setGroupId(Mage::helper('cfid')->getCfidValue('cfid_section1/integration/cfid_level_one_trainer'));
          }
          else {
            $customer->setGroupId(Mage::helper('cfid')->getCfidValue('cfid_section1/integration/cfid_default_group_id'));
          }
          $customer->save();

          Mage::getSingleton('customer/session')->loginById($customer->getId());
          return true;
        }

        return false;
    }
}

?>