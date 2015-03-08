<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppToConvert', 'Lib/Convert');

/**
 * Description of UserCreateToTblUser
 *
 * @author hanai
 */
class UserCreateToTblUser extends AppToConvert {
	
	public function getSaveData() {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		$ormAlias	= $convert->ormAlias;
		$ctlData	= $convert->ctlData;
		
		$saveData = array(
			$ormAlias => array(
				'user_name'		=> $ctlData[$ctlAlias]['user_name'],
				'user_mail'		=> $ctlData[$ctlAlias]['user_mail'],
				'password'		=> $ctlData[$ctlAlias]['password'],
				'login_flag'	=> $ctlData[$ctlAlias]['login_flag'],
				'create_ip'		=> env('REMOTE_ADDR'),
				'update_ip'		=> env('REMOTE_ADDR'),
			),
		);
		
		return $saveData;
	}
}