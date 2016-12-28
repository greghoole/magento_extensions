<?php
class Alpine_IframeCreSecure_Model_Checkout_Type
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label' => 'Onepage Checkout'),
            array('value' => 2, 'label' => 'Multiple Address Checkout'),
            array('value' => 3, 'label' => 'OneStepCheckout'),                         
        );
    }

}