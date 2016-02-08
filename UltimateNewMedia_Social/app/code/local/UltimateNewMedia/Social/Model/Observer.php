<?php

class UltimateNewMedia_Social_Model_Observer
{

    /**
     * Send an email to site contact when review submitted
     *
     * @param Varien_Event_Observer $observer observer object
     *
     * @return boolean
     */
    public function sendReviewEmail(Varien_Event_Observer $observer)
    {
        try {
            $object = $observer->getEvent()->getObject();
            $data = $object->getData();
            
            $_product = Mage::getModel('catalog/product')->load($data['entity_pk_value']);
            $_storeId = Mage::app()->getStore()->getId();

            $emailTemplate  = Mage::getModel('core/email_template');
            $emailTemplate->loadDefault('ultimatenewmedia_social_emails_templates_new_review');
            $emailTemplate->setTemplateSubject('A New Review has been Submitted');

            $_sender = array(
                'name' => Mage::getStoreConfig('trans_email/ident_support/name', $_storeId),
                'email' => Mage::getStoreConfig('trans_email/ident_support/email', $_storeId)
            );
            $_recipient = array(
                'name' => Mage::getStoreConfig('trans_email/ident_support/name', $_storeId),
                'email' => Mage::getStoreConfig('trans_email/ident_support/email', $_storeId)
            );

            $emailTemplate->setSenderName($_sender['name']);
            $emailTemplate->setSenderEmail($_sender['email']);

            $_vars['product_name'] = $_product->getName();
            $_vars['product_url'] = $_product->getProductUrl();
            
            $emailTemplate->send($_recipient['email'], $_recipient['name'], $_vars);

        } catch (Exception $e) {
            Mage::logException($e);
            return false;
        }
    }

}