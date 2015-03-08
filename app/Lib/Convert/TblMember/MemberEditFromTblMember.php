<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppFromConvert', 'Lib/Convert');

/**
 * Description of MemberEditFromTblMember
 *
 * @author hanai
 */
class MemberEditFromTblMember extends AppFromConvert {
	
	
	public function getCtlData() {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		$ormAlias	= $convert->ormAlias;
		$ormData	= $convert->ormData;
		
		$inputData = array(
			$ctlAlias => array(
				'id'					=> $ormData[$ormAlias]['id'],
				'member_name'			=> $ormData[$ormAlias]['member_name'],
				'member_mail'			=> $ormData[$ormAlias]['member_mail'],
				'member_birthday'		=> $ormData[$ormAlias]['member_birthday'],
				'mst_sex_id'			=> $ormData[$ormAlias]['mst_sex_id'],
				'tbl_member_detail_id'	=> $ormData['TblMemberDetail']['id'],
				'remarks'				=> $ormData['TblMemberDetail']['remarks'],
				'TblGroup'				=> Hash::extract($ormData, 'TblGroup.{n}.id'),
			),
		);
		
		for ($i = 0, $cnt = count($ormData['TblMemberSubMail']); $i < $cnt; ++$i) {
			$inputData[$ctlAlias]['sub_mail_' . $i] = $ormData['TblMemberSubMail'][$i]['sub_mail'];
		}
		return $inputData;
	}
}