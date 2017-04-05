<?php

use Phinx\Migration\AbstractMigration;

class InitCompanies extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('companies',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('status', 'enum', ['values'=>['O','C'],'default'=>'O'])
			->addColumn('published', 'enum', ['values'=>['P','N','D'],'default'=>'P'])
			->addColumn('name', 'string')
			->addColumn('director', 'integer', ['signed'=>false])
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addColumn('counter_users', 'integer', ['signed'=>false, 'default'=>0])
			->addForeignKey('director', 'users', 'id', array('delete'=> 'RESTRICT', 'update'=> 'RESTRICT'))
			->create();
		}
	}
