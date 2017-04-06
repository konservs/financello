<?php

use Phinx\Migration\AbstractMigration;

class InitProjectsContacts extends AbstractMigration{
	/**
	 * Change Method.
	 */
	public function change(){
		$table = $this->table('projects_contacts',array('id' => false, 'primary_key' => array('id')));
		$table->addColumn('id', 'biginteger', ['signed'=>false,'identity'=>true])
			->addColumn('project', 'integer', ['signed'=>false])
			->addColumn('contact', 'integer', ['signed'=>false])
			->addForeignKey('project', 'projects', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addForeignKey('contact', 'customers_contacts', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->create();
		}
	}
