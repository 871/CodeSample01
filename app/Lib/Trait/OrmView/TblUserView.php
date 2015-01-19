<?php 


trait TblUserView {

	/**
	 * TblUser
	 * @var array<TblUser::$data>
	 */
	private $dataTblUser = array();

	/**
	 * TblUser::$data
	 * if (!isset($dataTblUser))	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
	 * $ctlHelper->setDataTblUser($dataTblUser);
	 * @param array $dataTblUser
	 */
	public function setDataTblUser(array $dataTblUser) {
		$this->dataTblUser = $dataTblUser;
	}

	/**
	 * プライマリID
	 * $textTblUserId	= $ctlHelper->getTextTblUserId	();
	 * <?php echo $textTblUserId	; ?>
	 * @return string
	 */
	public function getTextTblUserId() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'id';
		$tmp	= $data[$alias][$field];
		$value	= number_format((int) $tmp);
		
		return h($value);
	}

	/**
	 * ユーザ名
	 * $textTblUserUserName	= $ctlHelper->getTextTblUserUserName	();
	 * <?php echo $textTblUserUserName	; ?>
	 * @return string
	 */
	public function getTextTblUserUserName() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'user_name';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * ユーザのメールアドレス
	 * $textTblUserUserMail	= $ctlHelper->getTextTblUserUserMail	();
	 * <?php echo $textTblUserUserMail	; ?>
	 * @return string
	 */
	public function getTextTblUserUserMail() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'user_mail';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * パスワード(ハッシュ)
	 * $textTblUserPassword	= $ctlHelper->getTextTblUserPassword	();
	 * <?php echo $textTblUserPassword	; ?>
	 * @return string
	 */
	public function getTextTblUserPassword() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'password';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * パスワード
	 * $textTblUserUserPassword	= $ctlHelper->getTextTblUserUserPassword	();
	 * <?php echo $textTblUserUserPassword	; ?>
	 * @return string
	 */
	public function getTextTblUserUserPassword() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'user_password';
		$value	= $data[$alias][$field];
		
		return nl2br(h($value));
	}

	/**
	 * ログイン可能フラグ
	 * $textTblUserLoginFlag	= $ctlHelper->getTextTblUserLoginFlag	();
	 * <?php echo $textTblUserLoginFlag	; ?>
	 * @param string $true
	 * @param string $false
	 * @return string
	 */
	public function getTextTblUserLoginFlag($true = '可', $false = '不可') {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'login_flag';
		$flag	= $data[$alias][$field];
		$value	= $flag? $true: $false;
		
		return h($value);
	}

	/**
	 * 作成IP
	 * $textTblUserCreateIp	= $ctlHelper->getTextTblUserCreateIp	();
	 * <?php echo $textTblUserCreateIp	; ?>
	 * @return string
	 */
	public function getTextTblUserCreateIp() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'create_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新IP
	 * $textTblUserUpdateIp	= $ctlHelper->getTextTblUserUpdateIp	();
	 * <?php echo $textTblUserUpdateIp	; ?>
	 * @return string
	 */
	public function getTextTblUserUpdateIp() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'update_ip';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 作成日時
	 * $textTblUserCreated	= $ctlHelper->getTextTblUserCreated	();
	 * <?php echo $textTblUserCreated	; ?>
	 * @return string
	 */
	public function getTextTblUserCreated() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'created';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

	/**
	 * 更新日時
	 * $textTblUserUpdated	= $ctlHelper->getTextTblUserUpdated	();
	 * <?php echo $textTblUserUpdated	; ?>
	 * @return string
	 */
	public function getTextTblUserUpdated() {
		$data	= $this->dataTblUser;
		$alias	= 'TblUser';
		$field	= 'updated';
		$value	= $data[$alias][$field];
		
		return h($value);
	}

}