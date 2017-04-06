<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class InitFinancesAccounts extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('fin_accounts',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('currency', 'integer', ['signed'=>false,'limit' => MysqlAdapter::INT_SMALL])
			->addColumn('name', 'string', ['length'=>100])
			->addColumn('icon', 'string', ['length'=>10])
			->addColumn('balance', 'decimal', ['scale'=>2, 'precision'=>20, 'default'=>0])
			->addColumn('limit', 'decimal', ['scale'=>2, 'precision'=>20, 'default'=>0])
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('currency', 'fin_currencies', 'id', array('delete'=> 'RESTRICT', 'update'=> 'CASCADE'))
			->create();
		}
	}
