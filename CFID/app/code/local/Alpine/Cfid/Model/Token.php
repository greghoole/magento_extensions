<?php

class Alpine_Cfid_Model_Token extends Mage_Core_Model_Abstract
{
    public function getToken($code)
    {
	    try {
          $fields = array(
            'code' => trim($code)
            , 'client_id' => Mage::helper('cfid')->getCfidValue('cfid_section1/server_settings/cfid_client_id')
            , 'client_secret' => Mage::helper('cfid')->getCfidValue('cfid_section1/server_settings/cfid_client_secret')
            , 'redirect_uri' => Mage::helper('cfid')->getCfidValue('cfid_section1/serviceurls/cfid_url_redirect')
            , 'grant_type' => 'authorization_code'
          );
        
          $fieldsString = '';
          foreach($fields as $key=>$value) {
            $fieldsString .= $key.'='.$value.'&'; 
          }
          rtrim($fieldsString, '&');

          $fp = fsockopen("ssl://" . Mage::helper('cfid')->getCfidValue('cfid_section1/server_settings/cfid_base_url'), 443, $errno, $errstr, 15);

          $data = '';
          if (!$fp) {
            $data = ' error: '; // . $errno . ' ' . $errstr;
          } 
          else {
            $http  = "POST https://" . Mage::helper('cfid')->getCfidValue('cfid_section1/server_settings/cfid_base_url') . Mage::helper('cfid')->getCfidValue('cfid_section1/serviceurls/cfid_url_access_token') . " HTTP/1.0\r\n";
            $http .= "Host: " . $_SERVER['HTTP_HOST'] . "\r\n";
            $http .= "User-Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
            $http .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $http .= "Content-length: " . strlen($fieldsString) . "\r\n";
            $http .= "Connection: close\r\n\r\n";
            $http .= $fieldsString . "\r\n\r\n";

            fwrite($fp, $http);
            while (!feof($fp)) {
              $data .= fgets($fp, 4096);
            }
            fclose($fp);
          }
 
          if(!empty($data)){
            $pos = strpos($data,'access_token');
            if($pos !== FALSE){
              $pos = $pos - 2;
              $data = substr($data,$pos,strlen($data));
            }
          }
          return json_decode($data);
        }
        catch(Exception $e){
          Mage::getModel('cfid/log')->log($e->getMessage());
        }
    }
}
?>