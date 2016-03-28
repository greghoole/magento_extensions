<?php

class Alpine_Cfid_IndexController extends Mage_Core_Controller_Front_Action 
{
	public function indexAction()
	{
       $code = $this->getRequest()->getParam('code','');
       $state = $this->getRequest()->getParam('state','');

       $data = null;
       $userData = null;

       // get access token using authorization code
       if($state == 'login_request' && !empty($code)){
         $data = Mage::getModel('cfid/token')->getToken($code);
       }  

       // get user data using access token
       if(!empty($data->access_token)){
         $userData = Mage::getModel('cfid/user')->getUserData($data->access_token);
       }

       // login/register user with Magento
       if(!empty($userData)){
         Mage::helper('cfid')->login($userData);
       }

       $this->loadLayout();
       $this->renderLayout();
	}
	
	public function accountAction()
	{
		$url = Mage::helper('cfid')->getCfidValue('cfid_section1/serviceurls/cfid_url_account');
		if(!empty($url)){
          $this->_redirectUrl($url);
		}
		else {
          Mage::getModel('cfid/log')->log('Edit Account information URL not set');
          $this->_redirectUrl(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB));
		}
	}
}
