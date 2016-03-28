<?php

class Alpine_Cfid_Model_User extends Mage_Core_Model_Abstract
{
    public function getUserData($token)
    {
        $data = null;
        try {
          if(!empty($token)){
            $data = file_get_contents(Mage::helper('cfid')->getCfidValue('cfid_section1/serviceurls/cfid_url_user_data') . '?access_token=' . $token);
            $data = json_decode($data);
            return $data;
          }
          else {
            throw new Exception('Access token required to obtain user details');
          }
        }
        catch(Exception $e){
          Mage::getModel('cfid/log')->log($e->getMessage());
        }
    }
}
?>