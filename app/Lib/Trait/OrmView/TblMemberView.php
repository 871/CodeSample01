<?php 


trait TblMemberView {

	/**
	 * TblMember
	 * @var array<TblMember::$data>
	 */
	private $dataTblMember = array();

	/**
	 * TblMember::$data
	 * if (!isset($dataTblMember))	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
	 * $ctlHelper->setDataTblMember($dataTblMember);
	 * @param array $dataTblMember
	 */
	public function setDataTblMember(array $dataTblMember) {
		$this->dataTblMember = $dataTblMember;
	}

	/**
	 * プライマリID
	 * $textTblMemberId	= $ctlHelper->getTextTblMemberId	();
	 * <?php echo $textTblMemberId	; ?>
	 * @return string
	 */
	public function getTextTblMemberId() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * メンバ名
	 * $textTblMemberMemberName	= $ctlHelper->getTextTblMemberMemberName	();
	 * <?php echo $textTblMemberMemberName	; ?>
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
	 * メンバのメールアドレス
	 * $textTblMemberMemberMail	= $ctlHelper->getTextTblMemberMemberMail	();
	 * <?php echo $textTblMemberMemberMail	; ?>
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
	 * $textTblMemberMemberBirthday	= $ctlHelper->getTextTblMemberMemberBirthday	();
	 * <?php echo $textTblMemberMemberBirthday	; ?>
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
	 * 性別ID
	 * $textTblMemberMstSexId	= $ctlHelper->getTextTblMemberMstSexId	();
	 * <?php echo $textTblMemberMstSexId	; ?>
	 * @return string
	 */
	public function getTextTblMemberMstSexId() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'mst_sex_id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 所属グループ数
	 * $textTblMemberTblGroupCount	= $ctlHelper->getTextTblMemberTblGroupCount	();
	 * <?php echo $textTblMemberTblGroupCount	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblGroupCount() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'tbl_group_count';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 作成IP
	 * $textTblMemberCreateIp	= $ctlHelper->getTextTblMemberCreateIp	();
	 * <?php echo $textTblMemberCreateIp	; ?>
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
	 * $textTblMemberUpdateIp	= $ctlHelper->getTextTblMemberUpdateIp	();
	 * <?php echo $textTblMemberUpdateIp	; ?>
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
	 * $textTblMemberCreated	= $ctlHelper->getTextTblMemberCreated	();
	 * <?php echo $textTblMemberCreated	; ?>
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
	 * $textTblMemberUpdated	= $ctlHelper->getTextTblMemberUpdated	();
	 * <?php echo $textTblMemberUpdated	; ?>
	 * @return string
	 */
	public function getTextTblMemberUpdated() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * プライマリID(hasOne TblMemberDetail.id)
	 * $textTblMemberTblMemberDetailId	= $ctlHelper->getTextTblMemberTblMemberDetailId	();
	 * <?php echo $textTblMemberTblMemberDetailId	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblMemberDetailId() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberDetail';
		$field	= 'id';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * メンバ情報ID(hasOne TblMemberDetail.tbl_member_id)
	 * $textTblMemberTblMemberDetailTblMemberId	= $ctlHelper->getTextTblMemberTblMemberDetailTblMemberId	();
	 * <?php echo $textTblMemberTblMemberDetailTblMemberId	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblMemberDetailTblMemberId() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberDetail';
		$field	= 'tbl_member_id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 備考(hasOne TblMemberDetail.remarks)
	 * $textTblMemberTblMemberDetailRemarks	= $ctlHelper->getTextTblMemberTblMemberDetailRemarks	();
	 * <?php echo $textTblMemberTblMemberDetailRemarks	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblMemberDetailRemarks() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberDetail';
		$field	= 'remarks';
		$value	= $data[$alias][$field];
		
