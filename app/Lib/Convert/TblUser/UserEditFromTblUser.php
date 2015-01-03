<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserEditFromTblUser
 *
 * @author hanai
 */
class UserEditFromTblUser {
	
	const CTL_ALIAS	= 'UserEdit';
	const ORM_ALIAS = 'TblUser';
	
	/**
	 * 
	 * @param UserEdit $ctlModel
	 * @param TblUser $ormModel
	 * @return array
	 */
	public static function convert(UserEdit $ctlModel, TblUser $ormModel, $tbl_user_id) {
		$ormData	= $ormModel->read(null, $tbl_user_id);
		$editData	= self::getEditData($ormData, $ormModel);
		$ctlModel->set($editData);
	}
	
	private static function getEditData(array $ormData, TblUser $ormModel) {
		$ctlAlias	= self::CTL_ALIAS;
		$ormAlias	= self::ORM_ALIAS;
		
		$password	= self::getPasssword($ormData, $ormModel);
		
		$editData = array(
			$ctlAlias => array(
				'id'			=> $ormData[$ormAlias]['id'],
				'user_name'		=> $ormData[$ormAlias]['user_name'],
				'user_mail'		=> $ormData[$ormAlias]['user_mail'],
				'password'		=> $password,
				'password_conf'	=> $password,
				'login_flag'	=> $ormData[$ormAlias]['login_flag'],
			),
		);
		
		return $editData;
	}
	
	private static function getPasssword(array $ormData, TblUser $ormModel) {
		$ormAlias = self::ORM_ALIAS;
		
		$user_password = $ormData[$ormAlias]['user_password'];
		return $ormModel->passwordDecrypt($user_password);
	}
}