<?php
App::uses('AppOrmModel', 'Model');
/**
 * TblMember Model
 *
 * @property TblMemberDetail $TblMemberDetail
 * @property MstSex $MstSex
 * @property TblMemberSubMail $TblMemberSubMail
 * @property TblGroup $TblGroup
 * @property HabtmCounterCacheBehavior $HabtmCounterCache
 */
class TblMember extends AppOrmModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'member_name';

	public $actsAs = array('HabtmCounterCache',);
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mst_sex_id' => array(
			'checkBelongsToData' => array(
				'rule' => array('checkBelongsToData', 'MstSex',),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'TblMemberDetail' => array(
			'className' => 'TblMemberDetail',
			'foreignKey' => 'tbl_member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MstSex' => array(
			'className' => 'MstSex',
			'foreignKey' => 'mst_sex_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TblMemberSubMail' => array(
			'className' => 'TblMemberSubMail',
			'foreignKey' => 'tbl_member_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'TblGroup' => array(
			'className' => 'TblGroup',
			'joinTable' => 'tbl_members_tbl_groups',
			'foreignKey' => 'tbl_member_id',
			'associationForeignKey' => 'tbl_group_id',
			'counterCache'	=> 'tbl_member_count',
			'unique' => 'keepExisting',
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
			$lockModel	= ClassRegistry::init('TblMemberLock');
			self::saveTblMemberLock($lockModel, $id);
		}
	}
	
	/**
	 * ロック用データ作成
	 * @param TblMemberLock $lockModel
	 * @param type $id
	 * @throws ErrorException
	 */
	private static function saveTblMemberLock(TblMemberLock $lockModel, $id) {
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
}