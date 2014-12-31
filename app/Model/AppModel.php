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

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	const INT_MAX_LEN = 11;
	
	/**
	 * 日付入力チェック
	 * @param type $check
	 * @return boolean
	 */
	public function date($check) {
		$check = is_array($check)? array_shift($check): $check;
		if (is_string($check)) {
			return strtotime($check);
		} else if (isset($check['year']) && isset($check['month']) && isset($check['day'])) {
			return checkdate($check['month'], $check['day'], $check['year']);
		}
		return false;
	}
	
	/**
	 * 全角カナの入力チェック
	 * @param type $check
	 * @return boolean
	 */
	public function checkKana($check) {
		$pattern = '/^[ァ-ヶー ]+$/u';
		$check = is_string($check)? $check: array_shift($check);
		return preg_match($pattern, $check);
	}
}