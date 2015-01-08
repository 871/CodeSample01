<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberEditToTblMember
 *
 * @author hanai
 */
class MemberEditToTblMember {
	
	const CTL_ALIAS	= 'MemberEdit';
	const ORM_ALIAS = 'TblMember';
	
	/**
	 * 
	 * @param MemberEdit $ctlData
	 * @param TblMember $ormModel
	 * @return array
	 */
	public static function convert(MemberEdit $ctlModel, TblMember $ormModel) {
		$inputData	= $ctlModel->data;
		$saveData	= self::getSaveData($inputData);
		$ormModel->set($saveData);
	}
	
	private static function getSaveData(array $inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		$ormAlias	= self::ORM_ALIAS;
		
		$tblMemberSubMail	= self::getTblMemberSubMail($inputData);
		$tbl_group_count	= self::getTblGroupCount($inputData);
		$saveData = array(
			$ormAlias => array(
				'id'				=> $inputData[$ctlAlias]['id'],
				'member_name'		=> $inputData[$ctlAlias]['member_name'],
				'member_mail'		=> $inputData[$ctlAlias]['member_mail'],
				'member_birthday'	=> $inputData[$ctlAlias]['member_birthday'],
				'mst_sex_id'		=> $inputData[$ctlAlias]['mst_sex_id'],
				'tbl_group_count'	=> $tbl_group_count,
				'update_ip'			=> env('REMOTE_ADDR'),
			),
			// HasOne
			'TblMemberDetail' => array(
				'id'				=> $inputData[$ctlAlias]['tbl_member_detail_id'],
				'tbl_member_id'		=> $inputData[$ctlAlias]['id'],
				'remarks'			=> $inputData[$ctlAlias]['remarks'],
			),
			// HasMany
			'TblMemberSubMail'	=> $tblMemberSubMail,
			// BelongsToHasMany
			'TblGroup' =>  $inputData[$ctlAlias]['TblGroup'],
		);
		return $saveData;
	}
	
	private static function getTblMemberSubMail(array $inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		$result		= array();
		
		$i = 0;
		while (isset($inputData[$ctlAlias]['sub_mail_' . $i])) {
			if (!empty($inputData[$ctlAlias]['sub_mail_' . $i])) {
				$result[] = array(
					'id'			=> $inputData[$ctlAlias]['tbl_member_sub_mail_id_' . $i],
					'tbl_member_id' => $inputData[$ctlAlias]['id'],
					'branch_no'		=> $inputData[$ctlAlias]['branch_no_' . $i],
					'sub_mail'		=> $inputData[$ctlAlias]['sub_mail_' . $i],
				);
			}
			++$i;
		}
		return $result;
	}
	
	private static function getTblGroupCount(array $inputData) {
		$ctlAlias	= self::CTL_ALIAS;
		
		$value = $inputData[$ctlAlias]['TblGroup'];
		if (!is_array($value)) {
			return 0;
		} else {
			return count($value);
		}
	}
}