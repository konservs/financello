<?php
use Phinx\Migration\AbstractMigration;

class InitUsers extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('users',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('email', 'string')
			->addColumn('status', 'enum', ['values'=>['P','N','D'],'default'=>'N'])
			->addColumn('isadmin', 'enum', ['values'=>['Y','N'],'default'=>'N'])
			->addColumn('password', 'char', ['length'=>128])
			->addColumn('name', 'string')
			->addColumn('firstname', 'string')
			->addColumn('lastname', 'string')
			->addColumn('middlename', 'string')
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addColumn('last_action', 'datetime',['null'=>true])
			->addIndex(['email'], ['unique' => true])
			->create();
		}
	}
