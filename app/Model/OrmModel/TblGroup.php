<?php
App::uses('AppOrmModel', 'Model');
App::uses('OrmModelUtil', 'Lib/Util');

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
			// 更新用ロックデータ作成
			OrmModelUtil::saveLockModelData($lockModel, $id);
		}
	}
	
	public function afterDelete() {
		$id			= $this->id;
		$lockModel	= ClassRegistry::init('TblGroupLock');
		// 更新ロック用データ削除
		OrmModelUtil::deleteLockModelData($lockModel, $id);
	}
}
