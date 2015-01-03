<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupToTblGroup
 *
 * @author hanai
 */
class GroupToTblGroup {
	
	const CTL_ALIAS	= 'Group';
	const ORM_ALIAS = 'TblGroup';
	
	/**
	 * 
	 * @param Group $ctlData
	 * @param TblGroup $ormModel
	 * @return array
	 */
	public static function convert(Group $ctlModel, TblGroup $ormModel) {
		$inputData	= $ctlModel->data;
		$saveData	= self::getSaveData($inputData);
		$ormModel->set($saveData);
	}
	
	private static function getSaveData(array $inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		$ormAlias	= self::ORM_ALIAS;
		
		$tbl_group_id	= self::getTblGroupId	($inputData);
		$create_ip		= self::getCreateIp		($inputData);
		
		$saveData = array(
			$ormAlias => array(
				'group_name'	=> $inputData[$ctlAlias]['group_name'],
				'update_ip'		=> env('REMOTE_ADDR'),
			),
		);
		if (!is_null($tbl_group_id)) {
			$saveData[$ormAlias]['id'] = $tbl_group_id;
		}
		if (!is_null($create_ip)) {
			$saveData[$ormAlias]['create_ip'] = $create_ip;
		}
		return $saveData;
	}
	
	private static function getTblGroupId(array $inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		
		if (!isset($inputData[$ctlAlias]['id']) || empty($inputData[$ctlAlias]['id'])) {
			return null;
		} else {
			return $inputData[$ctlAlias]['id'];
		}
	}
	
	private static function getCreateIp(array $inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		
		if (!isset($inputData[$ctlAlias]['id']) || empty($inputData[$ctlAlias]['id'])) {
			return env('REMOTE_ADDR');
		} else {
			return null;
		}
	}
	
}