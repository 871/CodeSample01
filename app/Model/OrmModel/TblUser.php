<?php
App::uses('AppOrmModel', 'Model');
App::uses('Security', 'Utility');

/**
 * TblUser Model
 *
 */
class TblUser extends AppOrmModel {

	// 暗号化複合化処理キー
	const CIPHER_KEY = 'Xi8rgy094e.fRgrjgrggU3q0F7iyq95Tiuvq@,kc';
	
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_name';
	
	
	
	public function beforeSave($options = array()) {
		// パスワードをハッシュ化する
		self::_hashPasswordSetting($this);
		return parent::beforeSave($options);
	}
	
	/**
	 * パスワードをハッシュ化する
	 */
	private static function _hashPasswordSetting(self $model) {
		$alias			= $model->alias;
		$passwordKey	= 'password';
		$passwordKeyBak = 'user_password';
		
		// パスワードのハッシュ化処理
		if (isset($model->data[$alias][$passwordKey])) {
			$password	= $model->data[$alias][$passwordKey];
			$tmp		= Security::rijndael($password, self::CIPHER_KEY, 'encrypt');
			$model->data[$alias][$passwordKeyBak]	= base64_encode($tmp);
			$model->data[$alias][$passwordKey]		= Security::hash($password, null, true);
		}
	}
	
	/**
	 * パスワードの複合化
	 * @param type $user_password
	 * @return string
	 */
	public function passwordDecrypt($user_password) {
		$password = base64_decode($user_password);
		return Security::rijndael($password, self::CIPHER_KEY, 'decrypt');
	}
}
