<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberEditFromTblMember
 *
 * @author hanai
 */
class MemberEditFromTblMember {
	
	const CTL_ALIAS	= 'MemberEdit';
	const ORM_ALIAS = 'TblMember';
	
	/**
	 * 
	 * @param MemberEdit $ctlData
	 * @param TblMember $ormModel
	 * @return array
	 */
	public static function convert(MemberEdit $ctlModel, TblMember $ormModel) {
		$ormData = $ormModel->data;
		$inputData = self::getInputData($ormData);
		$ctlModel->data = $inputData;
	}
	
	private static function getInputData(array $ormData) {
		$ctlAlias	= self::CTL_ALIAS;
		$ormAlias	= self::ORM_ALIAS;
		
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
			$inputData[$ctlAlias]['tbl_member_sub_mail_id_' . $i] = $ormData['TblMemberSubMail'][$i]['id'		];
			$inputData[$ctlAlias]['branch_no_' . $i				] = $ormData['TblMemberSubMail'][$i]['branch_no'];
			$inputData[$ctlAlias]['sub_mail_' . $i				] = $ormData['TblMemberSubMail'][$i]['sub_mail'	];
		}
		return $inputData;
	}
}