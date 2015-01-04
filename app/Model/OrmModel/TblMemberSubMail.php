<?php
App::uses('AppOrmModel', 'Model');
/**
 * TblMemberSubMail Model
 *
 * @property TblMember $TblMember
 */
class TblMemberSubMail extends AppOrmModel {
	
	const MAX_DATA_COUNT = 10;

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'sub_mail';

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
				'rule' => array('checkBelongsToData', 'TblMember'),
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
	public function createStringId($tbl_member_id, $branch_no) {
		$tblMemberId	= str_pad($tbl_member_id, 11, '0', STR_PAD_LEFT);
		$branchNo		= str_pad($branch_no	, 11, '0', STR_PAD_LEFT);
		return $tblMemberId . '_' . $branchNo;
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
		
		$tbl_member_id	= $data[$alias]['tbl_member_id'];
		$branch_no		= $data[$alias]['branch_no'];
		
		$checkId = $ormModel->createStringId($tbl_member_id, $branch_no);
		return ($check === $checkId)? true: false;
	}
	
	/**
	 * 枝番を取得
	 */
	public function getBranchNo($tbl_member_id) {
		$ormModel	= $this;
		$alias		= $ormModel->alias;
		$data = self::findMaxBranchNo($ormModel, $tbl_member_id);
		if (isset($data[$alias]['branch_no'])) {
			return $data[$alias]['branch_no'] + 1;
		} else {
			return 1;
		}
	}
	
	private static function findMaxBranchNo(self $ormModel, $tbl_member_id) {
		$options = array(
			'fields'		=> array('branch_no',),
			'conditions'	=> array(
				'tbl_member_id' => $tbl_member_id,
			),
			'order' => array(
				'branch_no' => 'DESC',
			),
			'recursive' => -1,
		);
		return $ormModel->find('first', $options);
	}
}
