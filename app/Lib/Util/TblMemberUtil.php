<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TblMemberUtil
 *
 * @author hanai
 */
class TblMemberUtil {
	
	
	/**
	 * 更新ロック用データ作成
	 * @param TblMemberLock $lockModel
	 * @param type $id
	 * @throws ErrorException
	 */
	public static function saveTblMemberLock(TblMemberLock $lockModel, $id) {
		$data = array(
			$lockModel->alias => array(
				$lockModel->primaryKey => $id,
			),
		);
		$result = $lockModel->save($data);
		if (!$result) {
			throw new ErrorException('TblMemberLock Save Error');
		}
	}
	
	/**
	 * 更新ロック用データ削除
	 * @param TblMemberLock $lockModel
	 * @param type $id
	 * @throws ErrorException
	 */
	public static function deleteTblMemberLock(TblMemberLock $lockModel, $id) {
		$result = $lockModel->delete($id);
		if (!$result) {
			throw new ErrorException('TblMemberLock Delete Error');
		}
	}
	
	/**
	 * メンバ情報詳細（否検索項目）の登録
	 * @param TblMemberDetail $tblMemberDetail
	 * @param TblMember $tblMember
	 */
	public static function saveTblMemberDetail(TblMemberDetail $tblMemberDetail, TblMember $tblMember) {
		$alias					= 'TblMemberDetail';
		$tbl_member_id			= $tblMember->getID();
		$tbl_member_detail_id	= $tblMemberDetail->createStringId($tbl_member_id);
		$data					= Hash::get($tblMember->data, $alias);
		
		if (!is_null($data)) {
			$saveData = array(
				$alias => array(
					'id'			=> $tbl_member_detail_id,
					'tbl_member_id'	=> $tbl_member_id,
					'remarks'		=> Hash::get($data, 'remarks'),
				),
			);
			if (!$tblMemberDetail->save($saveData)) {
				throw new ErrorException('TblMemberDetail Save Error');
			}
		}
	}
	
	/**
	 * サブメールアドレス（メンバ情報）の登録
	 * Memo:HasManyの取得フォーマットで保存する
	 * @param TblMemberSubMail $tblMemberSubMail
	 * @param TblMember $tblMember
	 */
	public static function saveTblMemberSubMails(TblMemberSubMail $tblMemberSubMail, TblMember $tblMember) {
		$alias					= 'TblMemberSubMail';
		$dataTblMemberSubMails	= Hash::get($tblMember->data, $alias);
		if (is_null($dataTblMemberSubMails)) {
			return;
		}
		
		$dataCount		= count($dataTblMemberSubMails);
		$maxDataCount	= TblMemberSubMail::MAX_DATA_COUNT;
		if  ($dataCount > $maxDataCount) {
			throw new ErrorException('TblMemberSubMail Data Count Error');
		}
		
		$tbl_member_id = $tblMember->getID();
		for ($i = 0; $i < $maxDataCount; ++$i) {
			$branch_no	= $i + 1;
			$id			= $tblMemberSubMail->createStringId($tbl_member_id, $branch_no);
			$tblMemberSubMail->create();
			if (isset($dataTblMemberSubMails[$i])) {
				$saveData = array(
					$alias => array(
						'id'			=> $id,
						'tbl_member_id'	=> $tbl_member_id,
						'branch_no'		=> $branch_no,
						'sub_mail'		=> Hash::get($dataTblMemberSubMails[$i], 'sub_mail'),
					),
				);
				if (!$tblMemberSubMail->save($saveData)) {
					throw new ErrorException('TblMemberSubMail Save Error');
				}
			} else {
				$tblMemberSubMail->delete($id);
			}
		}
	}
}