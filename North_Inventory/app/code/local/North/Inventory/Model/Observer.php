<?php

class North_Inventory_Model_Observer
{

    /**
     * Intercepts the checkout_cart_save_before event
     *
     * @param Varien_Event_Observer $observer observer object
     *
     * @return boolean
     */
    public function checkCheckoutCartSaveBefore(Varien_Event_Observer $observer)
    {
        Mage::getModel('north_inventory/catalog')->checkThresholdInventory();
    }

    /**
     * Intercepts the controller_action_predispatch_checkout_onepage_index event
     *
     * @param Varien_Event_Observer $observer observer object
     *
     * @return void
     */
    public function checkControllerActionPredispatchCheckoutOnepageIndex(Varien_Event_Observer $observer)
    {
        Mage::getModel('north_inventory/catalog')->finalInventoryCheck();
    }

    /**
     * Intercepts the sales_order_place_after event
     *
     * @param Varien_Event_Observer $observer observer object
     *
     * @return boolean
     */
    public function checkSalesOrderPlaceAfter(Varien_Event_Observer $observer)
    {
        // get order that was just created/submitted
        $order = $observer->getEvent()->getOrder();

        // call our functionality
        Mage::getModel('north_inventory/catalog')->updateStatus($order);

        return true;

    }

}