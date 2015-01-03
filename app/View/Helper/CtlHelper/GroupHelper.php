<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppCtlHelper', 'View/Helper');
App::uses('UrlUtil', 'Lib/Util');

/**
 * Description of GroupHelper
 *
 * @author hanai
 */
class GroupHelper  extends AppCtlHelper {
	
	const TPL_FORM_ID = 'GroupSaveForm';
	
	private $dataPaginate = array();
	
	
	/**
	 * フォーム開始
	 * @return string
	 */
	public function getFormStart($index = null) {
		$form	= $this->ExtForm;
		$alias	= $this->alias;
		
		$formId = self::getFormId($index);
		$options = array(
			'id' => $formId,
			'onsubmit' => 'return false;',
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
	 * id
	 * @return string
	 */
	public function getInputId($index = null) {
		$form		= $this->ExtForm;
		$fieldName	= 'id';
		$options	= array();
		if (!is_null($index)) {
			$data	= $this->dataPaginate[$index];
			$alias	= 'TblGroup';
			$field	= 'id';
			$options['value'] = $data[$alias][$field];
		}
		return $form->input($fieldName, $options);
	}
	
	/**
	 * group_name
	 * @return string
	 */
	public function getInputGroupName($index = null) {
		$form		= $this->ExtForm;
		$fieldName	= 'group_name';
		$options	= array();
		if (!is_null($index)) {
			$data	= $this->dataPaginate[$index];
			$alias	= 'TblGroup';
			$field	= 'group_name';
			$options['value'] = $data[$alias][$field];
		}
		return $form->input($fieldName, $options);
	}
	
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
	 * TblGroup.id
	 * @param int $index
	 * @return string
	 */
	public function getTextId($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblGroup';
		$field	= 'id';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblGroup.user_mail
	 * @param int $index
	 * @return string
	 */
	public function getTextTblMemberCount($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblGroup';
		$field	= 'tbl_member_count';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblGroup.create_ip
	 * @param int $index
	 * @return string
	 */
	public function getTextCreateIp($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblGroup';
		$field	= 'create_ip';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblGroup.update_ip
	 * @param int $index
	 * @return string
	 */
	public function getTextUpdateIp($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblGroup';
		$field	= 'update_ip';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblGroup.created
	 * @param int $index
	 * @return string
	 */
	public function getTextCreated($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblGroup';
		$field	= 'created';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblGroup.updated
	 * @param int $index
	 * @return string
	 */
	public function getTextUpdated($index = 0) {
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblGroup';
		$field	= 'updated';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * グループ情報作成、編集リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkGroupSave($index = null) {
		$html		= $this->Html;
		$session	= $this->Session;
		
		$formId		= self::getFormId	($index);
		$title		= self::getLinkTitle($index);
		$url		= array(
			'action' => 'save',
			AjaxUtil::getToken($session),
		);
		$options	= array(
			'onclick' => "return jQuery.ajaxSubmit.run('#{$formId}', this);"	
		);
		return $html->link($title, $url, $options);
	}
	
	private static function getLinkTitle($index) {
		if (is_null($index)) {
			return __('作　成');
		} else {
			return __('編　集');
		}
	}
	
	private static function getFormId($index) {
		$tplFormId = self::TPL_FORM_ID; 
		return $tplFormId . $index;
	}
	
	/**
	 * グループ情報削除リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkGroupDelete($index = 0) {
		$form	= $this->ExtForm;
		$data	= $this->dataPaginate[$index];
		$alias	= 'TblGroup';
		$field	= 'id';
		
		$tbl_group_id	= $data[$alias][$field];
		$group_name		= $data[$alias]['group_name'];
		
		$title		= __('削　除');
		$url		= UrlUtil::getGroupDelete($tbl_group_id);
		$options	= array();
		$confirmMessage = sprintf(__('ID: %1$s [%2$s]のグループ情報を削除しますか？'), $tbl_group_id, $group_name);
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
	 * ソートリンク（tbl_member_count）
	 * @return string
	 */
	public function getPaginatorSortTblMemberCount() {
		$paginator	= $this->Paginator;
		$key		= 'tbl_member_count';
		$title		= 'メンバ数';
		$options	= array();
		
		return $paginator->sort($key, $title, $options);
	}
	
	/**
	 * ソートリンク（group_name）
	 * @return string
	 */
	public function getPaginatorSortGroupName() {
		$paginator	= $this->Paginator;
		$key		= 'group_name';
		$title		= 'グループ名';
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