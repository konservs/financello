<?php
namespace Application\Finances;

use Brilliant\BSingleton;
use Brilliant\Items\BItemsList;

/**
 * Basic class to control companies
 *
 * @method CompanyCurrency itemGet(integer $id)
 * @method CompanyCurrency[] itemsGet(integer[] $ids)
 * @method CompanyCurrency[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class CompanyCurrencies extends BItemsList{
	use BSingleton;
	protected $tableName='fin_ccurrencies';
	protected $itemClassName='\Application\Finances\CompanyCurrency';

	/**
	 *
	 */
	public function itemsFilterSql($params,&$wh,&$jn){
		parent::itemsFilterSql($params,$wh,$jn);

		if(!empty($params['company'])){
			$wh[]='(`company` = '.(int)$params['company'].')';
			}
		}
	}
