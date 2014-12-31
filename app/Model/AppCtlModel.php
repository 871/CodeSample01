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

App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
abstract class AppCtlModel extends AppModel {
	const TMP_REQUEST_SESSION_KEY = 'tmp.Request';
	
	public static $multipleFields = array();

	public $validationErrors = array();
	
	public $validationWarnings = array();
	
	public $validationSuccesses = array();
	
	public $useTable = false;
	
	public $validate = array();
	
	/**
	 * フォーム設定用のパラメータ
	 * @var type 
	 */
	public $fieldParams = array();
	
	/**
	 * リクエストパラメータをセッションに設定
	 * @param SessionComponent $session
	 * @param CakeRequest $request
	 * @param string $sessionKey
	 */
	public static function setRequestToSessionData(
			SessionComponent $session, CakeRequest $request, $sessionKey = null) {

		$sessionKey = is_null($sessionKey)
				? static::TMP_REQUEST_SESSION_KEY: $sessionKey;
		if (empty($sessionKey)) {
			throw new RuntimeException();
		}
		$dataSession	= $session->check($sessionKey)? $session->read($sessionKey): array();
		$dataRequest	= $request->data;
		
		$multipleFields = static::$multipleFields;
		for ($i = 0, $cnt =count($multipleFields); $i < $cnt; ++$i) {
			$tmp	= $multipleFields[$i];
			$arrTmp	= explode('.', $tmp);
			$alias	= $arrTmp[0];
			$field	= $arrTmp[1];
			if (isset($dataSession[$alias][$field]) && isset($dataRequest[$alias][$field])) {
				unset($dataSession[$alias][$field]);
			}
		}
		
		$data = Hash::merge($dataSession, $dataRequest);
		$session->write($sessionKey, $data);
	}
	
	/**
	 * セッションをリクエストパラメータに設定
	 * 
	 * @param CakeRequest $request
	 * @param SessionComponent $session
	 * @param type $sessionKey
	 * @throws RuntimeException
	 */
	public static function setSessionToRequestData(
			CakeRequest $request, SessionComponent $session, $sessionKey = null) {

		$sessionKey = is_null($sessionKey)
				? static::TMP_REQUEST_SESSION_KEY: $sessionKey;
		if (empty($sessionKey)) {
			throw new RuntimeException();
		}
		
		$dataSession	= $session->check($sessionKey)? $session->read($sessionKey): array();
		$dataRequest	= $request->data;
		
		$multipleFields = static::$multipleFields;
		for ($i = 0, $cnt =count($multipleFields); $i < $cnt; ++$i) {
			$tmp	= $multipleFields[$i];
			$arrTmp	= explode('.', $tmp);
			$alias	= $arrTmp[0];
			$field	= $arrTmp[1];
			if (isset($dataSession[$alias][$field]) && isset($dataRequest[$alias][$field])) {
				unset($dataSession[$alias][$field]);
			}
		}
		
		$request->data = Hash::merge($dataSession, $dataRequest);
	}
	
	/**
	 * セッションに保存されたリクエストパラメータを破棄
	 * @param SessionComponent $session
	 */
	public static function deleteRequestSessionData(SessionComponent $session) {
		$session->delete(static::TMP_REQUEST_SESSION_KEY);
	}

	/**
	 * フォーム設定用のパラメータを取得する
	 * (ExtFormHelper内部で使用する)
	 * 
	 * @param String $fieldName
	 * @return Array
	 */
	public function getFormParams($fieldName) {
		$fieldParams = $this->fieldParams;
		if (isset($fieldParams[$fieldName]) && is_array($fieldParams[$fieldName])) {
			return $fieldParams[$fieldName];
		} else {
			return array();
		}
	}
	
	/**
	 * 入力確認用バリデーション
	 * 
	 * @param mix $check
	 * @param string $confField
	 * @return boolean
	 */
	public function checkInputConf($check, $confField) {
		$model = $this;
		$check = is_array($check)? array_shift($check): $check;
		return $model->data[$model->alias][$confField] === $check;
	}
	
	/**
	 * 更新確認用バリデーション
	 * 
	 * @param mix $check
	 * @param string $dbModelName
	 * @param string $dbModelPrimaryKeyFieldName
	 * @return boolean
	 */
	public function edited($check, $dbModelName, $dbModelPrimaryKeyFieldName) {
		$model		= $this;
		$dbModel	= ClassRegistry::init($dbModelName);
		$alias			= $model->alias;
		$dbModelAlias	= $dbModel->alias;
		$id			= $model->data[$alias][$dbModelPrimaryKeyFieldName];
		$updated	= is_array($check)? array_shift($check): $check;
		
		$tmpRecursive = $dbModel->recursive;
		$dbModel->recursive = -1;
		$result = $dbModel->read(array('updated'), $id);
		$dbModel->recursive = $tmpRecursive;
		return $result[$dbModelAlias]['updated'] === $updated;
	}
	
	/**
	 * 重複確認用バリデーション
	 * (Ctlモデル用)
	 * @param mix $check
	 * @param string $dbModelName
	 * @param string $uniqueFieldName
	 * @param string $primaryIdFieldName
	 * @return boolean
	 */
	public function checkUnique($check, $dbModelName, $uniqueFieldName = null, $primaryIdFieldName = null) {
		$ctlModel	= $this;
		$dbModel	= ClassRegistry::init($dbModelName);
		foreach ($check as $key => $val) {
			$uniqueFieldName	= is_string($uniqueFieldName)? $uniqueFieldName: $key;
			$value				= $val;
		}
		
		$ctlModelAlias	= $ctlModel->alias;
		$conditions = array(
			$uniqueFieldName => $value
		);
		
		if (!is_null($primaryIdFieldName)
			&& isset($ctlModel->data[$ctlModelAlias][$primaryIdFieldName])) {
			$tmpValue = $ctlModel->data[$ctlModelAlias][$primaryIdFieldName];
			$conditions[$dbModel->primaryKey . ' !='] = $tmpValue;
		}
		
		$options = array(
			'conditions' => $conditions,
			'recursive' => -1,
		);
		return !$dbModel->find('count', $options);
	}
	
	/**
	 * 
	 * @param type $id
	 * @return boolean
	 */
	public function exists($id = null) {
		return true;
	}
}