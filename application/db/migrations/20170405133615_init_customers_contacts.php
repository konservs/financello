<?php

use Phinx\Migration\AbstractMigration;

class InitCustomersContacts extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('customers_contacts',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('customer', 'integer', ['signed'=>false])
			->addColumn('firstname', 'string')
			->addColumn('lastname', 'string')
			->addColumn('middlename', 'string')
			->addColumn('comment', 'string')
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('customer', 'customers', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
