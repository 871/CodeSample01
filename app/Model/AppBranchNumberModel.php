<?php
App::uses('AppModel', 'Model');

/**
 * AppBranchNumber Model
 *
 */
abstract class AppBranchNumberModel extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField	= 'max_branch_no';
	
	/**
	 * 親テーブルのプライマリキー
	 *
	 * @var type 
	 */
	public $parentIdField = null;
	
	/**
	 * 親テーブルのプライマリキーの固定長
	 *
	 * @var type 
	 */
	public $parentIdLength = null;

	/**
	 * 新規に枝番を取得する
	 * 
	 * @param type $params
	 * @return type
	 */
	public function getBranchNo($params) {
		$model = $this;
		$parentIdField	= $model->parentIdField;
		$parentIdLength = $model->parentIdLength;
		
		$parentId = $params[$parentIdField];
		// String型のプライマリIDを作成する
		$id = self::_createStringPrimaryId($parentId, $parentIdLength);
		// 更新対象データをロックする（LogicException）
		self::_rowDataRock($model, $id);
		// 枝番の最大値を取得する
		$maxBranchNo = self::_findMaxBranchNo($model, $id);
		// 枝番の最大値を更新する
		++$maxBranchNo;
		// 更新した枝番の最大値を保存する（LogicException）
		self::_saveBranchNo($model, $id, $parentId, $maxBranchNo);
		// 更新した枝番の最大値を返す
		return $maxBranchNo;
	}
	
	/**
	 * String型のプライマリIDを作成する
	 * 
	 * @param type $parentId
	 * @param type $parentIdLength
	 * @return string
	 */
	private static function _createStringPrimaryId($parentId, $parentIdLength) {
		return str_pad($parentId, $parentIdLength, "0", STR_PAD_LEFT);
	}
	
	/**
	 * 枝番の最大値を取得する
	 * 
	 * @param self $model
	 * @param type $userId
	 * @return int
	 */
	private static function _findMaxBranchNo(self $model, $id) {
		$result = $model->read(array($model->displayField), $id);
		if (empty($result)) {
			return 0;
		} else {
			return $result[$model->alias][$model->displayField];
		}
	}
	
	/**
	 * 更新した枝番の最大値を保存する
	 * 
	 * @param self $model
	 * @param type $id
	 * @param type $userId
	 * @param type $maxBranchNo
	 * @return boolean
	 * @throws LogicException
	 */
	private static function _saveBranchNo(self $model, $id, $parentId, $maxBranchNo) {
		$data = array(
			$model->alias => array(
				$model->primaryKey		=> $id,
				$model->parentIdField	=> $parentId,
				$model->displayField	=> $maxBranchNo,
			),
		);
		if ($model->save($data)) {
			return true;
		} else {
			throw new LogicException($model->name . '::_saveBranchNo()');
		}
	}
	
	/**
	 * データロック用のsql発行
	 * 
	 * @param string $id
	 * @return boolean
	 */
	protected static function _rowDataRock(self $model, $id) {
		$pKey = $model->primaryKey;
		$options = array(
			'fields' => array($pKey),
			'recursive' => -1,
			'conditions' => array(
				$pKey => $id,
				'1=1 FOR UPDATE',
			),
		);
		$model->find('all', $options);
 	}
}
