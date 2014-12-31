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

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class TplCtlModel extends AppCtlModel {
	
	public $validationErrors = array();
	
	public $validationWarnings = array();
	
	public $validationSuccesses = array();
	
	public $validate = array();
	
	
	/**
	 * フォーム設定用のパラメータ
	 * @var type 
	 */
	public $fieldParams = array();
	
	/**
	 * 入力データの変換
	 * array(
	 *		'inputFiledName'	=> inputFiledName,
	 *		'dbModelName'		=> dbModelName,
	 *		'dbModelFieldName'	=> dbModelFieldName,
	 *		'fixedValue'		=> fixedValue
	 *		'mappingMethod'		=> mappingMethod,
	 *		'mappingOptions'	=> mappingOptions,
	 *		'unMappingMethod'	=> unMappingMethod,
	 *		'unMappingOptions'	=> unMappingOptions,
	 * ),
	 * ・・・
	 * 
	 * @var type 
	 */
	public $inputMappings = array();
	
	
}