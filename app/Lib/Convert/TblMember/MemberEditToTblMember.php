<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppToConvert', 'Lib/Convert');

/**
 * Description of MemberEditToTblMember
 *
 * @author hanai
 */
class MemberEditToTblMember extends AppToConvert {
	
	
	public function getSaveData() {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		$ormAlias	= $convert->ormAlias;
		$ctlData	= $convert->ctlData;;
		
		$tblMemberSubMail	= self::getTblMemberSubMail($ctlData);
		$tbl_group_count	= self::getTblGroupCount($ctlData);
		$saveData = array(
			$ormAlias => array(
				'id'				=> $ctlData[$ctlAlias]['id'],
				'member_name'		=> $ctlData[$ctlAlias]['member_name'],
				'member_mail'		=> $ctlData[$ctlAlias]['member_mail'],
				'member_birthday'	=> $ctlData[$ctlAlias]['member_birthday'],
				'mst_sex_id'		=> $ctlData[$ctlAlias]['mst_sex_id'],
				'tbl_group_count'	=> $tbl_group_count,
				'update_ip'			=> env('REMOTE_ADDR'),
			),
			// HasOne
			'TblMemberDetail' => array(
				'id'				=> $ctlData[$ctlAlias]['tbl_member_detail_id'],
				'tbl_member_id'		=> $ctlData[$ctlAlias]['id'],
				'remarks'			=> $ctlData[$ctlAlias]['remarks'],
			),
			// HasMany
			'TblMemberSubMail'	=> $tblMemberSubMail,
			// BelongsToHasMany
			'TblGroup' =>  $ctlData[$ctlAlias]['TblGroup'],
		);
		return $saveData;
	}
	
	private function getTblMemberSubMail(array $ctlData) {
		$ctlAlias	= $this->ctlAlias;
		$result		= array();
		
		$i = 0;
		while (isset($ctlData[$ctlAlias]['sub_mail_' . $i])) {
			if (!empty($ctlData[$ctlAlias]['sub_mail_' . $i])) {
				$result[] = array(
					'sub_mail'		=> $ctlData[$ctlAlias]['sub_mail_' . $i],
				);
			}
			++$i;
		}
		return $result;
	}
	
	private function getTblGroupCount(array $ctlData) {
		$ctlAlias	= $this->ctlAlias;
		
		$value = $ctlData[$ctlAlias]['TblGroup'];
		if (!is_array($value)) {
			return 0;
		} else {
			return count($value);
		}
	}
}