<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UrlUtil
 *
 * @author hanai
 */
class UrlUtil {
	
	/**
	 * ログイン
	 * @return array
	 */
	public static function getLogin() {
		return array(
			'controller'	=> 'Mains',
			'action'		=> 'login',
		);
	}

	/**
	 * ログアウト
	 * @return array
	 */
	public static function getLogout() {
		return array(
			'controller'	=> 'Mains',
			'action'		=> 'logout',
		);
	}

	/**
	 * メニュ
	 * @return array
	 */
	public static function getMenu() {
		return array(
			'controller'	=> 'Mains',
			'action'		=> 'index',
		);
	}
	
	/**
	 * アカウント一覧
	 * @return array
	 */
	public static function getAccountList() {
		return array(
			'controller'	=> 'UserLists',
			'action'		=> 'index',
		);
	}
	
	/**
	 * グループ一覧
	 * （作成、編集の入力も兼用）
	 * @return array
	 */
	public static function getGroupList() {
		return array(
			'controller'	=> 'Groups',
			'action'		=> 'index',
		);
	}
	
	/**
	 * メンバ検索
	 * @return array
	 */
	public static function getMemberSearch() {
		return array(
			'controller'	=> 'MemberSearchs',
			'action'		=> 'index',
		);
	}
	
	/**
	 * メンバ情報詳細
	 * @param int $tbl_member_id
	 * @return array
	 */
	public static function getMemberDetail($tbl_member_id) {
		return array(
			'controller'	=> 'MemberDetails',
			'action'		=> 'index',
			$tbl_member_id,
		);
	}
	
	/**
	 * アカウント作成
	 * @return array
	 */
	public static function getAccountCreate() {
		return array(
			'controller'	=> 'UserCreates',
			'action'		=> 'index',
		);
	}
	
	/**
	 * メンバ作成
	 * @return array
	 */
	public static function getMemberCreate() {
		return array(
			'controller'	=> 'MemberCreates',
			'action'		=> 'index',
		);
	}
	
	/**
	 * アカウント編集
	 * @return array
	 */
	public static function getAccountEdit($tbl_user_id) {
		return array(
			'controller'	=> 'UserEdits',
			'action'		=> 'index',
			$tbl_user_id,
		);
	}
	
	/**
	 * メンバ情報編集
	 * @return array
	 */
	public static function getMemberEdit($tbl_member_id) {
		return array(
			'controller'	=> 'MemberEdits',
			'action'		=> 'index',
			$tbl_member_id,
		);
	}
	
	/**
	 * グループ削除
	 * @return array
	 */
	public static function getGroupDelete($tbl_group_id) {
		return array(
			'controller'	=> 'Groups',
			'action'		=> 'delete',
			$tbl_group_id,
		);
	}
	
	/**
	 * アカウント削除
	 * @return array
	 */
	public static function getAccountDelete($tbl_user_id) {
		return array(
			'controller'	=> 'UserDeletes',
			'action'		=> 'index',
			$tbl_user_id,
		);
	}
	
	/**
	 * メンバ情報削除
	 * @return array
	 */
	public static function getMemberDelete($tbl_member_id) {
		return array(
			'controller'	=> 'MemberDeletes',
			'action'		=> 'index',
			$tbl_member_id,
		);
	}
	
}