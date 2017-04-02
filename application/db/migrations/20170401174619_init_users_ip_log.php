<?php

use Phinx\Migration\AbstractMigration;

class InitUsersIpLog extends AbstractMigration{
	/**
	 * Change Method.
	 */
	public function change(){
		$table = $this->table('users_iplog',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'biginteger', ['signed'=>false,'identity'=>true])
			->addColumn('user', 'integer', ['signed'=>false])
			->addColumn('dt', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('IPv4', 'integer', ['signed'=>false])
			->addColumn('UserAgent', 'string')
			->addForeignKey('user', 'users', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
