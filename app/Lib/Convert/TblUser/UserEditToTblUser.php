<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppToConvert', 'Lib/Convert');

/**
 * Description of UserEditToTblUser
 *
 * @author hanai
 */
class UserEditToTblUser extends AppToConvert {
	
	public function getSaveData() {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		$ormAlias	= $convert->ormAlias;
		$ctlData	= $convert->ctlData;
		
		$saveData = array(
			$ormAlias => array(
				'id'			=> $ctlData[$ctlAlias]['id'],
				'user_name'		=> $ctlData[$ctlAlias]['user_name'],
				'user_mail'		=> $ctlData[$ctlAlias]['user_mail'],
				'password'		=> $ctlData[$ctlAlias]['password'],
				'login_flag'	=> $ctlData[$ctlAlias]['login_flag'],
				'update_ip'		=> env('REMOTE_ADDR'),
			),
		);
		
		return $saveData;
	}
}