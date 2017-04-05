<?php

use Phinx\Migration\AbstractMigration;

class InitCustomersContactsPhones extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('customers_contacts_phones',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('contact', 'integer', ['signed'=>false])
			->addColumn('phone', 'string', ['length'=>20])
			->addForeignKey('contact', 'customers_contacts', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
