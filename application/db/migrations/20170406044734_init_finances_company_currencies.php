<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class InitFinancesCompanyCurrencies extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('fin_ccurrencies',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('currency', 'integer', ['signed'=>false,'limit' => MysqlAdapter::INT_SMALL])
			->addColumn('flags', 'string')
			->addColumn('balance', 'decimal', ['scale'=>2, 'precision'=>20])
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('currency', 'fin_currencies', 'id', array('delete'=> 'RESTRICT', 'update'=> 'CASCADE'))
			->create();
		}
	}
