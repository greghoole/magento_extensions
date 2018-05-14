<?php

class North_Inventory_Model_Catalog
{
    /**
     * Check that requested qty > available - threshold
     *
     * @return void
     */
    public function checkThresholdInventory()
    {
        $_params = Mage::app()->getRequest()->getParams();
        $_requestedQty = (int) $_params['qty'];
        $_product = Mage::getModel('catalog/product')->load($_params['product']);
        if($_product->getTypeId() == 'configurable'){
                $_product = Mage::getModel('catalog/product_type_configurable')->getProductByAttributes($_params['super_attribute'], $_product);
        }
        if($_product){
            $_availableQty = (int) Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getQty();
            if( $_requestedQty > ($_availableQty - $_product->getNorthInventoryThreshold()) ){
                Mage::getSingleton('core/session')->addError('The requested quantity is not available');
                Mage::app()->getResponse()->setRedirect($_SERVER['HTTP_REFERER']);
                Mage::app()->getResponse()->sendResponse();
                exit;
            }
        }
    }

    /**
     * Update the status of catalog items if their inventory is below the threshold
     * Run from shell script as a cronjob
     */
    public function cronInventoryCheck()
    {
        // get current store
        $storeId = Mage::app()->getStore()->getStoreId();
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('north_inventory_threshold')
            ->addAttributeToFilter(
                    'north_inventory_threshold',
                    array('neq' => '')
                );
            ;
        foreach($products as $_product){
            $_availableQty = (int) Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getQty();
            $_thresholdInventory = $_product->getNorthInventoryThreshold();
            if(!empty($_thresholdInventory)){
                if( $_availableQty <= $_thresholdInventory ){
                    echo "Product Id " . $_product->getId() . " Disabled\n";
                    Mage::getModel('catalog/product_status')->updateProductStatus($_product->getId(), $storeId, Mage_Catalog_Model_Product_Status::STATUS_DISABLED);
                }
                else {
                    Mage::getModel('catalog/product_status')->updateProductStatus($_product->getId(), $storeId, Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
                }
            }
            unset($_product);
        }
    }

    /**
     * Do a final check on inventory availability
     *
     * @return void
     */
    public function finalInventoryCheck()
    {
        // get cart
        $cart = Mage::getModel('checkout/cart')->getQuote();
        // get order items
        $orderItems = $cart->getAllItems();
        // get current store
        $storeId = Mage::app()->getStore()->getStoreId();

        foreach($orderItems as $item){
            $_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$item->getSku());
            $_product = Mage::getModel('catalog/product')->load($_product->getId());
            $_availableQty = (int) Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getQty();
            
            if($item->getQty() > ($_availableQty - $_product->getNorthInventoryThreshold()) ){
                Mage::getModel('catalog/product_status')->updateProductStatus($_product->getId(), $storeId, Mage_Catalog_Model_Product_Status::STATUS_DISABLED);
                Mage::getSingleton('checkout/session')->addError("Inventory no longer available for " . $_product->getName());
                Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('checkout/cart'))->sendResponse();
            }
        }
    }

    /**
     * Update the status of catalog items if their inventory is below the threshold
     *
     * @param Mage_Sales_Model_Order $order order object
     *
     * @return boolean
     */
    public function updateStatus($order)
    {
        // get order items
        $orderItems = $order->getAllItems();
        // get current store
        $storeId = Mage::app()->getStore()->getStoreId();
        
        foreach($orderItems as $item){

            $_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$item->getSku());
            $_product = Mage::getModel('catalog/product')->load($_product->getId());

            $_availableQty = (int) Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getQty();
            
            if($_availableQty <= $_product->getNorthInventoryThreshold()){
                Mage::getModel('catalog/product_status')->updateProductStatus($_product->getId(), $storeId, Mage_Catalog_Model_Product_Status::STATUS_DISABLED);
            }
        }
    }

}