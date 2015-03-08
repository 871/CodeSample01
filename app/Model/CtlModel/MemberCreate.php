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
App::uses('TblMemberSubMail', 'Model');
App::uses('MemberCreateToTblMember', 'Lib/Convert/TblMember');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class MemberCreate extends AppCtlModel {
	
	public $setInputFormFlag = false;
	
	/**
	 * 複数選択可能な入力項目
	 * @var array
	 */
	public static $multipleFields = array(
		'MemberCreate.TblGroup',
	);
	
	public $validate = array();
	
	/**
	 * フォーム設定用のパラメータ
	 * @var type 
	 */
	public $fieldParams = array();
	
	
	public function setInputFormParams() {
		$ctlModel = $this;
		if ($ctlModel->setInputFormFlag === false) {
			self::setInputFormMemberName	($ctlModel);
			self::setInputFormMemberMail		($ctlModel);
			self::setInputFormMemberBirthday($ctlModel);
			self::setInputFormMstSexId		($ctlModel);
			self::setInputFormRemarks		($ctlModel);
			self::setInputFormTblGroup		($ctlModel);
			for ($i = 0, $cnt = TblMemberSubMail::MAX_DATA_COUNT; $i < $cnt; ++$i) {
				self::setInputFormSubMail($ctlModel, $i);
			}
			$ctlModel->setInputFormFlag = true;
		}
	}
	
	private function setInputFormMemberName(self $ctlModel) {
		$fieldName = 'member_name';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'notEmpty' => array(
				'rule'			=> array('notEmpty', ),
				'message'		=> 'メンバー名を入力して下さい',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule'			=> array('maxlength', 50),
				'message'		=> 'メンバー名は50文字以内で入力して下さい',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'checkUnique' => array(
				'rule'			=> array('checkUnique', 'TblMember', 'member_name', null),
				'message'		=> 'このメンバー名は登録済です',
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
	 * メールアドレス
	 * @param self $ctlModel
	 */
	private static function setInputFormMemberMail(self $ctlModel) {
		$fieldName = 'member_mail';
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
				'rule'			=> array('checkUnique', 'TblMember', 'member_mail', null),
				'message'		=> '入力されたメールアドレスは登録済です',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'checkSubMail' => array(
				'rule'			=> array('checkSubMail',),
				'message'		=> '同じメールアドレスが複数入力されています',
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
	 * 生年月日
	 * @param self $ctlModel
	 */
	private static function setInputFormMemberBirthday(self $ctlModel) {
		$fieldName = 'member_birthday';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'date' => array(
				'rule'		=> array('date', ),
				'message'	=> '生年月日の日付が不正です',
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'date',
			'required'		=> true,
		);
	}

	/**
	 * 性別
	 * @param self $ctlModel
	 */
	private static function setInputFormMstSexId(self $ctlModel) {
		$fieldName	= 'mst_sex_id';
		$mstModel	= ClassRegistry::init('MstSex');
		$list		= $mstModel->find('list');
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'inList' => array(
				'rule'		=> array('inList', array_keys($list), false),
				'message'	=> '性別の選択が不正です',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'radio',
			'options'		=> $list,
			'required'		=> true,
		);
	}
	
	/**
	 * 備考
	 * @param self $ctlModel
	 */
	private static function setInputFormRemarks(self $ctlModel) {
		$fieldName = 'remarks';
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'maxlength' => array(
				'rule'			=> array('maxlength', 2000),
				'message'		=> '備考は2000文字以内で入力して下さい',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'textarea',
			'maxlength'		=> 2000,
			'required'		=> false,
		);
	}

	/**
	 * メンバーの所属グループ
	 * @param self $ctlModel
	 */
	private static function setInputFormTblGroup(self $ctlModel) {
		$fieldName	= 'TblGroup';
		$listModel	= ClassRegistry::init('TblGroup');
		$list		= $listModel->find('list');
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'multiple' => array(
				'rule'			=> array('multiple', array('in' => array_keys($list)), false),
				'message'		=> 'グループの選択が不正です',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'select',
			'options'		=> $list,
			'required'		=> false,
			'multiple'		=> 'checkbox',
		);
	}

	/**
	 * 予備のメールアドレス
	 * @param self $ctlModel
	 * @param int $i
	 */
	private static function setInputFormSubMail(self $ctlModel, $i) {
		$fieldName = 'sub_mail_' . $i;
		// バリデーション設定
		$ctlModel->validate[$fieldName] = array(
			'email' => array(
				'rule'		=> array('email',),
				'message'	=> 'メールアドレスのフォーマットが不正です',
				'allowEmpty'	=> true,
			),
			'maxlength' => array(
				'rule'			=> array('maxlength', 200),
				'message'		=> 'E-Mailは200文字以内で入力して下さい',
				'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		);
		// 入力フォーム設定
		$ctlModel->fieldParams[$fieldName] = array(
			'type'			=> 'text',
			'maxlength'		=> 200,
			'required'		=> false,
		);
	}
	
	/**
	 * メールアドレスの重複入力チェック
	 * @param type $check
	 * @return boolean
	 */
	public function checkSubMail($check) {
		$ctlModel	= $this;
		$alias		= $ctlModel->alias;
		$data		= $ctlModel->data;
		
		$mails		= array();
		$mails[]	= is_array($check)? array_shift($check): $check;
		for ($i = 0, $cnt = TblMemberSubMail::MAX_DATA_COUNT; $i < $cnt; ++$i) {
			$value = $data[$alias]['sub_mail_' . $i];
			if (empty($value)) {
				continue;
			}
			$mails[] = $value;
		}
		$uniqueMails	= array_unique($mails);
		$beforeCnt		= count($mails);
		$afterCnt		= count($uniqueMails);
		return ($beforeCnt === $afterCnt)? true: false;
	}

	/**
	 * メンバ情報登録
	 * @param array $data
	 * @return boolean
	 */
	public function saveMember(array $data) {
		$ctlModel = $this;
		$ormModel	= ClassRegistry::init('TblMember');
		
		$ctlModel->set($data);
		$result = $ctlModel->validates();
		if ($result) {
			$convert = new MemberCreateToTblMember($ctlModel, $ormModel);
			$convert->setCtlData($data);
			
			$result = self::saveTransaction($convert);
		}
		return $result;
	}
	
	private static function saveTransaction(MemberCreateToTblMember $convert) {
		$db			= $convert->getDataSource();
		$ctlModel	= $convert->getCtlModel();
		$ormModel	= $convert->getOrmModel();
		$saveData	= $convert->getSaveData();
		
		try {
			$db->begin();
			// アカウント情報
			OrmModelUtil::transactionSaveAssociatedDeep($ormModel, $saveData);
			$db->commit();
		} catch (ErrorException $e) {
			$db->rollback();
			$ctlModel->validationErrors[] = $e->getMessage();
			return false;
		}
		return true;
	}
}