<?php
App::uses('AppOrmModel', 'Model');
/**
 * TblMemberDetail Model
 *
 * @property TblMember $TblMember
 */
class TblMemberDetail extends AppOrmModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'tbl_member_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'checkStringIdFormat' => array(
				'rule' => array('checkStringIdFormat'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tbl_member_id' => array(
			'checkBelongsToData' => array(
				'rule' => array('checkBelongsToData', 'TblMember',),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'TblMember' => array(
			'className' => 'TblMember',
			'foreignKey' => 'tbl_member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * 文字列型プライマリIDを作成
	 * (over raid)
	 * @return string
	 */
	public function createStringId($tbl_member_id) {
		return str_pad($tbl_member_id, 11, '0', STR_PAD_LEFT);
	}
	
	/**
	 * 文字列型プライマリIDのチェック
	 * (over raid)
	 * @param mix $check
	 * @return boolean
	 */
	public function checkStringIdFormat($check) {
		$ormModel	= $this;
		$alias		= $ormModel->alias;
		$data		= $ormModel->data;
		$check		= is_array($check)? array_shift($check): $check;
		
		$tbl_member_id = $data[$alias]['tbl_member_id'];
		$checkId = $ormModel->createStringId($tbl_member_id);
		return ($check === $checkId)? true: false;
	}
}
