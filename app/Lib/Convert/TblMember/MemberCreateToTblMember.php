<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppToConvert', 'Lib/Convert');

/**
 * Description of MemberCreateToTblMember
 *
 * @author hanai
 */
class MemberCreateToTblMember extends AppToConvert {
	
	public function getSaveData() {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		$ormAlias	= $convert->ormAlias;
		$inputData	= $convert->inputData;
		
		$tblMemberSubMail	= self::getTblMemberSubMail($inputData);
		$tbl_group_count	= self::getTblGroupCount($inputData);
		$saveData = array(
			$ormAlias => array(
				'member_name'		=> $inputData[$ctlAlias]['member_name'],
				'member_mail'		=> $inputData[$ctlAlias]['member_mail'],
				'member_birthday'	=> $inputData[$ctlAlias]['member_birthday'],
				'mst_sex_id'		=> $inputData[$ctlAlias]['mst_sex_id'],
				'tbl_group_count'	=> $tbl_group_count,
				'create_ip'			=> env('REMOTE_ADDR'),
				'update_ip'			=> env('REMOTE_ADDR'),
			),
			// hasOne
			'TblMemberDetail' => array(
				'remarks'		=> $inputData[$ctlAlias]['remarks'],
			),
			// HasMany
			'TblMemberSubMail'	=> $tblMemberSubMail,
			// BelongsToHasMany
			'TblGroup' =>  $inputData[$ctlAlias]['TblGroup'],
		);
		return $saveData;
	}
	
	private function getTblMemberSubMail(array $inputData) {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		$result		= array();
		
		$i = 0;
		while (isset($inputData[$ctlAlias]['sub_mail_' . $i])) {
			if (!empty($inputData[$ctlAlias]['sub_mail_' . $i])) {
				$result[] = array(
					'sub_mail' => $inputData[$ctlAlias]['sub_mail_' . $i],
				);
			}
			++$i;
		}
		return $result;
	}
	
	private function getTblGroupCount(array $inputData) {
		$convert	= $this;
		$ctlAlias	= $convert->ctlAlias;
		
		$value = $inputData[$ctlAlias]['TblGroup'];
		if (!is_array($value)) {
			return 0;
		} else {
			return count($value);
		}
	}
}