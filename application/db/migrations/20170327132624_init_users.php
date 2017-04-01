<?php
use Phinx\Migration\AbstractMigration;

class InitUsers extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('users');
		$table->addColumn('email', 'string')
			->addColumn('status', 'enum', ['values'=>['P','N','D'],'default'=>'N'])
			->addColumn('isadmin', 'enum', ['values'=>['Y','N'],'default'=>'N'])
			->addColumn('password', 'char', ['length'=>128])
			->addColumn('name', 'string')
			->addColumn('firstname', 'string')
			->addColumn('lastname', 'string')
			->addColumn('middlename', 'string')
			->addColumn('created', 'datetime')
			->addColumn('modified', 'datetime')
			->addColumn('last_action', 'datetime',['null'=>true])
			->addIndex(['email'], ['unique' => true])
			->create();
		}
	}
