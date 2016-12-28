<?php

require_once 'Mage/Checkout/controllers/MultishippingController.php';

class Alpine_IframeCreSecure_Checkout_MultishippingController extends Mage_Checkout_MultishippingController
{

    public function overviewAction()
    {
        parent::overviewAction();
    }

    public function overviewPostAction()
    {
        parent::overviewPostAction();
    }

}

