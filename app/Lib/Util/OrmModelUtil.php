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
	
	public static function transactionSaveAssociatedDeep(AppOrmModel $ormModel, array $data = null) {
		if (! $ormModel->saveAssociated($data, array('deep' => true))) {
			throw new ErrorException($ormModel->alias . ' Save Error');
		}
	}

	public static function getHabtmCacheData(array $ctlData, $ctlAlias, $ctlFieldName) {
		$tmp	= $ctlData[$ctlAlias][$ctlFieldName];
		$vlues	= empty($tmp)? array(): $tmp;
		return ',' . join(',', $vlues) . ',';
	}
	
	/**
	 * 更新ロック用データ作成
	 * @param AppOrmModel $lockModel
	 * @param type $id
	 * @throws ErrorException
	 */
	public static function saveLockModelData(AppOrmModel $lockModel, $id) {
		$data = array(
			$lockModel->alias => array(
				$lockModel->primaryKey => $id,
			),
		);
		$result = $lockModel->save($data);
		if (!$result) {
			throw new ErrorException($lockModel->name . ' Save Error');
		}
	}
	
	/**
	 * 更新ロック用データ削除
	 * @param AppOrmModel $lockModel
	 * @param type $id
	 * @throws ErrorException
	 */
	public static function deleteLockModelData(AppOrmModel $lockModel, $id) {
		$result = $lockModel->delete($id);
		if (!$result) {
			throw new ErrorException($lockModel->name .' Delete Error');
		}
	}
	
	public static function setHasManySaveData(AppOrmModel $ormModel, stdClass $std, $parField, $bnField) {
		$priField	= $ormModel->primaryKey;
		$data		= !empty($std->data)? $std->data: $ormModel->data;
		if (empty($data[$priField])) {
			$parValue	= $data[$parField];
			$bnValue	= $ormModel->getBranchNo($parValue);
			$priValue	= $ormModel->createStringId($parValue, $bnValue);
			$data[$priField]	= $priValue;
			$data[$bnField]		= $bnValue;
		}
		if (!empty($std->data)) {
			$std->data = $data;
		} else {
			$ormModel->data = $data;
		}
	}
	
	public static function setHasOneSaveData(AppOrmModel $ormModel, stdClass $std, $parField) {
		$priField	= $ormModel->primaryKey;
		$data		= !empty($std->data)? $std->data: $ormModel->data;
		
		if (empty($data[$priField])) {
			$parValue	= $data[$parField];
			$priValue	= $ormModel->createStringId($parValue);
			$data[$priField]	= $priValue;
		}
		if (!empty($std->data)) {
			$std->data = $data;
		} else {
			$ormModel->data = $data;
		}
	}
}