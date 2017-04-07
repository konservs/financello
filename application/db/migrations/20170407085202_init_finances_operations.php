<?php

use Phinx\Migration\AbstractMigration;

class InitFinancesOperations extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('fin_operations',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'biginteger', ['signed'=>false, 'identity'=>true])
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('group', 'integer', ['signed'=>false])
			->addColumn('account', 'integer', ['signed'=>false])
			->addColumn('payee', 'integer', ['signed'=>false, 'null'=>true])
			->addColumn('category', 'integer', ['signed'=>false, 'null'=>true])
			->addColumn('project', 'integer', ['signed'=>false, 'null'=>true])
			->addColumn('peritem', 'decimal', ['scale'=>2, 'precision'=>20, 'default'=>0])
			->addColumn('items', 'decimal', ['scale'=>3, 'precision'=>10, 'default'=>0])
			->addColumn('itemtype', 'enum', ['values'=>['itm','m','m2','m3','kg'],'default'=>'itm'])
			->addColumn('amount', 'decimal', ['scale'=>2, 'precision'=>20, 'default'=>0])
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('group', 'fin_opgroups', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('account', 'fin_accounts', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('payee', 'fin_payee', 'id', array('delete'=> 'SET NULL', 'update'=> 'CASCADE'))
			->addForeignKey('category', 'fin_categories', 'id', array('delete'=> 'SET NULL', 'update'=> 'CASCADE'))
			->addForeignKey('project', 'projects', 'id', array('delete'=> 'SET NULL', 'update'=> 'CASCADE'))
			->create();
		}
	}
