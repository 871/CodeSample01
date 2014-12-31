<?php
/**
 * TblMemberFixture
 *
 */
class TblMemberFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'プライマリID'),
		'member_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => 'メンバ名', 'charset' => 'utf8'),
		'member_mail' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'メンバのメールアドレス', 'charset' => 'utf8'),
		'member_birthday' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => '生年月日'),
		'mst_sex_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '性別ID'),
		'tbl_group_count' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '所属グループ数'),
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
		array(
			'id' => 1,
			'member_name' => 'TEST_MEMBER_NAME1',
			'member_mail' => 'test_mail1@test.871.nagoya',
			'member_birthday' => '1900-01-01',
			'mst_sex_id' => '1',
			'tbl_group_count' => '0',
		),
		array(
			'id' => 2,
			'member_name' => 'TEST_MEMBER_NAME2',
			'member_mail' => 'test_mail2@test.871.nagoya',
			'member_birthday' => '1900-02-01',
			'mst_sex_id' => '2',
			'tbl_group_count' => '1',
		),
		array(
			'id' => 3,
			'member_name' => 'TEST_MEMBER_NAME3',
			'member_mail' => 'test_mail3@test.871.nagoya',
			'member_birthday' => '1900-03-01',
			'mst_sex_id' => '1',
			'tbl_group_count' => '2',
		),
		array(
			'id' => 4,
			'member_name' => 'TEST_MEMBER_NAME4',
			'member_mail' => 'test_mail4@test.871.nagoya',
			'member_birthday' => '1900-04-01',
			'mst_sex_id' => '2',
			'tbl_group_count' => '3',
		),
		array(
			'id' => 5,
			'member_name' => 'TEST_MEMBER_NAME5',
			'member_mail' => 'test_mail5@test.871.nagoya',
			'member_birthday' => '1900-05-31',
			'mst_sex_id' => '1',
			'tbl_group_count' => '4',
		),
		
	);

}
