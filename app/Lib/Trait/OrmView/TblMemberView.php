<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TblMemberView
 *
 * @author hanai
 */
trait TblMemberView {
	
	private $dataTblMember = array();
	
	public function setDataTblMember($dataTblMember) {
		$this->dataTblMember = $dataTblMember;
	}
	
	/**
	 * プライマリID
	 * @return string
	 */
	public function getTextTblMemberId() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'id';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * メンバ名
	 * @return string
	 */
	public function getTextTblMemberMemberName() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'member_name';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * メールアドレス
	 * @return string
	 */
	public function getTextTblMemberMemberMail() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'member_mail';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * 生年月日
	 * @return string
	 */
	public function getTextTblMemberMemberBirthday() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * 性別
	 * @return string
	 */
	public function getTextMstSexName() {
		$data	= $this->dataTblMember;
		$alias	= 'MstSex';
		$field	= 'name';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * 所属グループ数
	 * @return string
	 */
	public function getTextTblMemberTblGroupCount() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'tbl_group_count';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * 作成IP
	 * @return string
	 */
	public function getTextTblMemberCreateIp() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * 更新IP
	 * @return string
	 */
	public function getTextTblMemberUpdateIp() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * 作成日時
	 * @return string
	 */
	public function getTextTblMemberCreated() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
	
	/**
	 * 更新日時
	 * @return string
	 */
	public function getTextTblMemberUpdated() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}
}