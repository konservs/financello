<?php

use Phinx\Migration\AbstractMigration;

class InitProjects extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$table = $this->table('projects',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'integer', ['signed'=>false, 'identity'=>true])
			->addColumn('parent', 'integer', ['signed'=>false, 'null'=>true])
			->addColumn('lft', 'integer')
			->addColumn('rgt', 'integer')
			->addColumn('level', 'integer')
			->addColumn('company', 'integer', ['signed'=>false])
			->addColumn('name', 'string', ['length'=>100])
			->addColumn('status', 'enum', ['values'=>['O','C'],'default'=>'C'])
			->addColumn('published', 'enum', ['values'=>['P','N','D'],'default'=>'P'])
			->addColumn('balance', 'decimal', ['scale'=>2, 'precision'=>20, 'default'=>0])
			->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
			->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
			->addForeignKey('company', 'companies', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('parent', 'projects', 'id', array('delete'=> 'SET NULL', 'update'=> 'CASCADE'))
			->create();
		}
	}
