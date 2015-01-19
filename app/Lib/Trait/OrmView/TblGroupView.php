<?php 


trait TblGroupView {

	/**
	 * TblGroup
	 * @var array<TblGroup::$data>
	 */
	private $dataTblGroup = array();

	/**
	 * TblGroup::$data
	 * if (!isset($dataTblGroup))	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
	 * $ctlHelper->setDataTblGroup($dataTblGroup);
	 * @param array $dataTblGroup
	 */
	public function setDataTblGroup(array $dataTblGroup) {
		$this->dataTblGroup = $dataTblGroup;
	}

	/**
	 * プライマリID
	 * $textTblGroupId	= $ctlHelper->getTextTblGroupId	();
	 * <?php echo $textTblGroupId	; ?>
	 * @return string
	 */
	public function getTextTblGroupId() {
		$data	= $this->dataTblGroup;
		$alias	= 'TblGroup';
		$field	= 'id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * グループ名
	 * $textTblGroupGroupName	= $ctlHelper->getTextTblGroupGroupName	();
	 * <?php echo $textTblGroupGroupName	; ?>
	 * @return string
	 */
	public function getTextTblGroupGroupName() {
		$data	= $this->dataTblGroup;
		$alias	= 'TblGroup';
		$field	= 'group_name';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 所属メンバ数
	 * $textTblGroupTblMemberCount	= $ctlHelper->getTextTblGroupTblMemberCount	();
	 * <?php echo $textTblGroupTblMemberCount	; ?>
	 * @return string
	 */
	public function getTextTblGroupTblMemberCount() {
		$data	= $this->dataTblGroup;
		$alias	= 'TblGroup';
		$field	= 'tbl_member_count';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 作成IP
	 * $textTblGroupCreateIp	= $ctlHelper->getTextTblGroupCreateIp	();
	 * <?php echo $textTblGroupCreateIp	; ?>
	 * @return string
	 */
	public function getTextTblGroupCreateIp() {
		$data	= $this->dataTblGroup;
		$alias	= 'TblGroup';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新IP
	 * $textTblGroupUpdateIp	= $ctlHelper->getTextTblGroupUpdateIp	();
	 * <?php echo $textTblGroupUpdateIp	; ?>
	 * @return string
	 */
	public function getTextTblGroupUpdateIp() {
		$data	= $this->dataTblGroup;
		$alias	= 'TblGroup';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時
	 * $textTblGroupCreated	= $ctlHelper->getTextTblGroupCreated	();
	 * <?php echo $textTblGroupCreated	; ?>
	 * @return string
	 */
	public function getTextTblGroupCreated() {
		$data	= $this->dataTblGroup;
		$alias	= 'TblGroup';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時
	 * $textTblGroupUpdated	= $ctlHelper->getTextTblGroupUpdated	();
	 * <?php echo $textTblGroupUpdated	; ?>
	 * @return string
	 */
	public function getTextTblGroupUpdated() {
		$data	= $this->dataTblGroup;
		$alias	= 'TblGroup';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * hasAndBelongsToManyデータカウント（TblMember）
	 * $cnt = $ctlHelper->getDataTblGroupTblMemberCount();
	 * @return int
	 */
	public function getDataTblGroupTblMemberCount() {
		return count($this->dataTblGroup['TblMember']);
	}

	/**
	 * hasAndBelongsToMany Displays (TblMember）
	 * $textTblGroupTblMemberDisplay = $ctlHelper->getTextTblGroupTblMemberDisplay();
	 * <?php $textTblGroupTblMemberDisplay; ?>
	 * @param string
	 * @return string
	 */
	public function getTextTblGroupTblMemberDisplay($display = 'member_name') {
		$data	= $this->dataTblGroup;
		$path	= 'TblMember.{n}.' . $display;
		$tmp	= Hash::extract($data, $path);
		
		return join(",\n", $tmp);
	}

	/**
	 * プライマリID(hasAndBelongsToMany TblMember.{n}.id)
	 * $textTblGroupTblMemberId	= $ctlHelper->getTextTblGroupTblMemberId	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberId	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberId($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'id';
		$tmp	= $data[$alias][$cnt][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * メンバ名(hasAndBelongsToMany TblMember.{n}.member_name)
	 * $textTblGroupTblMemberMemberName	= $ctlHelper->getTextTblGroupTblMemberMemberName	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberMemberName	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberMemberName($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'member_name';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * メンバのメールアドレス(hasAndBelongsToMany TblMember.{n}.member_mail)
	 * $textTblGroupTblMemberMemberMail	= $ctlHelper->getTextTblGroupTblMemberMemberMail	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberMemberMail	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberMemberMail($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'member_mail';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 生年月日(hasAndBelongsToMany TblMember.{n}.member_birthday)
	 * $textTblGroupTblMemberMemberBirthday	= $ctlHelper->getTextTblGroupTblMemberMemberBirthday	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberMemberBirthday	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberMemberBirthday($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 性別ID(hasAndBelongsToMany TblMember.{n}.mst_sex_id)
	 * $textTblGroupTblMemberMstSexId	= $ctlHelper->getTextTblGroupTblMemberMstSexId	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberMstSexId	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberMstSexId($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'mst_sex_id';
		$tmp	= $data[$alias][$cnt][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 所属グループ数(hasAndBelongsToMany TblMember.{n}.tbl_group_count)
	 * $textTblGroupTblMemberTblGroupCount	= $ctlHelper->getTextTblGroupTblMemberTblGroupCount	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberTblGroupCount	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberTblGroupCount($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'tbl_group_count';
		$tmp	= $data[$alias][$cnt][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * 作成IP(hasAndBelongsToMany TblMember.{n}.create_ip)
	 * $textTblGroupTblMemberCreateIp	= $ctlHelper->getTextTblGroupTblMemberCreateIp	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberCreateIp	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberCreateIp($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'create_ip';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 更新IP(hasAndBelongsToMany TblMember.{n}.update_ip)
	 * $textTblGroupTblMemberUpdateIp	= $ctlHelper->getTextTblGroupTblMemberUpdateIp	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberUpdateIp	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberUpdateIp($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'update_ip';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 作成日時(hasAndBelongsToMany TblMember.{n}.created)
	 * $textTblGroupTblMemberCreated	= $ctlHelper->getTextTblGroupTblMemberCreated	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberCreated	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberCreated($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'created';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

	/**
	 * 更新日時(hasAndBelongsToMany TblMember.{n}.updated)
	 * $textTblGroupTblMemberUpdated	= $ctlHelper->getTextTblGroupTblMemberUpdated	($cnt = 0);
	 * <?php echo $textTblGroupTblMemberUpdated	; ?>
	 * @param int $cnt
	 * @return string
	 */
	public function getTextTblGroupTblMemberUpdated($cnt = 0) {
		$data	= $this->dataTblGroup;
		$alias	= 'TblMember';
		$field	= 'updated';
		$value	= $data[$alias][$cnt][$field];
		
		return h($value);
	}

}