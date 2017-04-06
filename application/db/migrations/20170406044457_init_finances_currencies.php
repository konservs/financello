<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class InitFinancesCurrencies extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('fin_currencies',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true,'limit' => MysqlAdapter::INT_SMALL])
			->addColumn('code3', 'char', ['length'=>3])
			->create();
		}
	}
