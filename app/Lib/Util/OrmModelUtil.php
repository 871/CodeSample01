<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrmModelUtil
 *
 * @author hanai
 */
class OrmModelUtil {
	
	public static function rowDataLock(AppOrmModel $ormModel, $primaryId) {
		$ormModel->rowDataLock($primaryId);
	}

	public static function transactionSave(AppOrmModel $ormModel, array $data = null) {
		if (! $ormModel->save($data)) {
			throw new ErrorException($ormModel->alias . ' Save Error');
		}
	}
	
	public static function transactionSaves(AppOrmModel $ormModel, array $dataOfSaves) {
		$saveIds = array();
		for ($i = 0, $cnt = count($dataOfSaves); $i < $cnt; ++$i) {
			$ormModel->create();
			self::transactionSave($ormModel, $dataOfSaves[$i]);
			$saveIds = $ormModel->getID();
		}
		return $saveIds;
	}
	
	public static function getHabtmCacheData(array $ctlData, $ctlAlias, $ctlFieldName) {
		$tmp	= $ctlData[$ctlAlias][$ctlFieldName];
		$vlues	= empty($tmp)? array(): $tmp;
		return ',' . join(',', $vlues) . ',';
	}
}