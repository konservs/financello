<?php

use Phinx\Migration\AbstractMigration;

class InitSessions extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('sessions',array('id' => false, 'primary_key' => array('sessionid')));
		$table->addColumn('sessionid', 'char', ['length'=>40])
			->addColumn('ipv4', 'integer', ['signed'=>false])
			->addColumn('start', 'datetime')
			->addColumn('end', 'datetime')
			->addColumn('updatestep', 'integer', ['signed'=>false])
			->addColumn('interval', 'integer', ['signed'=>false])
			->addColumn('lastaction', 'datetime')
			->addColumn('userid', 'integer', ['signed'=>false])
			->addColumn('data', 'string', ['length'=>128])
			->addForeignKey('userid', 'users', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
