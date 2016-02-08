<?php
$this->startSetup();

$table1 = new Varien_Db_Ddl_Table();

$table1->setName($this->getTable('ultimatenewmedia_social/likes'));

$table1->addColumn(
    'entity_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$table1->addColumn(
    'product_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'nullable'=> false
    )
);
$table1->addColumn(
    'ip_address',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array(
        'nullable' => false
    )
);
$table1->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false
    )
);

$table1->setOption('type', 'InnoDB');
$table1->setOption('charset', 'utf8');

$table2 = new Varien_Db_Ddl_Table();

$table2->setName($this->getTable('ultimatenewmedia_social/review'));

$table2->addColumn(
    'entity_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$table2->addColumn(
    'review_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'nullable'=> false
    )
);
$table2->addColumn(
    'ip_address',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array(
        'nullable' => false
    )
);
$table2->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false
    )
);

$table2->setOption('type', 'InnoDB');
$table2->setOption('charset', 'utf8');

$this->getConnection()->createTable($table1);
$this->getConnection()->createTable($table2);

$this->endSetup();