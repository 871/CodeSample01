<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserEditToTblUser
 *
 * @author hanai
 */
class UserEditToTblUser {
	
	const CTL_ALIAS	= 'UserEdit';
	const ORM_ALIAS = 'TblUser';
	
	/**
	 * 
	 * @param UserEdit $ctlModel
	 * @param TblUser $ormModel
	 * @return array
	 */
	public static function convert(UserEdit $ctlModel, TblUser $ormModel) {
		$inputData	= $ctlModel->data;
		$saveData	= self::getSaveData($inputData);
		$ormModel->set($saveData);
	}
	
	private static function getSaveData($inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		$ormAlias	= self::ORM_ALIAS;
		
		$saveData = array(
			$ormAlias => array(
				'id'			=> $inputData[$ctlAlias]['id'],
				'user_name'		=> $inputData[$ctlAlias]['user_name'],
				'user_mail'		=> $inputData[$ctlAlias]['user_mail'],
				'password'		=> $inputData[$ctlAlias]['password'],
				'login_flag'	=> $inputData[$ctlAlias]['login_flag'],
				'update_ip'		=> env('REMOTE_ADDR'),
			),
		);
		
		return $saveData;
	}
}