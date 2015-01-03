<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppCtlHelper', 'View/Helper');
App::uses('UrlUtil', 'Lib/Util');

/**
 * Description of UserListHelper
 *
 * @author hanai
 */
class UserListHelper  extends AppCtlHelper {
	
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
	 * TblUser.id
	 * @param int $index
	 * @return string
	 */
	public function getTextId($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'id';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblUser.login_flag
	 * @param int $index
	 * @return string
	 */
	public function getTextLoginFlag($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'login_flag';
		
		if ($data[$alias][$field]) {
			return h('可');
		} else {
			return '<span style="color:red">' . h('不可') . '</span>';
		}
	}
	
	/**
	 * TblUser.user_name
	 * @param int $index
	 * @return string
	 */
	public function getTextUserName($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'user_name';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblUser.user_mail
	 * @param int $index
	 * @return string
	 */
	public function getTextUserMail($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'user_mail';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblUser.create_ip
	 * @param int $index
	 * @return string
	 */
	public function getTextCreateIp($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'create_ip';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblUser.update_ip
	 * @param int $index
	 * @return string
	 */
	public function getTextUpdateIp($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'update_ip';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblUser.created
	 * @param int $index
	 * @return string
	 */
	public function getTextCreated($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'created';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblUser.updated
	 * @param int $index
	 * @return string
	 */
	public function getTextUpdated($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'updated';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * アカウント情報作成リンク
	 * @return string
	 */
	public function getLinkAccountCreate() {
		$form		= $this->Html;
		$title		= __('新規アカウント作成');
		$url		= UrlUtil::getAccountCreate();
		$options	= array();
		return $form->link($title, $url, $options);
	}

	
	/**
	 * アカウント情報編集リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkAccountEdit($index = 0) {
		$form	= $this->ExtForm;
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'id';
		
		$tbl_user_id = $data[$alias][$field];
		
		$title		= __('編集');
		$url		= UrlUtil::getAccountEdit($tbl_user_id);
		$options	= array();
		return $form->postLink($title, $url, $options);
	}
	
	/**
	 * アカウント情報削除リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkAccountDelete($index = 0) {
		$form	= $this->ExtForm;
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblUser';
		$field	= 'id';
		
		$tbl_user_id	= $data[$alias][$field];
		$user_name		= $data[$alias]['user_name'];
		
		$title		= __('削除');
		$url		= UrlUtil::getAccountDelete($tbl_user_id);
		$options	= array();
		$confirmMessage = sprintf(__('ID: %1$s [%2$s]のアカウント情報を削除しますか？'), $tbl_user_id, $user_name);
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
	 * ソートリンク（login_flag）
	 * @return string
	 */
	public function getPaginatorSortLoginFlag() {
		$paginator	= $this->Paginator;
		$key		= 'login_flag';
		$title		= 'ログイン';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（user_name）
	 * @return string
	 */
	public function getPaginatorSortUserName() {
		$paginator	= $this->Paginator;
		$key		= 'user_name';
		$title		= 'ユーザ名';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（user_mail）
	 * @return string
	 */
	public function getPaginatorSortUserMail() {
		$paginator	= $this->Paginator;
		$key		= 'user_mail';
		$title		= 'メールアドレス';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（create_ip）
	 * @return string
	 */
	public function getPaginatorSortCreateIp() {
		$paginator	= $this->Paginator;
		$key		= 'create_ip';
		$title		= '登録IPアドレス';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（update_ip）
	 * @return string
	 */
	public function getPaginatorSortUpdateIp() {
		$paginator	= $this->Paginator;
		$key		= 'update_ip';
		$title		= '更新IPアドレス';
		$options	= array();
		
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
}