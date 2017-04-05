<?php

use Phinx\Migration\AbstractMigration;

class InitCompaniesUsers extends AbstractMigration{
	/**
	 * Change Method.
	 */
	public function change(){
		$table = $this->table('companies_users',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'biginteger', ['signed'=>false,'identity'=>true])
			->addColumn('user', 'integer', ['signed'=>false])
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('access', 'string', ['length'=>4096])
			->addForeignKey('user', 'users', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