		return nl2br(h($value));
	}

	/**
	 * 作成IP(hasOne TblMemberDetail.create_ip)
	 * $textTblMemberTblMemberDetailCreateIp	= $ctlHelper->getTextTblMemberTblMemberDetailCreateIp	();
	 * <?php echo $textTblMemberTblMemberDetailCreateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblMemberDetailCreateIp() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberDetail';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新IP(hasOne TblMemberDetail.update_ip)
	 * $textTblMemberTblMemberDetailUpdateIp	= $ctlHelper->getTextTblMemberTblMemberDetailUpdateIp	();
	 * <?php echo $textTblMemberTblMemberDetailUpdateIp	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblMemberDetailUpdateIp() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberDetail';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時(hasOne TblMemberDetail.created)
	 * $textTblMemberTblMemberDetailCreated	= $ctlHelper->getTextTblMemberTblMemberDetailCreated	();
	 * <?php echo $textTblMemberTblMemberDetailCreated	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblMemberDetailCreated() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberDetail';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時(hasOne TblMemberDetail.updated)
	 * $textTblMemberTblMemberDetailUpdated	= $ctlHelper->getTextTblMemberTblMemberDetailUpdated	();
	 * <?php echo $textTblMemberTblMemberDetailUpdated	; ?>
	 * @return string
	 */
	public function getTextTblMemberTblMemberDetailUpdated() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberDetail';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 表示名(belongsTo MstSex.name)
	 * $textTblMemberMstSexName	= $ctlHelper->getTextTblMemberMstSexName	();
	 * <?php echo $textTblMemberMstSexName	; ?>
	 * @return string
	 */
	public function getTextTblMemberMstSexName() {
		$data	= $this->dataTblMember;
		$alias	= 'MstSex';
		$field	= 'name';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 表示順(belongsTo MstSex.sort)
	 * $textTblMemberMstSexSort	= $ctlHelper->getTextTblMemberMstSexSort	();
	 * <?php echo $textTblMemberMstSexSort	; ?>
	 * @return string
	 */
	public function getTextTblMemberMstSexSort() {
		$data	= $this->dataTblMember;
		$alias	= 'MstSex';
		$field	= 'sort';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * オプション(belongsTo MstSex.options)
	 * $textTblMemberMstSexOptions	= $ctlHelper->getTextTblMemberMstSexOptions	();
	 * <?php echo $textTblMemberMstSexOptions	; ?>
	 * @return string
	 */
	public function getTextTblMemberMstSexOptions() {
		$data	= $this->dataTblMember;
		$alias	= 'MstSex';
		$field	= 'options';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時(belongsTo MstSex.created)
	 * $textTblMemberMstSexCreated	= $ctlHelper->getTextTblMemberMstSexCreated	();
	 * <?php echo $textTblMemberMstSexCreated	; ?>
	 * @return string
	 */
	public function getTextTblMemberMstSexCreated() {
		$data	= $this->dataTblMember;
		$alias	= 'MstSex';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時(belongsTo MstSex.updated)
	 * $textTblMemberMstSexUpdated	= $ctlHelper->getTextTblMemberMstSexUpdated	();
	 * <?php echo $textTblMemberMstSexUpdated	; ?>
	 * @return string
	 */
	public function getTextTblMemberMstSexUpdated() {
		$data	= $this->dataTblMember;
		$alias	= 'MstSex';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 削除日時(belongsTo MstSex.deleted)
	 * $textTblMemberMstSexDeleted	= $ctlHelper->getTextTblMemberMstSexDeleted	();
	 * <?php echo $textTblMemberMstSexDeleted	; ?>
	 * @return string
	 */
	public function getTextTblMemberMstSexDeleted() {
		$data	= $this->dataTblMember;
		$alias	= 'MstSex';
		$field	= 'deleted';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * hasManyデータカウント（TblMemberSubMail）
	 * $cnt = $ctlHelper->getDataTblMemberTblMemberSubMailCount();
	 * @return int
	 */
	public function getDataTblMemberTblMemberSubMailCount() {
		return count($this->dataTblMember['TblMemberSubMail']);
	}

	/**
	 * hasMany Displays (TblMemberSubMail）
	 * $textTblMemberTblMemberSubMailDisplay = $ctlHelper->getTextTblMemberTblMemberSubMailDisplay();
	 * <?php $textTblMemberTblMemberSubMailDisplay; ?>
	 * @param string
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailDisplay($display = 'sub_mail') {
		$data	= $this->dataTblMember;
		$path	= 'TblMemberSubMail.{n}.' . $display;
		$tmp	= Hash::extract($data, $path);
		
		return join(",\n", $tmp);
	}

	/**
	 * プライマリID(hasMany TblMemberSubMail.{n}.id)
	 * $textTblMemberTblMemberSubMailId	= $ctlHelper->getTextTblMemberTblMemberSubMailId	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailId	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailId($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'id';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * メンバ情報ID(hasMany TblMemberSubMail.{n}.tbl_member_id)
	 * $textTblMemberTblMemberSubMailTblMemberId	= $ctlHelper->getTextTblMemberTblMemberSubMailTblMemberId	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailTblMemberId	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailTblMemberId($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'tbl_member_id';
		$tmp	= $data[$alias][$cnt][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 枝番(hasMany TblMemberSubMail.{n}.branch_no)
	 * $textTblMemberTblMemberSubMailBranchNo	= $ctlHelper->getTextTblMemberTblMemberSubMailBranchNo	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailBranchNo	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailBranchNo($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'branch_no';
		$tmp	= $data[$alias][$cnt][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * メンバのメールアドレス(サブ)(hasMany TblMemberSubMail.{n}.sub_mail)
	 * $textTblMemberTblMemberSubMailSubMail	= $ctlHelper->getTextTblMemberTblMemberSubMailSubMail	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailSubMail	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailSubMail($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'sub_mail';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 作成IP(hasMany TblMemberSubMail.{n}.create_ip)
	 * $textTblMemberTblMemberSubMailCreateIp	= $ctlHelper->getTextTblMemberTblMemberSubMailCreateIp	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailCreateIp	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailCreateIp($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'create_ip';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 更新IP(hasMany TblMemberSubMail.{n}.update_ip)
	 * $textTblMemberTblMemberSubMailUpdateIp	= $ctlHelper->getTextTblMemberTblMemberSubMailUpdateIp	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailUpdateIp	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailUpdateIp($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'update_ip';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 作成日時(hasMany TblMemberSubMail.{n}.created)
	 * $textTblMemberTblMemberSubMailCreated	= $ctlHelper->getTextTblMemberTblMemberSubMailCreated	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailCreated	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailCreated($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'created';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 更新日時(hasMany TblMemberSubMail.{n}.updated)
	 * $textTblMemberTblMemberSubMailUpdated	= $ctlHelper->getTextTblMemberTblMemberSubMailUpdated	($cnt = 0);
	 * <?php echo $textTblMemberTblMemberSubMailUpdated	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblMemberSubMailUpdated($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblMemberSubMail';
		$field	= 'updated';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * hasAndBelongsToManyデータカウント（TblGroup）
	 * $cnt = $ctlHelper->getDataTblMemberTblGroupCount();
	 * @return int
	 */
	public function getDataTblMemberTblGroupCount() {
		return count($this->dataTblMember['TblGroup']);
	}

	/**
	 * hasAndBelongsToMany Displays (TblGroup）
	 * $textTblMemberTblGroupDisplay = $ctlHelper->getTextTblMemberTblGroupDisplay();
	 * <?php $textTblMemberTblGroupDisplay; ?>
	 * @param string
	 * @return string
	 */
	public function getTextTblMemberTblGroupDisplay($display = 'group_name') {
		$data	= $this->dataTblMember;
		$path	= 'TblGroup.{n}.' . $display;
		$tmp	= Hash::extract($data, $path);
		
		return join(",\n", $tmp);
	}

	/**
	 * プライマリID(hasAndBelongsToMany TblGroup.{n}.id)
	 * $textTblMemberTblGroupId	= $ctlHelper->getTextTblMemberTblGroupId	($cnt = 0);
	 * <?php echo $textTblMemberTblGroupId	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblGroupId($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblGroup';
		$field	= 'id';
		$tmp	= $data[$alias][$cnt][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * グループ名(hasAndBelongsToMany TblGroup.{n}.group_name)
	 * $textTblMemberTblGroupGroupName	= $ctlHelper->getTextTblMemberTblGroupGroupName	($cnt = 0);
	 * <?php echo $textTblMemberTblGroupGroupName	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblGroupGroupName($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblGroup';
		$field	= 'group_name';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 所属メンバ数(hasAndBelongsToMany TblGroup.{n}.tbl_member_count)
	 * $textTblMemberTblGroupTblMemberCount	= $ctlHelper->getTextTblMemberTblGroupTblMemberCount	($cnt = 0);
	 * <?php echo $textTblMemberTblGroupTblMemberCount	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblGroupTblMemberCount($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblGroup';
		$field	= 'tbl_member_count';
		$tmp	= $data[$alias][$cnt][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 作成IP(hasAndBelongsToMany TblGroup.{n}.create_ip)
	 * $textTblMemberTblGroupCreateIp	= $ctlHelper->getTextTblMemberTblGroupCreateIp	($cnt = 0);
	 * <?php echo $textTblMemberTblGroupCreateIp	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblGroupCreateIp($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblGroup';
		$field	= 'create_ip';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 更新IP(hasAndBelongsToMany TblGroup.{n}.update_ip)
	 * $textTblMemberTblGroupUpdateIp	= $ctlHelper->getTextTblMemberTblGroupUpdateIp	($cnt = 0);
	 * <?php echo $textTblMemberTblGroupUpdateIp	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblGroupUpdateIp($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblGroup';
		$field	= 'update_ip';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 作成日時(hasAndBelongsToMany TblGroup.{n}.created)
	 * $textTblMemberTblGroupCreated	= $ctlHelper->getTextTblMemberTblGroupCreated	($cnt = 0);
	 * <?php echo $textTblMemberTblGroupCreated	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblGroupCreated($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblGroup';
		$field	= 'created';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 更新日時(hasAndBelongsToMany TblGroup.{n}.updated)
	 * $textTblMemberTblGroupUpdated	= $ctlHelper->getTextTblMemberTblGroupUpdated	($cnt = 0);
	 * <?php echo $textTblMemberTblGroupUpdated	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblMemberTblGroupUpdated($cnt = 0) {
		$data	= $this->dataTblMember;
		$alias	= 'TblGroup';
		$field	= 'updated';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

}