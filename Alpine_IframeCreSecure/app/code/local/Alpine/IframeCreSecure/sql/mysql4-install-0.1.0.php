<?php
$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('iframe')};
CREATE TABLE IF NOT EXISTS {$this->getTable('iframe')} (
  `cresecure_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_start` int(11) NOT NULL,
  `transaction_end` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `cre_status` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `amount` decimal(12,4) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `card_type` varchar(10) NOT NULL,
  `exp_month` varchar(2) NOT NULL,
  `exp_year` varchar(4) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `approval_code` varchar(255) NOT NULL,
  `processed` tinyint(1) NOT NULL,
  PRIMARY KEY (`cresecure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

");

$installer->endSetup(); 