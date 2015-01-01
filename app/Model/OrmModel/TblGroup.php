<?php
App::uses('AppOrmModel', 'Model');
/**
 * TblGroup Model
 *
 * @property TblMember $TblMember
 * @property HabtmCounterCacheBehavior $HabtmCounterCache
 */
class TblGroup extends AppOrmModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'group_name';

	public $actsAs = array('HabtmCounterCache',);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'TblMember' => array(
			'className' => 'TblMember',
			'joinTable' => 'tbl_members_tbl_groups',
			'foreignKey' => 'tbl_group_id',
			'associationForeignKey' => 'tbl_member_id',
			'unique' => 'keepExisting',
			'counterCache'	=> 'tbl_group_count',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
	);
	
	
	public function afterSave($created, $options = array()) {
		if ($created) {
			$id			= $this->getID();
			$lockModel	= ClassRegistry::init('TblGroupLock');
			self::saveTblGroupLock($lockModel, $id);
		}
	}
	
	/**
	 * ロック用データ作成
	 * @param TblGroupLock $lockModel
	 * @param type $id
	 * @throws ErrorException
	 */
	private static function saveTblGroupLock(TblGroupLock $lockModel, $id) {
		$data = array(
			$lockModel->alias => array(
				$lockModel->primaryKey => $id,
			),
		);
		$result = $lockModel->save($data);
		if (!$result) {
			throw new ErrorException();
		}
	}
	
	
	public function afterDelete() {
		$id			= $this->id;
		$lockModel	= ClassRegistry::init('TblGroupLock');
		// 更新ロック用データ削除
		self::deleteTblGroupLock($lockModel, $id);
	}
	
	/**
	 * 更新ロック用データ削除
	 * @param TblGroupLock $lockModel
	 * @param type $id
	 * @throws ErrorException
	 */
	private static function deleteTblGroupLock(TblGroupLock $lockModel, $id) {
		$result = $lockModel->delete($id);
		if (!$result) {
			throw new ErrorException();
		}
	}

}
