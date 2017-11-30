<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CurrenciesAddFields extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$this->table('fin_currencies')
			->addColumn('name', 'char', ['length'=>50])
			->addColumn('fractional', 'char', ['length'=>20])
			->addColumn('symbol', 'char', ['length'=>5])
			->addColumn('basic', 'integer', ['signed'=>false, 'default' => 100, 'limit' => MysqlAdapter::INT_TINY])
			->addColumn('decimals', 'integer', ['signed'=>false, 'default' => 2, 'limit' => MysqlAdapter::INT_TINY])
			->addIndex(['code3'], ['unique' => true])
			->update();
		}
	}
