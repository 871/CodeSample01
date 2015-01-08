<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberCreateToTblMember
 *
 * @author hanai
 */
class MemberCreateToTblMember {
	
	const CTL_ALIAS	= 'MemberCreate';
	const ORM_ALIAS = 'TblMember';
	
	/**
	 * 
	 * @param MemberCreate $ctlData
	 * @param TblMember $ormModel
	 * @return array
	 */
	public static function convert(MemberCreate $ctlModel, TblMember $ormModel) {
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
			'TblGroup' => array(
				'TblGroup' => $inputData[$ctlAlias]['TblGroup'],
			),
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
					'sub_mail' => $inputData[$ctlAlias]['sub_mail_' . $i],
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