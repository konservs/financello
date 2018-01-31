<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CompaniesMainCurrency extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$this->table('companies')
			->addColumn('maincurrency', 'integer', ['signed'=>false, 'limit' => MysqlAdapter::INT_SMALL, 'null'=>true, 'default' => null])
			->addForeignKey('maincurrency', 'fin_currencies', 'id', array('delete'=> 'SET NULL', 'update'=> 'CASCADE'))
			->update();
		}
	}

