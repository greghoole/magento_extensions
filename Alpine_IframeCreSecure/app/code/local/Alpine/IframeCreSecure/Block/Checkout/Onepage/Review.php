<?php
class Alpine_IframeCreSecure_Block_Checkout_Onepage_Review extends Mage_Checkout_Block_Onepage_Review
{
    public function getCheckoutType()
    {
      return '1';  // onepage
    }
}
