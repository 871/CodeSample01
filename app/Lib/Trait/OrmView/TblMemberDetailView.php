<?php 


trait TblMemberDetailView {

	/**
	 * TblMemberDetail
	 * @var array<TblMemberDetail::$data>
	 */
	private $dataTblMemberDetail = array();

	/**
	 * TblMemberDetail::$data
	 * if (!isset($dataTblMemberDetail))	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
	 * $ctlHelper->setDataTblMemberDetail($dataTblMemberDetail);
	 * @param array $dataTblMemberDetail
	 */
	public function setDataTblMemberDetail(array $dataTblMemberDetail) {
		$this->dataTblMemberDetail = $dataTblMemberDetail;
	}

	/**
	 * プライマリID
	 * $textTblMemberDetailId	= $ctlHelper->getTextTblMemberDetailId	();
	 * <?php echo $textTblMemberDetailId	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailId() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'id';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * メンバ情報ID
	 * $textTblMemberDetailTblMemberId	= $ctlHelper->getTextTblMemberDetailTblMemberId	();
	 * <?php echo $textTblMemberDetailTblMemberId	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberId() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'tbl_member_id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 備考
	 * $textTblMemberDetailRemarks	= $ctlHelper->getTextTblMemberDetailRemarks	();
	 * <?php echo $textTblMemberDetailRemarks	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailRemarks() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'remarks';
		$value	= $data[$alias][$field];
		
		return nl2br(h($value));
	}

	/**
	 * 作成IP
	 * $textTblMemberDetailCreateIp	= $ctlHelper->getTextTblMemberDetailCreateIp	();
	 * <?php echo $textTblMemberDetailCreateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailCreateIp() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新IP
	 * $textTblMemberDetailUpdateIp	= $ctlHelper->getTextTblMemberDetailUpdateIp	();
	 * <?php echo $textTblMemberDetailUpdateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailUpdateIp() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時
	 * $textTblMemberDetailCreated	= $ctlHelper->getTextTblMemberDetailCreated	();
	 * <?php echo $textTblMemberDetailCreated	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailCreated() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時
	 * $textTblMemberDetailUpdated	= $ctlHelper->getTextTblMemberDetailUpdated	();
	 * <?php echo $textTblMemberDetailUpdated	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailUpdated() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * メンバ名(belongsTo TblMember.member_name)
	 * $textTblMemberDetailTblMemberMemberName	= $ctlHelper->getTextTblMemberDetailTblMemberMemberName	();
	 * <?php echo $textTblMemberDetailTblMemberMemberName	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberMemberName() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'member_name';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * メンバのメールアドレス(belongsTo TblMember.member_mail)
	 * $textTblMemberDetailTblMemberMemberMail	= $ctlHelper->getTextTblMemberDetailTblMemberMemberMail	();
	 * <?php echo $textTblMemberDetailTblMemberMemberMail	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberMemberMail() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'member_mail';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 生年月日(belongsTo TblMember.member_birthday)
	 * $textTblMemberDetailTblMemberMemberBirthday	= $ctlHelper->getTextTblMemberDetailTblMemberMemberBirthday	();
	 * <?php echo $textTblMemberDetailTblMemberMemberBirthday	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberMemberBirthday() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 性別ID(belongsTo TblMember.mst_sex_id)
	 * $textTblMemberDetailTblMemberMstSexId	= $ctlHelper->getTextTblMemberDetailTblMemberMstSexId	();
	 * <?php echo $textTblMemberDetailTblMemberMstSexId	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberMstSexId() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'mst_sex_id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 所属グループ数(belongsTo TblMember.tbl_group_count)
	 * $textTblMemberDetailTblMemberTblGroupCount	= $ctlHelper->getTextTblMemberDetailTblMemberTblGroupCount	();
	 * <?php echo $textTblMemberDetailTblMemberTblGroupCount	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberTblGroupCount() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'tbl_group_count';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 作成IP(belongsTo TblMember.create_ip)
	 * $textTblMemberDetailTblMemberCreateIp	= $ctlHelper->getTextTblMemberDetailTblMemberCreateIp	();
	 * <?php echo $textTblMemberDetailTblMemberCreateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberCreateIp() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新IP(belongsTo TblMember.update_ip)
	 * $textTblMemberDetailTblMemberUpdateIp	= $ctlHelper->getTextTblMemberDetailTblMemberUpdateIp	();
	 * <?php echo $textTblMemberDetailTblMemberUpdateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberUpdateIp() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時(belongsTo TblMember.created)
	 * $textTblMemberDetailTblMemberCreated	= $ctlHelper->getTextTblMemberDetailTblMemberCreated	();
	 * <?php echo $textTblMemberDetailTblMemberCreated	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberCreated() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時(belongsTo TblMember.updated)
	 * $textTblMemberDetailTblMemberUpdated	= $ctlHelper->getTextTblMemberDetailTblMemberUpdated	();
	 * <?php echo $textTblMemberDetailTblMemberUpdated	; ?>
	 * @return string
	 */
	public function getTextTblMemberDetailTblMemberUpdated() {
		$data	= $this->dataTblMemberDetail;
		$alias	= 'TblMember';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

}