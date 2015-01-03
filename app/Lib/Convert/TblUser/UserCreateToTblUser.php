<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserCreateToTblUser
 *
 * @author hanai
 */
class UserCreateToTblUser {
	
	const CTL_ALIAS	= 'UserCreate';
	const ORM_ALIAS = 'TblUser';
	
	/**
	 * 
	 * @param array $ctlData
	 * @param AppOrmModel $ormModel
	 * @return array
	 */
	public static function convert(UserCreate $ctlModel, TblUser $ormModel) {
		$inputData	= $ctlModel->data;
		$saveData	= self::getSaveData($inputData);
		$ormModel->set($saveData);
	}
	
	private static function getSaveData($inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		$ormAlias	= self::ORM_ALIAS;
		
		$saveData = array(
			$ormAlias => array(
				'user_name'		=> $inputData[$ctlAlias]['user_name'],
				'user_mail'		=> $inputData[$ctlAlias]['user_mail'],
				'password'		=> $inputData[$ctlAlias]['password'],
				'login_flag'	=> $inputData[$ctlAlias]['login_flag'],
				'create_ip'		=> env('REMOTE_ADDR'),
				'update_ip'		=> env('REMOTE_ADDR'),
			),
		);
		
		return $saveData;
	}
}