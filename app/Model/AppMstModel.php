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
abstract class AppMstModel extends AppModel {
	
	/**
	 * DBテーブルからの取得値と同様の値を設定する
	 * （DBアクセス回数抑止のためのキャッシュ項目）
	 *
	 * @var type 
	 */
	protected $_listDataCache = array();

	/**
	 * 論理削除日付フィールド名
	 * @var type 
	 */
	public $deleted = 'deleted';
	
	/**
	 * 表示順フィールド名
	 * @var type 
	 */
	public $sort = 'sort';
	
	/**
	 * 論理削除処理フラグ
	 * @var type 
	 */
	public $logicDeleteFlag = true;
	
	/**
	 * 論理削除日付フォーマット
	 * @var type 
	 */
	public $deleteDateFormat = 'Y-m-d H:i:s';
	
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';
	
	public $virtualFields = array(
		'v_deleted_flag'	=> 'CASE WHEN deleted IS NULL THEN 0 ELSE 1 END',
	);
	
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => '表示名称を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 50),
				'message' => '表示名称は５０文字以内で入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'この表示名称は登録済です',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sort' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => '表示順を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => '表示順は整数値で入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public function find($type = 'first', $query = array()) {
		$model = $this;
		if ($type === 'list' && empty($query) && !empty($model->_listDataCache)) {
			return $model->_listDataCache;
		}
		$deleted	= $model->deleted;
		$sort		= $model->sort;
		$deleteFlag	= $model->logicDeleteFlag;
		if (!isset($query['conditions'])) {
			$query['conditions'] = array();
		}
		if ($deleteFlag) {
			$query['conditions'][$deleted] = null;
		}
		if (!isset($query['order']) && empty($query['order'])) {
			$query['order'] = array($sort => 'ASC');
		}
		return parent::find($type, $query);
	}

	/**
	 * 保存対象のデータを設定する
	 * 
	 * @param type $one
	 * @param type $two
	 * @return type
	 */
	public function set($one, $two = null) {
		$deleted	= $this->deleted;
		$alias		= $this->alias;
		$deleteFlag	= $this->logicDeleteFlag;
		
		if ($deleteFlag && isset($one[$alias][$deleted])) {
			unset($one[$alias][$deleted]);
		}
		return parent::set($one, $two);
	}
	
	/**
	 * データを論理削除する
	 * 
	 * @param int $id
	 * @return boolean
	 */
	public function delete($id = null) {
		$id			= empty($id)? $this->id: $id;
		$deleted	= $this->deleted;
		$alias		= $this->alias;
		$format		= $this->deleteDateFormat;
		$primaryKey	= $this->primaryKey;
		$time		= $this->_time();
		
		$data = array(
			$alias => array(
				$primaryKey	=> $id,
				$deleted	=> date($format, $time),
			),
		);
		$this->logicDeleteFlag = false;
		return parent::save($data, false);
	}
	
	/**
	 * 現在のタイムスタンプを取得する
	 * 
	 * @return int
	 */
	protected function _time() {
		return time();
	}
}