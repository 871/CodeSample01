<?php
App::uses('AppMstModel', 'Model');
/**
 * MstSex Model
 *
 * @property TblMember $TblMember
 */
class MstSex extends AppMstModel {
	
	const ID_MAN		= 1;
	const ID_WOMAN		= 2;
	
	const NAME_MAN		= '男性';
	const NAME_WOMAN	= '女性';
	
	protected $_listDataCache = array(
		self::ID_MAN		=> self::NAME_MAN,
		self::ID_WOMAN		=> self::NAME_WOMAN,
	);

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TblMember' => array(
			'className' => 'TblMember',
			'foreignKey' => 'mst_sex_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
