<?php

use Phinx\Migration\AbstractMigration;

class InitCustomers extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('customers',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('name', 'string')
			->addColumn('director', 'integer', ['signed'=>false, 'null'=>true])
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}