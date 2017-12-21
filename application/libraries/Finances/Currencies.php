<?php
namespace Application\Finances;

/**
 * Basic class to control companies
 *
 * @method \Application\Finances\Currency itemGet(integer $id)
 * @method \Application\Finances\Currency[] itemsGet(integer[] $ids)
 * @method \Application\Finances\Currency[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Currencies extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='fin_currencies';
	protected $itemClassName='\Application\Finances\Currency';

	/**
	 *
	 */
	public function itemsFilterSql($params,&$wh,&$jn){
		parent::itemsFilterSql($params,$wh,$jn);
		$db=\Brilliant\BFactory::getDBO();
		if(!empty($params['code3'])){
			$wh[]='(`code3` = '.$db->escapeString($params['code3']).')';
			}
		if (!empty($params['keyword'])) {
			$keyword = mb_strtolower($params['keyword'], 'UTF-8');
			$keyword = trim($keyword);
			$keyword = str_replace('’', '_', $keyword);
			$keyword = str_replace('\'', '_', $keyword);
			$wh[] = '((lower(`name`) like ' . $db->escapeString('%' . $keyword . '%') . ') OR (lower(`code3`) like ' . $db->escapeString('%' . $keyword . '%') . '))';
			}
		}
	}
