<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppFromConvert', 'Lib/Convert');

/**
 * Description of UserEditFromTblUser
 *
 * @author hanai
 */
class UserEditFromTblUser extends AppFromConvert {
	
	public function getCtlData() {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		$ormAlias	= $convert->ormAlias;
		$ormData	= $convert->ormData;
		
		$password	= self::getPasssword();
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
	
	private function getPasssword() {
		$convert	= $this;
		$ormAlias	= $convert->ormAlias;
		$ormModel	= $convert->ormModel;
		$ormData	= $convert->ormData;
		
		$user_password = $ormData[$ormAlias]['user_password'];
		return $ormModel->passwordDecrypt($user_password);
	}
}