<?php
class Alpine_IframeCreSecure_Block_Checkout_Multishipping_Overview extends Mage_Checkout_Block_Multishipping_Overview
{

    public function getPaymentHtml()
    {
      return $this->getChildHtml('payment_info');
    }

    public function getCheckoutType()
    {
      return '2';  // multishipping
    }
    
    public function getCreSecureDataAsJson()
    {
	  $_address = $this->getBillingAddress();
	
	  $_creSecureData = array();
	
	  $_creSecureData['name'] = $_address->getName();
      $_creSecureData['street1'] = $_address->getStreet1();
      $_creSecureData['street2'] = $_address->getStreet2();
	  $_creSecureData['city'] = $_address->getCity();
	  $_creSecureData['region'] = $_address->getRegionCode();
      $_creSecureData['postal_code'] = $_address->getPostcode();
	  $_creSecureData['country'] = $_address->getCountry();
	
	  $_creSecureData['total'] = $this->getTotal();
	
      return json_encode($_creSecureData);
    }

    public function getBackUrl()
    {
        return $this->getUrl('*/*/backtobilling');
    }
}
