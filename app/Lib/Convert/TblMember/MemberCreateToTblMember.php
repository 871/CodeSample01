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
		
		$dataTblMemberSubMail = self::getDataTblMemberSubMail($inputData);
		$saveData = array(
			$ormAlias => array(
				'member_name'		=> $inputData[$ctlAlias]['member_name'],
				'member_mail'		=> $inputData[$ctlAlias]['member_mail'],
				'member_birthday'	=> $inputData[$ctlAlias]['member_birthday'],
				'mst_sex_id'		=> $inputData[$ctlAlias]['mst_sex_id'],
				'tbl_group_count'	=> 0,
				'create_ip'			=> env('REMOTE_ADDR'),
				'update_ip'			=> env('REMOTE_ADDR'),
			),
			'TblMemberDetail' => array(
				'remarks'			=> $inputData[$ctlAlias]['remarks'],
			),
			'TblMemberSubMail' => $dataTblMemberSubMail,
		);
		return $saveData;
	}
	
	private static function getDataTblMemberSubMail(array $inputData) {
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
}