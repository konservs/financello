<?php
use Phinx\Seed\AbstractSeed;

class CurrenciesSeed extends AbstractSeed{
	/**
	 * Run Method.
	 */
	public function run(){
		$data = [[
			'code3'		=> 'AED',
			'name'		=> 'United Arab Emirates dirham',
			'symbol'	=> 'د.إ',		//
			'fractional'	=> 'Fils',
			'basic'		=> 100,			//How much cents in dollar
			'decimals'	=> 2			//Number of digits after the decimal separator.
			],[
			'code3'		=> 'UAH',
			'name'		=> 'Ukrainian hryvnia',
			'symbol'	=> '₴',
			'fractional'	=> 'Kopiyka',
			'basic'		=> 100,
			'decimals'	=> 2
			],[
			'code3'		=> 'RUB',
			'name'		=> 'Russian ruble',
			'symbol'	=> '₽',
			'fractional'	=> 'Kopek',
			'basic'		=> 100,
			'decimals'	=> 2
			]];
		$fin_currencies = $this->table('fin_currencies');
		$this->execute('SET FOREIGN_KEY_CHECKS=0');
		$fin_currencies->truncate();
		$fin_currencies->insert($data)->save();
		$this->execute('SET FOREIGN_KEY_CHECKS=1');
		}
	}
