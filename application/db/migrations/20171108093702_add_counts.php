<?php

use Phinx\Migration\AbstractMigration;

class AddCounts extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$this->table('companies')
			->addColumn('count_users', 'integer', ['signed'=>true, 'default' => 0])
			->addColumn('count_customers', 'integer', ['signed'=>true, 'default' => 0])
			->addColumn('count_projects', 'integer', ['signed'=>true, 'default' => 0])
			->update();
		}
	}
