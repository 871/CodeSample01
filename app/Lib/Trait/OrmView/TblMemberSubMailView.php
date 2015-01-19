<?php 


trait TblMemberSubMailView {

	/**
	 * TblMemberSubMail
	 * @var array<TblMemberSubMail::$data>
	 */
	private $dataTblMemberSubMail = array();

	/**
	 * TblMemberSubMail::$data
	 * if (!isset($dataTblMemberSubMail))	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
	 * $ctlHelper->setDataTblMemberSubMail($dataTblMemberSubMail);
	 * @param array $dataTblMemberSubMail
	 */
	public function setDataTblMemberSubMail(array $dataTblMemberSubMail) {
		$this->dataTblMemberSubMail = $dataTblMemberSubMail;
	}

	/**
	 * プライマリID
	 * $textTblMemberSubMailId	= $ctlHelper->getTextTblMemberSubMailId	();
	 * <?php echo $textTblMemberSubMailId	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailId() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'id';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * メンバ情報ID
	 * $textTblMemberSubMailTblMemberId	= $ctlHelper->getTextTblMemberSubMailTblMemberId	();
	 * <?php echo $textTblMemberSubMailTblMemberId	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberId() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'tbl_member_id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 枝番
	 * $textTblMemberSubMailBranchNo	= $ctlHelper->getTextTblMemberSubMailBranchNo	();
	 * <?php echo $textTblMemberSubMailBranchNo	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailBranchNo() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'branch_no';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * メンバのメールアドレス(サブ)
	 * $textTblMemberSubMailSubMail	= $ctlHelper->getTextTblMemberSubMailSubMail	();
	 * <?php echo $textTblMemberSubMailSubMail	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailSubMail() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'sub_mail';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成IP
	 * $textTblMemberSubMailCreateIp	= $ctlHelper->getTextTblMemberSubMailCreateIp	();
	 * <?php echo $textTblMemberSubMailCreateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailCreateIp() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新IP
	 * $textTblMemberSubMailUpdateIp	= $ctlHelper->getTextTblMemberSubMailUpdateIp	();
	 * <?php echo $textTblMemberSubMailUpdateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailUpdateIp() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時
	 * $textTblMemberSubMailCreated	= $ctlHelper->getTextTblMemberSubMailCreated	();
	 * <?php echo $textTblMemberSubMailCreated	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailCreated() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時
	 * $textTblMemberSubMailUpdated	= $ctlHelper->getTextTblMemberSubMailUpdated	();
	 * <?php echo $textTblMemberSubMailUpdated	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailUpdated() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMemberSubMail';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * プライマリID(belongsTo TblMember.id)
	 * $textTblMemberSubMailTblMemberId	= $ctlHelper->getTextTblMemberSubMailTblMemberId	();
	 * <?php echo $textTblMemberSubMailTblMemberId	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberId() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * メンバ名(belongsTo TblMember.member_name)
	 * $textTblMemberSubMailTblMemberMemberName	= $ctlHelper->getTextTblMemberSubMailTblMemberMemberName	();
	 * <?php echo $textTblMemberSubMailTblMemberMemberName	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberMemberName() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'member_name';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * メンバのメールアドレス(belongsTo TblMember.member_mail)
	 * $textTblMemberSubMailTblMemberMemberMail	= $ctlHelper->getTextTblMemberSubMailTblMemberMemberMail	();
	 * <?php echo $textTblMemberSubMailTblMemberMemberMail	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberMemberMail() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'member_mail';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 生年月日(belongsTo TblMember.member_birthday)
	 * $textTblMemberSubMailTblMemberMemberBirthday	= $ctlHelper->getTextTblMemberSubMailTblMemberMemberBirthday	();
	 * <?php echo $textTblMemberSubMailTblMemberMemberBirthday	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberMemberBirthday() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 性別ID(belongsTo TblMember.mst_sex_id)
	 * $textTblMemberSubMailTblMemberMstSexId	= $ctlHelper->getTextTblMemberSubMailTblMemberMstSexId	();
	 * <?php echo $textTblMemberSubMailTblMemberMstSexId	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberMstSexId() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'mst_sex_id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 所属グループ数(belongsTo TblMember.tbl_group_count)
	 * $textTblMemberSubMailTblMemberTblGroupCount	= $ctlHelper->getTextTblMemberSubMailTblMemberTblGroupCount	();
	 * <?php echo $textTblMemberSubMailTblMemberTblGroupCount	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberTblGroupCount() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'tbl_group_count';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 作成IP(belongsTo TblMember.create_ip)
	 * $textTblMemberSubMailTblMemberCreateIp	= $ctlHelper->getTextTblMemberSubMailTblMemberCreateIp	();
	 * <?php echo $textTblMemberSubMailTblMemberCreateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberCreateIp() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新IP(belongsTo TblMember.update_ip)
	 * $textTblMemberSubMailTblMemberUpdateIp	= $ctlHelper->getTextTblMemberSubMailTblMemberUpdateIp	();
	 * <?php echo $textTblMemberSubMailTblMemberUpdateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberUpdateIp() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時(belongsTo TblMember.created)
	 * $textTblMemberSubMailTblMemberCreated	= $ctlHelper->getTextTblMemberSubMailTblMemberCreated	();
	 * <?php echo $textTblMemberSubMailTblMemberCreated	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberCreated() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時(belongsTo TblMember.updated)
	 * $textTblMemberSubMailTblMemberUpdated	= $ctlHelper->getTextTblMemberSubMailTblMemberUpdated	();
	 * <?php echo $textTblMemberSubMailTblMemberUpdated	; ?>
	 * @return string
	 */
	public function getTextTblMemberSubMailTblMemberUpdated() {
		$data	= $this->dataTblMemberSubMail;
		$alias	= 'TblMember';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

}