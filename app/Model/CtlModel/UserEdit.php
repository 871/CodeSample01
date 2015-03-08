<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppCtlModel', 'Model');
App::uses('OrmModelUtil', 'Lib/Util');
App::uses('UserEditFromTblUser', 'Lib/Convert/TblUser');
App::uses('UserEditToTblUser', 'Lib/Convert/TblUser');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class UserEdit extends AppCtlModel {
	
	const TMP_REQUEST_SESSION_KEY = 'tmp.Request.UserEdit';
	
	private $setInputFormFlag = false;


	public $validate = array();
	
	/**
	 * フォーム設定用のパラメータ
	 * @var type 
	 */
	public $fieldParams = array();
	
	
	public function setEditDataToRequest(CakeRequest $request, $tbl_user_id) {
		$ctlModel	= $this;
		$ormModel	= ClassRegistry::init('TblUser');
		$ormData	= self::findTblUser($ormModel, $tbl_user_id);
		
		$convert = new UserEditFromTblUser($ctlModel, $ormModel);
		$convert->setOrmData($ormData);
		$ctlData = $convert->getCtlData();
		
		$request->data = $ctlData;
	}
	
	private static function findTblUser(TblUser $tblUser, $tbl_user_id) {
		return $tblUser->read(null, $tbl_user_id);
	}

	public function setInputFormParams() {
		$ctlModel = $this;
		if ($ctlModel->setInputFormFlag === false) {
			self::setInputFormUserId		($ctlModel);
			self::setInputFormUserName		($ctlModel);
			self::setInputFormUserMail		($ctlModel);
			self::setInputFormPassword		($ctlModel);
			self::setInputFormPasswordConf	($ctlModel);
			self::setInputFormLoginFlag		($ctlModel);
			$ctlModel->setInputFormFlag = true;
		}
	}
	
	/**
	 * 管理者名の項目に関連したパラメータを設定
	 * @staticvar boolean $flag
	 * @param self $ctlModel
	 */
	private function setInputFormUserId(self $ctlModel) {
		$fieldName = 'id';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'notEmpty' => array(
				'rule'			=> array('notEmpty', ),
				'message'		=> '管理者IDが不正です',
				// 'allowEmpty'	=> true,
				'required'	=> true,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule'			=> array('numeric',),
				'message'		=> '管理者IDが不正です',
				// 'allowEmpty'	=> true,
				'required'	=> true,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'hidden',
			'required'		=> true,
		);
	}
	
	/**
	 * 管理者名の項目に関連したパラメータを設定
	 * @staticvar boolean $flag
	 * @param self $ctlModel
	 */
	private function setInputFormUserName(self $ctlModel) {
		$fieldName = 'user_name';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'notEmpty' => array(
				'rule'			=> array('notEmpty', ),
				'message'		=> '管理者名を入力して下さい',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule'			=> array('maxlength', 50),
				'message'		=> '管理者名は50文字以内で入力して下さい',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'checkUnique' => array(
				'rule'			=> array('checkUnique', 'TblUser', 'user_name', 'id'),
				'message'		=> 'この管理者名は登録済です',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'text',
			'maxlength'		=> 50,
			'required'		=> true,
		);
	}
	
	/**
	 * E-Mailの項目に関連したパラメータを設定
	 * @staticvar boolean $flag
	 * @param self $ctlModel
	 */
	private static function setInputFormUserMail(self $ctlModel) {
		$fieldName = 'user_mail';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'notEmpty' => array(
				'rule'			=> array('notEmpty', ),
				'message'		=> 'E-Mailを入力して下さい',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule'		=> array('email',),
				'message'	=> 'メールアドレスのフォーマットが不正です',
			),
			'maxlength' => array(
				'rule'			=> array('maxlength', 200),
				'message'		=> 'E-Mailは200文字以内で入力して下さい',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'checkUnique' => array(
				'rule'			=> array('checkUnique', 'TblUser', 'user_mail', 'id'),
				'message'		=> '入力されたメールアドレスは登録済です',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'text',
			'maxlength'		=> 200,
			'required'		=> true,
		);
	}
	
	/**
	 * パスワード
	 * @param self $ctlModel
	 */
	private static function setInputFormPassword(self $ctlModel) {
		$fieldName = 'password';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'notEmpty' => array(
				'rule'			=> array('notEmpty', ),
				'message'		=> 'パスワードを入力して下さい',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
				'rule'			=> array('between', 5, 15),
				'message'		=> 'パスワードは5文字以上、15文字以下で入力してください',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'password',
			'required'		=> true,
		);
	}
	
	/**
	 * パスワード(確認)の項目に関連したパラメータを設定
	 * @staticvar boolean $flag
	 * @param self $ctlModel
	 */
	private static function setInputFormPasswordConf(self $ctlModel) {
		$fieldName = 'password_conf';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'notEmpty' => array(
				'rule'			=> array('notEmpty', ),
				'message'		=> 'パスワード(確認)を入力して下さい',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'checkInputConf' => array(
				'rule'			=> array('checkInputConf', 'password'),
				'message'		=> '入力されたパスワードが異なります',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'password',
			'required'		=> true,
		);
	}
	
	/**
	 * ログインフラグ
	 * @param self $ctlModel
	 */
	private static function setInputFormLoginFlag(self $ctlModel) {
		$fieldName = 'login_flag';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'boolean' => array(
				'rule'			=> array('boolean', ),
				'message'		=> 'ログインフラグの選択画布性です',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'checkbox',
			'required'		=> false,
			'options'	=> array(
				0	=> 'ログイン不可',
				1	=> 'ログイン可',
			),
		);
	}
	
	/**
	 * アカウント登録
	 * @param array $data
	 * @return boolean
	 */
	public function saveUser(array $data) {
		$ctlModel	= $this;
		$ormModel	= ClassRegistry::init('TblUser');
		
		$ctlModel->set($data);
		$result = $ctlModel->validates();
		if ($result) {
			$convert = new UserEditToTblUser($ctlModel, $ormModel);
			$convert->setCtlData($data);
			
			$result = self::saveTransaction($convert);
		}
		return $result;
	}
	
	private static function saveTransaction(UserEditToTblUser $convert) {
		$db			= $convert->getDataSource();
		$ctlModel	= $convert->getCtlModel();
		$ormModel	= $convert->getOrmModel();
		$saveData	= $convert->getSaveData();
		
		try {
			$db->begin();
			// アカウント情報
			OrmModelUtil::transactionSave($ormModel, $saveData);
			$db->commit();
		} catch (ErrorException $e) {
			$db->rollback();
			$ctlModel->validationErrors[] = $e->getMessage();
			return false;
		}
		return true;
	}
}