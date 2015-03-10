<?php
App::uses('GroupsController', 'Controller');
App::uses('Group', 'Model');

/**
 * Group Test Case
 *
 */
class GroupTest extends CakeTestCase {

	/**
	 *
	 * @var Group
	 */
	public $Group = null;
	
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tbl_group',
		'app.tbl_group_lock',
		'app.tbl_member',
		'app.tbl_members_tbl_group',
		
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Group = ClassRegistry::init('Group');
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Group);

		parent::tearDown();
	}

/**
 * testSetPaginateParams method
 *
 * @return void
 */
	public function testSetPaginateParams() {
		$tu			= $this;
		$model		= $tu->Group;
		$ormName	= 'TblGroup';
		
		$ctl = new GroupsController();
		$tu->assertEqual($ctl->{$ormName}, null);
		$tu->assertEqual(empty($ctl->paginate), true);
		
		$model->setPaginateParams($ctl);
		
		$tu->assertEqual($ctl->{$ormName} instanceof $ormName, true);
		$tu->assertEqual(!empty($ctl->paginate[$ormName]), true);
	}

/**
 * testGetDataPaginate method
 *
 * @return void
 */
	public function testGetDataPaginate() {
		$tu			= $this;
		$model		= $tu->Group;
		$ormName	= 'TblGroup';
		$ormModel	= ClassRegistry::init($ormName);
		
		$ctl = new GroupsController(new CakeRequest());
		$ctl->constructClasses();
		
		$model->setPaginateParams($ctl);
		$ctl->constructClasses();
		
		$result = $model->getDataPaginate($ctl);
		$answer = self::findAllTblGroup($ormModel);
		
		$tu->assertEqual($result, $answer);
	}
	
	private static function findAllTblGroup(TblGroup $ormModel) {
		$paginateOrmName = 'TblGroup';
		$options = array(
			$paginateOrmName => array(
				'fields' => array(
					$paginateOrmName . '.id',
					$paginateOrmName . '.group_name',
					$paginateOrmName . '.tbl_member_count',
					$paginateOrmName . '.create_ip',
					$paginateOrmName . '.update_ip',
					$paginateOrmName . '.created',
					$paginateOrmName . '.updated',
				),
				'recursive'		=> 0,
				'limit'			=> 20,
				'order' => array(
					$paginateOrmName . '.updated'	=> 'DESC',
				),
			),
		);
		$ormModel->recursive = -1;
		return $ormModel->find('all', $options);
	}

/**
 * testSaveGroup method
 * (Create Ok)
 * @return void
 */
	public function testSaveGroup1() {
		$tu			= $this;
		$model		= $tu->Group;
		$tblGroup	= ClassRegistry::init('TblGroup');
		$data	= array(
			'Group' => array(
				'group_name'	=> 'Test Create Data' . uniqid(),
			),
		);
		
		$beforeCount = self::findCountTblGroup($tblGroup);
		
		$result = $model->saveGroup($data);
		
		$afterCount = self::findCountTblGroup($tblGroup);
		$answerData = self::findFirstTblGroup($tblGroup);
		
		$dataGroupName		= Hash::get($data, 'Group.group_name');
		$answerGroupName	= Hash::get($answerData, 'TblGroup.group_name');
		
		$tu->assertEqual($result->result, true);
		$tu->assertEqual($beforeCount, $afterCount - 1);
		$tu->assertEqual($dataGroupName, $answerGroupName);
	}
	
/**
 * testSaveGroup method
 * (Create NG)
 * @return void
 */
	public function testSaveGroup2() {
		$tu			= $this;
		$model		= $tu->Group;
		$tblGroup	= ClassRegistry::init('TblGroup');
		$data	= array(
			'Group' => array(
				'group_name'	=> '',
			),
		);
		
		$beforeCount = self::findCountTblGroup($tblGroup);
		
		$result = $model->saveGroup($data);
		
		$afterCount = self::findCountTblGroup($tblGroup);
		
		$tu->assertEqual($result->result, false);
		$tu->assertEqual($beforeCount, $afterCount);
		
	}
	
	private static function findCountTblGroup(TblGroup $tblGroup) {
		$options = array();
		
		return $tblGroup->find('count', $options);
	}
	
	private static function findFirstTblGroup(TblGroup $tblGroup) {
		$options = array(
			'conditions' => array(
				'TblGroup.id'	=> $tblGroup->getID(),
			),
		);
		$tblGroup->create();
		return $tblGroup->find('first', $options);
	}
	
/**
 * testSaveGroup method
 * (Update Ok)
 * @return void
 */	
	public function testSaveGroup3() {
		$tu			= $this;
		$model		= $tu->Group;
		$tblGroup	= ClassRegistry::init('TblGroup');
		$data	= array(
			'Group' => array(
				'id'			=> 1,
				'group_name'	=> 'Test Update Data' . uniqid(),
			),
		);
		
		$beforeCount = self::findCountTblGroup($tblGroup);
		
		$result = $model->saveGroup($data);
		
		$afterCount = self::findCountTblGroup($tblGroup);
		$answerData = self::findFirstTblGroup($tblGroup);
		
		$dataGroupName		= Hash::get($data, 'Group.group_name');
		$answerGroupName	= Hash::get($answerData, 'TblGroup.group_name');
		
		$tu->assertEqual($result->result, true);
		$tu->assertEqual($beforeCount, $afterCount);
		$tu->assertEqual($dataGroupName, $answerGroupName);
	}
/**
 * testSaveGroup method
 * (Update NG)
 * @return void
 */	
	public function testSaveGroup4() {
		$tu			= $this;
		$model		= $tu->Group;
		$tblGroup	= ClassRegistry::init('TblGroup');
		$data	= array(
			'Group' => array(
				'id'			=> 1,
				'group_name'	=> '',
			),
		);
		
		$beforeCount = self::findCountTblGroup($tblGroup);
		
		$result = $model->saveGroup($data);
		
		$afterCount = self::findCountTblGroup($tblGroup);
		
		$tu->assertEqual($result->result, false);
		$tu->assertEqual($beforeCount, $afterCount);
	}

/**
 * testDeleteGroup method
 *
 * @return void
 */
	public function testDeleteGroup() {
		$tu			= $this;
		$model		= $tu->Group;
		$tblGroup	= ClassRegistry::init('TblGroup');
		$id			= 1;
		
		$beforeResult = self::readTblGroup($tblGroup, $id);
		
		$result = $model->deleteGroup($id);
		
		$afterResult = self::readTblGroup($tblGroup, $id);
		
		$tu->assertEqual($result, true);
		$tu->assertNotEqual($afterResult, $beforeResult);
	}
	
	private static function readTblGroup(TblGroup $tblGroup, $id) {
		return $tblGroup->read(null, $id);
	}
}
