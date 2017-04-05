<?php

use Phinx\Migration\AbstractMigration;

class InitCustomersContactsEmail extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('customers_contacts_email',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('contact', 'integer', ['signed'=>false])
			->addColumn('email', 'string')
			->addForeignKey('contact', 'customers_contacts', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
