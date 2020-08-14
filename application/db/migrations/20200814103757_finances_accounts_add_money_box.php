<?php

use Phinx\Migration\AbstractMigration;

class FinancesAccountsAddMoneyBox extends AbstractMigration{
	/**
	 *
	 */
	public function change(){
		$this->table('fin_accounts')
			->addColumn('moneybox', 'enum', ['values'=>['N','T','D','W','M'],'default'=>'N','comment'=>'No, Transaction, Day, Week, Month'])
			->addColumn('moneybox_round', 'integer', ['signed'=>false])
			->addColumn('moneybox_account', 'integer', ['signed'=>false, 'null'=>true])
			->addForeignKey('moneybox_account', 'fin_accounts', 'id', ['delete'=> 'SET NULL', 'update'=> 'CASCADE'])
			->update();
		}
	}
