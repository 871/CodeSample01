<?php
/**
 * TblMemberSubMailFixture
 *
 */
class TblMemberSubMailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 23, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'comment' => 'プライマリID', 'charset' => 'utf8'),
		'tbl_member_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'メンバ情報ID'),
		'branch_no' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '枝番'),
		'sub_mail' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'メンバのメールアドレス(サブ)', 'charset' => 'utf8'),
		'create_ip' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => '作成IP', 'charset' => 'utf8'),
		'update_ip' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => '更新IP', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		// 1
		array(
			'id'			=> '00000000001_00000000001',
			'tbl_member_id'	=> '1',
			'branch_no'		=> '1', 
			'sub_mail'		=> '1_1@test.871.nagoya',
		),
		// 2
		array(
			'id'			=> '00000000002_00000000001',
			'tbl_member_id'	=> '2',
			'branch_no'		=> '1', 
			'sub_mail'		=> '2_1@test.871.nagoya',
		),
		array(
			'id'			=> '00000000002_00000000002',
			'tbl_member_id'	=> '2',
			'branch_no'		=> '2', 
			'sub_mail'		=> '2_2@test.871.nagoya',
		),
		// 3
		array(
			'id'			=> '00000000003_00000000001',
			'tbl_member_id'	=> '3',
			'branch_no'		=> '1', 
			'sub_mail'		=> '3_1@test.871.nagoya',
		),
		array(
			'id'			=> '00000000003_00000000002',
			'tbl_member_id'	=> '3',
			'branch_no'		=> '2', 
			'sub_mail'		=> '3_2@test.871.nagoya',
		),
		array(
			'id'			=> '00000000003_00000000003',
			'tbl_member_id'	=> '3',
			'branch_no'		=> '3', 
			'sub_mail'		=> '3_3@test.871.nagoya',
		),
	);

}
