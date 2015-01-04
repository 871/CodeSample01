<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppCtlHelper', 'View/Helper');
App::uses('UrlUtil', 'Lib/Util');

/**
 * Description of MemberSearchHelper
 *
 * @author hanai
 */
class MemberSearchHelper  extends AppCtlHelper {
	
	private $dataPaginate = array();
	
	/**
	 * ページェントデータ
	 * @param array $dataPaginate
	 */
	public function setDataPaginate(array $dataPaginate) {
		$this->dataPaginate = $dataPaginate;
	}
	
	/**
	 * データ数
	 * @return int
	 */
	public function getDataPaginateCount() {
		return count($this->dataPaginate);
	}
	
	/**
	 * TblMember.id
	 * @param int $index
	 * @return string
	 */
	public function getTextId($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'id';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_name
	 * @param int $index
	 * @return string
	 */
	public function getTextMemberName($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'member_name';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_mail
	 * @param int $index
	 * @return string
	 */
	public function getTextMemberMail($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'member_mail';
		
		return h($data[$alias][$field]);
	}
	
	
	/**
	 * MstSex.name
	 * @param int $index
	 * @return string
	 */
	public function getTextMstSexName($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'MstSex';
		$field	= 'name';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_birthday
	 * @param int $index
	 * @return string
	 */
	public function getTextMemberBirthday($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_birthday
	 * @param int $index
	 * @return string
	 */
	public function getTextMemberAge($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		
		$value	= $data[$alias][$field];
		if (!empty($value)){
			static $now = null;
			if (is_null($now)) {
				$now = date('Ymd');
			}
			$tmp1 = strtotime($value);
			$tmp2 = date('Ymd', $tmp1);
			$tmp3 = ($now - $tmp2) / 10000;
			return h((int) $tmp3);
		} else {
			return h('--');
		}
	}
	
	/**
	 * TblMember.tbl_group_count
	 * @param int $index
	 * @return string
	 */
	public function getTextTblGroupCount ($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'tbl_group_count';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.created
	 * @param int $index
	 * @return string
	 */
	public function getTextCreated($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'created';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.updated
	 * @param int $index
	 * @return string
	 */
	public function getTextUpdated($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'updated';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * メンバ情報作成リンク
	 * @return string
	 */
	public function getLinkAccountMemberCreate() {
		$form		= $this->Html;
		$title		= __('新規メンバー登録');
		$url		= UrlUtil::getMemberCreate();
		$options	= array();
		return $form->link($title, $url, $options);
	}
	
	/**
	 * メンバ情報詳細リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkMemberDetail($index = 0) {
		$form	= $this->ExtForm;
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'id';
		
		$tbl_member_id = $data[$alias][$field];
		
		$title		= __('詳細');
		$url		= UrlUtil::getMemberDetail($tbl_member_id);
		$options	= array();
		return $form->postLink($title, $url, $options);
	}
	
	/**
	 * メンバ情報編集リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkMemberEdit($index = 0) {
		$form	= $this->ExtForm;
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'id';
		
		$tbl_member_id = $data[$alias][$field];
		
		$title		= __('編集');
		$url		= UrlUtil::getMemberEdit($tbl_member_id);
		$options	= array();
		return $form->postLink($title, $url, $options);
	}
	
	/**
	 * メンバ情報削除リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkMemberDelete($index = 0) {
		$form	= $this->ExtForm;
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblMember';
		$field	= 'id';
		
		$tbl_member_id	= $data[$alias][$field];
		$user_name		= $data[$alias]['member_name'];
		
		$title		= __('削除');
		$url		= UrlUtil::getMemberDelete($tbl_member_id);
		$options	= array();
		$confirmMessage = sprintf(__('ID: %1$s [%2$s]のメンバー情報を削除しますか？'), $tbl_member_id, $user_name);
		return $form->postLink($title, $url, $options, $confirmMessage);
	}
	
	/**
	 * ソートリンク（id）
	 * @return string
	 */
	public function getPaginatorSortId() {
		$paginator	= $this->Paginator;
		$key		= 'id';
		$title		= 'ID';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（member_name）
	 * @return string
	 */
	public function getPaginatorSortMemberName() {
		$paginator	= $this->Paginator;
		$key		= 'member_name';
		$title		= 'メンバ名';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（member_mail）
	 * @return string
	 */
	public function getPaginatorSortMemberMail() {
		$paginator	= $this->Paginator;
		$key		= 'member_mail';
		$title		= 'メールアドレス';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（member_birthday）
	 * @return string
	 */
	public function getPaginatorSortMemberBirthday() {
		$paginator	= $this->Paginator;
		$key		= 'member_birthday';
		$title		= '生年月日（年齢）';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（mst_sex_id）
	 * @return string
	 */
	public function getPaginatorSortMstSexId() {
		$paginator	= $this->Paginator;
		$key		= 'mst_sex_id';
		$title		= '性別';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（tbl_group_count）
	 * @return string
	 */
	public function getPaginatorSortTblGroupCount() {
		$paginator	= $this->Paginator;
		$key		= 'tbl_group_count';
		$title		= '所属<br />グループ数';
		$options	= array('escape' => false);
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（created）
	 * @return string
	 */
	public function getPaginatorSortCreated() {
		$paginator	= $this->Paginator;
		$key		= 'created';
		$title		= '登録日時';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（updated）
	 * @return string
	 */
	public function getPaginatorSortUpdated() {
		$paginator	= $this->Paginator;
		$key		= 'updated';
		$title		= '更新日時';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * カウンタテキスト
	 * @return string
	 */
	public function getPaginatorCounter() {
		$paginator	= $this->Paginator;
		$options = array(
			'format' => __('{:page}/{:pages}ページ {:start}-{:end}件を表示(全{:count}件)')
		);
		return $paginator->counter($options);
	}
	
	/**
	 * ページ遷移リンク
	 * @return string
	 */
	public function getPaginatorLinks() {
		$paginator	= $this->Paginator;
		
		$result = array(
			self::getPaginatorLinkPrev		($paginator),
			self::getPaginatorLinkNumbers	($paginator),
			self::getPaginatorLinkNext		($paginator),
		);
		return join("", $result);
	}
	
	/**
	 * 戻るリンク
	 * @param PaginatorHelper $paginator
	 * @return string
	 */
	private static function getPaginatorLinkPrev(PaginatorHelper $paginator) {
		$title				= '< ' . __('戻る');
		$options			= array();
		$disabledTitle		= null;
		$disabledOptions	= array(
			'class' => 'prev disabled'
		);
		return $paginator->prev($title, $options, $disabledTitle, $disabledOptions);
	}
	
	/**
	 * ページNoリンク
	 * @param PaginatorHelper $paginator
	 * @return string
	 */
	private static function getPaginatorLinkNumbers(PaginatorHelper $paginator) {
		$options = array(
			'separator' => ''
		);
		return $paginator->numbers($options);
	}

	/**
	 * 次へリンク
	 * @param PaginatorHelper $paginator
	 * @return string
	 */
	private static function getPaginatorLinkNext(PaginatorHelper $paginator) {
		$title				= __('次へ') . ' >';
		$options			= array();
		$disabledTitle		= null;
		$disabledOptions	= array(
			'class' => 'next disabled'
		);
		return $paginator->next($title, $options, $disabledTitle, $disabledOptions);
	}
	
	/**
	 * フォーム開始
	 * @return string
	 */
	public function getFormStart() {
		$form	= $this->ExtForm;
		$alias	= $this->alias;
		$options = array(
			'url' => UrlUtil::getMemberSearch(),
		);
		return $form->create($alias, $options);
	}
	
	/**
	 * フォーム終了
	 * @return string
	 */
	public function getFormEnd() {
		$form = $this->ExtForm;
		return $form->end();
	}
	
	/**
	 * サブミットボタン(検索)
	 * @return string
	 */
	public function getSubmitSearch() {
		$form	= $this->ExtForm;
		$caption	= '　検　索　';
		$options	= array(
			'div'	=> false,
			'style'	=> "margin-top: 15px; float: right;" ,
		);
		return $form->submit($caption, $options);
	}
	
	/**
	 * グループID
	 * @return string
	 */
	public function getInputTblGroupId() {
		$form		= $this->ExtForm;
		$field		= 'tbl_group_id';
		$options	= array(
			'style' => 'font-size: 100%; width: 90%;',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * メンバ名
	 * @return string
	 */
	public function getInputMemberName() {
		$form		= $this->ExtForm;
		$field		= 'member_name';
		$options	= array(
			'style' => 'font-size: 100%; width: 90%;',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * メールアドレス
	 * @return string
	 */
	public function getInputMemberMail () {
		$form		= $this->ExtForm;
		$field		= 'member_mail';
		$options	= array(
			'style' => 'font-size: 100%; width: 90%;',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * 年齢（下限）
	 * @return string
	 */
	public function getInputMemberAgeMin() {
		$form		= $this->ExtForm;
		$field		= 'member_age_min';
		$options	= array(
			'style' => 'font-size: 100%; width: 40%;',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * 年齢（上限）
	 * @return string
	 */
	public function getInputMemberAgeMax() {
		$form		= $this->ExtForm;
		$field		= 'member_age_max';
		$options	= array(
			'style' => 'font-size: 100%; width: 40%;',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * 生年月日（下限）
	 * @return string
	 */
	public function getInputMemberBirthdayMin() {
		$form		= $this->ExtForm;
		$field		= 'member_birthday_min';
		$options	= array(
			'style' => 'font-size: 75%; width: 40%;',
			'class' => 'inputDate',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * 生年月日（上限）
	 * @return string
	 */
	public function getInputMemberBirthdayMax() {
		$form		= $this->ExtForm;
		$field		= 'member_birthday_max';
		$options	= array(
			'style' => 'font-size: 75%; width: 40%;',
			'class' => 'inputDate',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * 所属グループ数（下限）
	 * @return string
	 */
	public function getInputTblGroupCountMin() {
		$form		= $this->ExtForm;
		$field		= 'tbl_group_count_min';
		$options	= array(
			'style' => 'font-size: 100%; width: 40%;',
		);
		return $form->input($field, $options);
	}
	
	/**
	 * 所属グループ数（上限）
	 * @return string
	 */
	public function getInputTblGroupCountMax() {
		$form		= $this->ExtForm;
		$field		= 'tbl_group_count_max';
		$options	= array(
			'style' => 'font-size: 100%; width: 40%;',
		);
		return $form->input($field, $options);
	}
	
}