<?php
class Alpine_IframeCreSecure_AjaxController extends Mage_Core_Controller_Front_Action
{   
    public function amountAction()
    {    
    	$debug = Mage::getStoreConfig('payment/iframecresecure/debug');
    	
        $result = array(
          'success' => false,
          'amount' => '0.00'
        );
        
        try {
          
          $quote = $this->_getCheckoutSession()->getQuote();
        
          $result = array(
            'success' => true,
            'amount' => number_format($quote->getData('grand_total'), 2, '.', '')
          );
          $quote->setIsActive(true);
        }
        catch (Exception $e){
          if($debug == 1){ Mage::log('Exception: ' . $e->getMessage()); }
        }
        echo json_encode($result);    
    }
    
    public function addressAction()
    {
      $debug = Mage::getStoreConfig('payment/iframecresecure/debug');
      
      $result = array(
        'success' => false,
        'username' => '',
        'address' => '',
        'address2' => '',
        'city' => '',
        'state_id' => '',
        'zip' => '',
        'country_id' => ''
      );
      
      $params = $this->getRequest()->getParams();
      try {
      	$address = Mage::getModel('customer/address')->load($params['id']);
      	$street = $address->getStreet();
      	$result = array(
      	  'success' => true,
          'firstname' => $address->getFirstname(),
      	  'lastname' => $address->getLastname(),
          'address' => $street[0],
          'address2' => $street[1],
          'city' => $address->getCity(),
          'state_id' => $address->getRegionId(),
          'zip' => $address->getPostcode(),
      	  'country_id' => $address->getCountryId(),
        );
      } 
      catch (Exception $e){
        if($debug == 1){ Mage::log('Exception: ' . $e->getMessage()); }
      }
      echo json_encode($result);
    }

    protected function _getCheckoutSession()
    {
        return Mage::getSingleton('checkout/session');
    }
}