<?php
/**
 * TblMemberDetailFixture
 *
 */
class TblMemberDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'comment' => 'プライマリID', 'charset' => 'utf8'),
		'tbl_member_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'メンバ情報ID'),
		'remarks' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '備考', 'charset' => 'utf8'),
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
			'id' => '00000000001',
			'tbl_member_id' => '1',
			'remarks'		=> "TEST DATA1\nTest Data",
		),
		array(
			'id' => '00000000002',
			'tbl_member_id' => '2',
			'remarks'		=> "TEST DATA2\nTest Data",
		),
		array(
			'id' => '00000000003',
			'tbl_member_id' => '3',
			'remarks'		=> "TEST DATA3\nTest Data",
		),
		array(
			'id' => '00000000004',
			'tbl_member_id' => '4',
			'remarks'		=> "TEST DATA4\nTest Data",
		),
		array(
			'id' => '00000000005',
			'tbl_member_id' => '5',
			'remarks'		=> "TEST DATA5\nTest Data",
		),
	);

}
