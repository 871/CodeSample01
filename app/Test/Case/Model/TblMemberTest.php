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
	 * グループ作成時に更新ロック用データが作成されることを確認
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


}