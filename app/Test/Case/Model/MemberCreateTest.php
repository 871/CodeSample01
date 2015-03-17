<?php
App::uses('MemberCreate', 'Model');

/**
 * MemberCreate Test Case
 *
 */
class MemberCreateTest extends CakeTestCase {

	/**
	 *
	 * @var MemberCreate
	 */
	public $MemberCreate = null;
	
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tbl_member',
		'app.tbl_member_detail',
		'app.tbl_member_lock',
		'app.tbl_member_sub_mail',
		'app.tbl_group',
		'app.tbl_members_tbl_group',
		
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MemberCreate = ClassRegistry::init('MemberCreate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MemberCreate);

		parent::tearDown();
	}

/**
 * testSetInputFormParams method
 *
 * @return void
 */
	public function testSetInputFormParams() {
		$tu		= $this;
		$model	= $tu->MemberCreate;
		
		$beforeValidateParams	= self::getValidateParams($model);
		$beforeFieldParams		= self::getFieldParams($model);
		
		$tu->assertEqual($beforeValidateParams, array());
		$tu->assertEqual($beforeFieldParams, array());
		
		$model->setInputFormParams();
		
		$afterValidateParams	= self::getValidateParams($model);
		$afterFieldParams		= self::getFieldParams($model);
		
		$validateKeys	= array_keys($afterValidateParams);
		$fieldKeys		= array_keys($afterFieldParams);
		$answerKeys		= self::getAnswerKeys();
		
		sort($validateKeys);
		sort($fieldKeys);
		sort($answerKeys);
		
		$tu->assertEqual($validateKeys	, $answerKeys);
		$tu->assertEqual($fieldKeys		, $answerKeys);
	}
	
	private static function getValidateParams(MemberCreate $model) {
		return $model->validate;
	}

	private static function getFieldParams(MemberCreate $model) {
		return $model->fieldParams;
	}
	
	private static function getAnswerKeys() {
		$result = array(
			'member_name',
			'member_mail',
			'member_birthday',
			'mst_sex_id',
			'remarks',
			'TblGroup',
		);
		for ($i = 0, $cnt = 10; $i < $cnt; ++$i) {
			$result[] = 'sub_mail_' . $i;
		}
		return $result;
	}

	/**
 * testCheckSubMail method
 *
 * @return void
 */
	public function testCheckSubMail() {
		
		
		
		
	}

/**
 * testSaveMember method
 *
 * @return void
 */
	public function testSaveMember() {
		
		
	}

}
