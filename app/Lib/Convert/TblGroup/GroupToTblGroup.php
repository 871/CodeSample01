<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppToConvert', 'Lib/Convert');

/**
 * Description of GroupToTblGroup
 *
 * @author hanai
 */
class GroupToTblGroup extends AppToConvert {
	
	
	public function getSaveData() {
		$convert	= $this;
		$ctlData	= $convert->ctlData;
		$ctlAlias	= $convert->ctlAlias;
		$ormAlias	= $convert->ormAlias;
		
		$tbl_group_id	= Hash::get($ctlData, $ctlAlias . '.id');
		$create_ip		= self::getCreateIp($tbl_group_id);
		
		$saveData = array(
			$ormAlias => array(
				'group_name'	=> $ctlData[$ctlAlias]['group_name'],
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
	
	private static function getCreateIp($tbl_group_id) {
		if (empty($tbl_group_id)) {
			return env('REMOTE_ADDR');
		} else {
			return null;
		}
	}
}