<?php
App::uses('TblMember', 'Model');

/**
 * TblMember Test Case
 *
 */
class TblMemberTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mst_sex',
		'app.tbl_group',
		'app.tbl_group_lock',
		'app.tbl_member',
		'app.tbl_member_lock',
		'app.tbl_member_detail',
		'app.tbl_member_sub_mail',
		'app.tbl_members_tbl_group',	
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TblMember		= ClassRegistry::init('TblMember');
		$this->TblMemberDetail	= ClassRegistry::init('TblMemberDetail');
		$this->TblMemberSubMail	= ClassRegistry::init('TblMemberSubMail');
		$this->TblMemberLock	= ClassRegistry::init('TblMemberLock');
		$this->TblGroup			= ClassRegistry::init('TblGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TblMember);

		parent::tearDown();
	}
	
	/**
	 * メンバ作成時に更新ロック用データが作成されることを確認
	 */
	public function testCreateLockData() {
		$tu				= $this;
		$tblMember		= $tu->TblMember;
		$tblMemberLock	= $tu->TblMemberLock;
		
		$tblMemberLock->create();
		$beforCount = $tblMemberLock->find('count');
		
		$saveData = array(
			'TblMember' => array(
				'member_name' => 'TEST_MEMBER_NAME_ADD',
				'member_mail' => 'test_mail_add@test.871.nagoya',
				'member_birthday' => '1980-01-01',
				'mst_sex_id' => '1',
				'tbl_group_count' => '0',
			),
		);
		$tblMember->save($saveData);
		$id = $tblMember->getId();
		
		$tblMemberLock->create();
		$afterCount = $tblMemberLock->find('count');
		$tu->assertEqual($beforCount + 1, $afterCount, 'Count Check NG');
		
		$findData = $tblMemberLock->read(null, $id);
		$tu->assertEqual($findData['TblMemberLock']['id'], $id, 'ID Check Ng');
	}
	
	/**
	 * メンバ作成時に詳細データが作成されることを確認
	 */
	public function testSaveCreateTblMemberDetail() {
		$tu					= $this;
		$tblMember			= $tu->TblMember;
		$tblMemberDetail	= $tu->TblMemberDetail;
		
		$saveData = array(
			'TblMember' => array(
				'member_name' => 'TEST_MEMBER_NAME_ADD',
				'member_mail' => 'test_mail_add@test.871.nagoya',
				'member_birthday' => '1980-01-01',
				'mst_sex_id' => '1',
				'tbl_group_count' => '0',
			),
			'TblMemberDetail' => array(
				'remarks' => join("\n", array(
					'AAA',
					'BBB',
					'CCC',
					'DDD',
				)),
			),
		);
		$tblMember instanceof TblMember;
		$tblMember->saveAssociated($saveData, array('deep' => true));
		$id = $tblMember->getId();
		
		$options = array(
			'conditions' => array(
				'TblMemberDetail.tbl_member_id'	=> $id,
			),
		);
		$savedData = $tblMemberDetail->find('first', $options);
		
		$path1 = 'TblMemberDetail.remarks';
		$save1	= Hash::get($saveData, $path1);
		$saved1	= Hash::get($savedData, $path1);
		$tu->assertEqual($save1, $saved1);
		
		$path2	= 'TblMemberDetail.id';
		$save2	= $tblMemberDetail->createStringId($id);
		$saved2	= Hash::get($savedData, $path2);
		$tu->assertEqual($save2, $saved2);
	}
	
	/**
	 * メンバ更新時に詳細データが作成されることを確認
	 */
	public function testSaveUpdateTblMemberDetail() {
		$tu					= $this;
		$tblMember			= $tu->TblMember;
		$tblMemberDetail	= $tu->TblMemberDetail;
		$id					= 1;
		
		$options = array(
			'conditions' => array(
				'TblMemberDetail.tbl_member_id'	=> $id,
			),
		);
		$beforeSaveData = $tblMemberDetail->find('first', $options);
		
		$saveData = array(
			'TblMember' => array(
				'id'			=> $id,
				'member_name' => 'TEST_MEMBER_NAME_ADD',
				'member_mail' => 'test_mail_add@test.871.nagoya',
				'member_birthday' => '1980-01-01',
				'mst_sex_id' => '1',
				'tbl_group_count' => '0',
			),
			'TblMemberDetail' => array(
				'remarks' => join("\n", array(
					'AAA',
					'BBB',
					'CCC',
					'DDD',
				)),
			),
		);
		$tblMember->saveAssociated($saveData, array('deep' => true));
		
		$savedData = $tblMemberDetail->find('first', $options);
		
		$path1 = 'TblMemberDetail.remarks';
		$save1	= Hash::get($saveData, $path1);
		$saved1	= Hash::get($savedData, $path1);
		$tu->assertEqual($save1, $saved1);
		
		$path2	= 'TblMemberDetail.id';
		$save2	= $tblMemberDetail->createStringId($id);
		$saved2	= Hash::get($savedData, $path2);
		$tu->assertEqual($save2, $saved2);
		
		$path3			= 'TblMemberDetail.remarks';
		$save3			= Hash::get($saveData, $path1);
		$beforeSave3	= Hash::get($beforeSaveData, $path3);
		$tu->assertNotEqual($save3, $beforeSave3);
	}
	
	/**
	 * メンバ作成時にサブメールデータが作成されることを確認
	 */
	public function testSaveCreateTblMemberSubMail() {
		$tu					= $this;
		$tblMember			= $tu->TblMember;
		$tblMemberSubMail	= $tu->TblMemberSubMail;
		
		$saveData = array(
			'TblMember' => array(
				'member_name' => 'TEST_MEMBER_NAME_ADD',
				'member_mail' => 'test_mail_add@test.871.nagoya',
				'member_birthday' => '1980-01-01',
				'mst_sex_id' => '1',
				'tbl_group_count' => '0',
			),
			'TblMemberSubMail' => array(
				array('sub_mail' => 'create1@test.871.nagoya',),
				array('sub_mail' => 'create2@test.871.nagoya',),
				array('sub_mail' => 'create3@test.871.nagoya',),
				array('sub_mail' => 'create4@test.871.nagoya',),
			),
		);
		$tblMember->saveAssociated($saveData, array('deep' => true));
		$id = $tblMember->getId();
		$options = array(
			'conditions' => array(
				'TblMemberSubMail.tbl_member_id'	=> $id,
			),
		);
		$saveCount = $tblMemberSubMail->find('count', $options);
		
		$tu->assertEqual($saveCount, 4);
		
		$data = $tblMemberSubMail->find('all', $options);
		$path1 = '3.TblMemberSubMail.sub_mail';
		$path2 = 'TblMemberSubMail.3.sub_mail';
		
		$value1	= Hash::get($data, $path1);
		$value2	= Hash::get($saveData, $path2);
		$tu->assertEqual($value2, $value1);
	}
	
	/**
	 * メンバ更新時にサブメールデータが作成されることを確認
	 */
	public function testSaveUpdateTblMemberSubMail() {
		$tu					= $this;
		$tblMember			= $tu->TblMember;
		$tblMemberSubMail	= $tu->TblMemberSubMail;
		$id = 1;
		
		$options = array(
			'conditions' => array(
				'TblMemberSubMail.tbl_member_id'	=> $id,
			),
		);
		$beforeCount = $tblMemberSubMail->find('count', $options);
		
		$saveData = array(
			'TblMember' => array(
				'id'			=> $id,
				'member_name' => 'TEST_MEMBER_NAME_ADD',
				'member_mail' => 'test_mail_add@test.871.nagoya',
				'member_birthday' => '1980-01-01',
				'mst_sex_id' => '1',
				'tbl_group_count' => '0',
			),
			'TblMemberSubMail' => array(
				array('sub_mail' => 'create1@test.871.nagoya',),
				array('sub_mail' => 'create2@test.871.nagoya',),
				array('sub_mail' => 'create3@test.871.nagoya',),
				array('sub_mail' => 'create4@test.871.nagoya',),
			),
		);
		$tblMember->saveAssociated($saveData, array('deep' => true));
		
		$saveCount = $tblMemberSubMail->find('count', $options);
		
		$tu->assertEqual($saveCount, $beforeCount + 4);
		$tu->assertNotEqual($beforeCount, $saveCount);
		
		
		$data = $tblMemberSubMail->find('all', $options);
		
		$path1 = '3.TblMemberSubMail.sub_mail';
		$path2 = 'TblMemberSubMail.2.sub_mail';
		$path3 = '3.TblMemberSubMail.id';
		$path4 = '3.TblMemberSubMail.tbl_member_id';
		$path5 = '3.TblMemberSubMail.branch_no';
		
		$value1	= Hash::get($data, $path1);
		$value2	= Hash::get($saveData, $path2);
		$value3	= Hash::get($data, $path3);
		$value4	= Hash::get($data, $path4);
		$value5	= Hash::get($data, $path5);
		
		$tu->assertEqual($value2, $value1);
		$tu->assertEqual($value3, '00000000001_00000000004');
		$tu->assertEqual($value4, '1');
		$tu->assertEqual($value5, '4');
	}
	
	
	public function testCounterCatchTblGroup() {
		$tu				= $this;
		$tblMember		= $tu->TblMember;
		$tblMemberLock	= $tu->TblMemberLock;
		$tblGroup		= $tu->TblGroup;
		
		/**
		 * メンバテーブルの更新処理
		 */
		$saveTblMember = function(TblMember $tblMember, TblMemberLock $tblMemberLock) {
			$id		= 1;
			$groups	= array(1, 2, 3, 4,);

			$db = $tblMember->getDataSource();
			$db->begin();
			$tblMemberLock->rowDataLock($id);
			$saveData = array(
				'TblMember' => array(
					'id'				=> $id,
					'tbl_group_count'	=> count($groups),
				),
				'TblGroup' => array(
					'TblGroup'	=> $groups,
				),
			);
			$tblMember->save($saveData);
			$db->commit();
		};
		
		/**
		 * TblGroup情報を取得
		 */
		$findTblGroup = function(TblGroup $tblGroup) {
			$options = array(
				'fields' => array(
					'TblGroup.id',
					'TblGroup.tbl_member_count',
				),
				'recursive' => -1,
			);
			$tblGroup->create();
			return $tblGroup->find('all', $options);
		};
		
		/**
		 * TblTblMember情報を取得
		 */
		$afterFindTblMember = function(TblMember $tblMember) {
			$options = array(
				'fields' => array(
					'TblMember.id',
					'TblMember.tbl_group_count',
				),
				'recursive' => 1,
			);
			return $tblMember->find('first', $options);
		};
		
		/**
		 * カウンタのチェック
		 */
		$checkTblGroupCount = function(self $tu, array $beforeResult, array $afterResult, $path, $addCnt) {
			$beforeCount	= Hash::get($beforeResult	, $path);
			$afterCount		= Hash::get($afterResult	, $path);
			
			$tmp		= $beforeCount + $addCnt;
			$message	= 'Count Error path = ' . $path;
			$tu->assertEqual($afterCount, $tmp, $message);
		};
		
		// TblMember情報を取得(更新前)
		$beforeResult = $findTblGroup($tblGroup);
		// テーブルグループの更新処理
		$saveTblMember($tblMember, $tblMemberLock);
		// TblMember情報を取得(更新後)
		$afterResult = $findTblGroup($tblGroup);
		// TblGroup情報を取得
		$result = $afterFindTblMember($tblMember);
		
		$tu->assertEqual($result['TblMember']['tbl_group_count'], count($result['TblGroup']), 'Member Counter Error');
		
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '0.TblGroup.tbl_member_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '1.TblGroup.tbl_member_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '2.TblGroup.tbl_member_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '3.TblGroup.tbl_member_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '4.TblGroup.tbl_member_count', 0);
	}


	/**
	 * データ削除テスト
	 */
	public function testDeleteLockData() {
		$tu				= $this;
		$tblMember		= $tu->TblMember;
		$tblMemberLock	= $tu->TblMemberLock;
		$tblGroup		= $tu->TblGroup;
		
		$id = 5;
		
		/**
		 * TblGroup情報を取得
		 */
		$findTblGroup = function(TblGroup $tblGroup) {
			$options1 = array(
				'fields' => array(
					'TblGroup.id',
					'TblGroup.tbl_member_count',
				),
				'order' => array(
					'TblGroup.id' => 'ASC',
				),
				'recursive' => -1,
			);
			$tblGroup->create();
			return $tblGroup->find('all', $options1);
		};
		
		/**
		 * TblMember情報を取得
		 */
		$findTblMember = function(TblMember $tblMember, $id) {
			$options = array(
				'fields' => array(
					'TblMember.id',
					'TblMember.tbl_group_count',
				),
				'conditions' => array(
					'TblMember.id' => $id,
				),
				'recursive' => 1,
			);
			return $tblMember->find('first', $options);
		};
		
		/**
		 * TblMemberLock情報を取得
		 */
		$findTblMemberLock = function(TblMemberLock $tblMemberLock, $id) {
			$options = array(
				'fields' => array(
					'TblMemberLock.id',
				),
				'conditions' => array(
					'TblMemberLock.id' => $id,
				),
				'recursive' => -1,
			);
			return $tblMemberLock->find('first', $options);
		};
		
		/**
		 * データ削除
		 */
		$deleteData = function(TblMember $tblMember, $id) {
			$tblMember->delete($id);
		};
		
		/**
		 * カウンタのチェック
		 */
		$checkTblMemberCount = function(self $tu, array $beforeResult, array $afterResult, $path, $removeCnt) {
			$beforeCount	= Hash::get($beforeResult	, $path);
			$afterCount		= Hash::get($afterResult	, $path);
			
			$tmp		= $beforeCount - $removeCnt;
			$message	= 'Count Error path = ' . $path;
			$tu->assertEqual($afterCount, $tmp, $message);
		};
		
		// TblGroup情報を取得(削除前)
		$beforeResult = $findTblGroup($tblGroup);
		
		// データ存在チェック
		$beforeData = $findTblMember($tblMember, $id);
		$tu->assertEqual(empty($beforeData), false, 'Before $findTblGroup Error');
		$beforeLock = $findTblMemberLock($tblMemberLock, $id);
		$tu->assertEqual(empty($beforeLock), false, 'Before $findTblGroupLock Error');
		
		// データ削除
		$deleteData($tblMember, $id);
		
		// データ削除チェック
		$afterData = $findTblMember($tblMember, $id);
		$tu->assertEqual(empty($afterData), true, 'After $findTblGroup Error');
		$afterLock = $findTblMemberLock($tblMemberLock, $id);
		$tu->assertEqual(empty($afterLock), true, 'After $findTblGroupLock Error');
		
		// TblGroup情報を取得(削除後)
		$afterResult = $findTblGroup($tblGroup);
		
		$checkTblMemberCount($tu, $beforeResult, $afterResult, '0.TblGroup.tbl_member_count', 0);
		$checkTblMemberCount($tu, $beforeResult, $afterResult, '1.TblGroup.tbl_member_count', 1);
		$checkTblMemberCount($tu, $beforeResult, $afterResult, '2.TblGroup.tbl_member_count', 1);
		$checkTblMemberCount($tu, $beforeResult, $afterResult, '3.TblGroup.tbl_member_count', 1);
		$checkTblMemberCount($tu, $beforeResult, $afterResult, '4.TblGroup.tbl_member_count', 1);
	}
	
}
