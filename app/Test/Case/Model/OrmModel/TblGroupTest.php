<?php
App::uses('TblGroup', 'Model');

/**
 * TblGroup Test Case
 *
 */
class TblGroupTest extends CakeTestCase {

	public $fixtures = array(
		'app.mst_sex',
		'app.tbl_group',
		'app.tbl_group_lock',
		'app.tbl_member',
		'app.tbl_member_lock',
		'app.tbl_member_detail',
		'app.tbl_member_sub_mail',
		'app.tbl_members_tbl_group'
	);
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TblGroup		= ClassRegistry::init('TblGroup');
		$this->TblGroupLock	= ClassRegistry::init('TblGroupLock');
		$this->TblMember	= ClassRegistry::init('TblMember');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TblGroup);
		unset($this->TblGroupLock);
		unset($this->TblMember);

		parent::tearDown();
	}
	
	
	/**
	 * グループ作成時に更新ロック用データが作成されることを確認
	 */
	public function testCreateLockData() {
		$tu			= $this;
		$tblGroup	= $tu->TblGroup;
		$lockModel	= $tu->TblGroupLock;
		
		$lockModel->create();
		$beforCount = $lockModel->find('count');
		
		$saveData = array(
			'TblGroup' => array(
				'group_name'		=> 'TEST_ADD',
				'tbl_member_count'	=> 0,
			),
		);
		$tblGroup->save($saveData);
		$id = $tblGroup->getId();
		
		$lockModel->create();
		$afterCount = $lockModel->find('count');
		$tu->assertEqual($beforCount + 1, $afterCount, 'Count Check NG');
		
		$findData = $lockModel->read(null, $id);
		$tu->assertEqual($findData['TblGroupLock']['id'], $id, 'ID Check Ng');
	}
	
	/**
	 * カウンターキャッシュ更新テスト（TblMember）
	 * @param type $tblGroup
	 * @param type $tblGroupLock
	 * @param type $tblMember
	 * @param type $tblGroup
	 * @param type $tu
	 * @param type $beforeResult
	 * @param type $afterResult
	 * @return type
	 */
	public function testCounterCatchTblMember() {
		$tu				= $this;
		$tblGroup		= $tu->TblGroup;
		$tblGroupLock	= $tu->TblGroupLock;
		$tblMember		= $tu->TblMember;
		
		/**
		 * テーブルグループの更新処理
		 */
		$saveTblGroup = function(TblGroup $tblGroup, TblGroupLock $tblGroupLock) {
			$id			= 1;
			$members	= array(1, 2, 3, 4,);

			$db = $tblGroup->getDataSource();
			$db->begin();
			$tblGroupLock->rowDataLock($id);
			$saveData = array(
				'TblGroup' => array(
					'id'				=> $id,
					'tbl_member_count'	=> count($members),
				),
				'TblMember' => array(
					'TblMember'	=> $members,
				),
			);
			$tblGroup->save($saveData);
			$db->commit();
		};
		
		/**
		 * TblMember情報を取得
		 */
		$findTblMember = function(TblMember $tblMember) {
			$options1 = array(
				'fields' => array(
					'TblMember.id',
					'TblMember.tbl_group_count',
				),
				'order' => array(
					'TblMember.id' => 'ASC',
				),
				'recursive' => -1,
			);
			$tblMember->create();
			return $tblMember->find('all', $options1);
		};
		
		/**
		 * TblGroup情報を取得
		 */
		$afterFindTblGroup = function(TblGroup $tblGroup) {
			$options = array(
				'fields' => array(
					'TblGroup.id',
					'TblGroup.tbl_member_count',
				),
				'recursive' => 1,
			);
			return $tblGroup->find('first', $options);
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
		$beforeResult = $findTblMember($tblMember);
		// テーブルグループの更新処理
		$saveTblGroup($tblGroup, $tblGroupLock);
		// TblMember情報を取得(更新後)
		$afterResult = $findTblMember($tblMember);
		// TblGroup情報を取得
		$result = $afterFindTblGroup($tblGroup);
		
		$tu->assertEqual($result['TblGroup']['tbl_member_count'], count($result['TblMember']), 'Group Counter Error');
		
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '0.TblMember.tbl_group_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '1.TblMember.tbl_group_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '2.TblMember.tbl_group_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '3.TblMember.tbl_group_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '4.TblMember.tbl_group_count', 0);
	}

	/**
	 * データ削除テスト
	 */
	public function testDeleteLockData() {
		$tu				= $this;
		$tblGroup		= $tu->TblGroup;
		$tblGroupLock	= $tu->TblGroupLock;
		$tblMember		= $tu->TblMember;
		
		$id = 2;
		
		/**
		 * TblMember情報を取得
		 */
		$findTblMember = function(TblMember $tblMember) {
			$options1 = array(
				'fields' => array(
					'TblMember.id',
					'TblMember.tbl_group_count',
				),
				'order' => array(
					'TblMember.id' => 'ASC',
				),
				'recursive' => -1,
			);
			$tblMember->create();
			return $tblMember->find('all', $options1);
		};
		
		/**
		 * TblGroup情報を取得
		 */
		$findTblGroup = function(TblGroup $tblGroup, $id) {
			$options = array(
				'fields' => array(
					'TblGroup.id',
					'TblGroup.tbl_member_count',
				),
				'conditions' => array(
					'TblGroup.id' => $id,
				),
				'recursive' => 1,
			);
			return $tblGroup->find('first', $options);
		};
		
		/**
		 * TblGroupLock情報を取得
		 */
		$findTblGroupLock = function(TblGroupLock $tblGroupLock, $id) {
			$options = array(
				'fields' => array(
					'TblGroupLock.id',
				),
				'conditions' => array(
					'TblGroupLock.id' => $id,
				),
				'recursive' => -1,
			);
			return $tblGroupLock->find('first', $options);
		};
		
		/**
		 * データ削除
		 */
		$deleteData = function(TblGroup $tblGroup, $id) {
			$tblGroup->delete($id);
		};
		
		/**
		 * カウンタのチェック
		 */
		$checkTblGroupCount = function(self $tu, array $beforeResult, array $afterResult, $path, $removeCnt) {
			$beforeCount	= Hash::get($beforeResult	, $path);
			$afterCount		= Hash::get($afterResult	, $path);
			
			$tmp		= $beforeCount - $removeCnt;
			$message	= 'Count Error path = ' . $path;
			$tu->assertEqual($afterCount, $tmp, $message);
		};
		
		// TblMember情報を取得(削除前)
		$beforeResult = $findTblMember($tblMember);
		
		// データ存在チェック
		$beforeData = $findTblGroup($tblGroup, $id);
		$tu->assertEqual(empty($beforeData), false, 'Before $findTblGroup Error');
		$beforeLock = $findTblGroupLock($tblGroupLock, $id);
		$tu->assertEqual(empty($beforeLock), false, 'Before $findTblGroupLock Error');
		
		// データ削除
		$deleteData($tblGroup, $id);
		
		// データ削除チェック
		$afterData = $findTblGroup($tblGroup, $id);
		$tu->assertEqual(empty($afterData), true, 'After $findTblGroup Error');
		$afterLock = $findTblGroupLock($tblGroupLock, $id);
		$tu->assertEqual(empty($afterLock), true, 'After $findTblGroupLock Error');
		
		// TblMember情報を取得(削除後)
		$afterResult = $findTblMember($tblMember);
		
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '0.TblMember.tbl_group_count', 0);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '1.TblMember.tbl_group_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '2.TblMember.tbl_group_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '3.TblMember.tbl_group_count', 1);
		$checkTblGroupCount($tu, $beforeResult, $afterResult, '4.TblMember.tbl_group_count', 1);
	}
}
