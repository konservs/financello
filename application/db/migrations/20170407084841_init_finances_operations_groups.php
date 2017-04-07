<?php

use Phinx\Migration\AbstractMigration;

class InitFinancesOperationsGroups extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('fin_opgroups',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('type', 'enum', ['values'=>['C','E'],'default'=>'C'])
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('user', 'integer', ['signed'=>false])
			->addColumn('name', 'string', ['length'=>100])
			->addColumn('operations_cnt', 'integer', ['signed'=>false, 'default'=>0])
			->addColumn('operations_sum', 'decimal', ['scale'=>2, 'precision'=>20, 'default'=>0])
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('user', 'users', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
