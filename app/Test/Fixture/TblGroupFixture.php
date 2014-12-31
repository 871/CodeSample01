<?php
/**
 * TblGroupFixture
 *
 */
class TblGroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'プライマリID'),
		'group_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => 'グループ名', 'charset' => 'utf8'),
		'tbl_member_count' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '所属メンバ数'),
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
			'id' => '1',
			'group_name' => 'TEST1',
			'tbl_member_count' => '0',
		),
		array(
			'id' => '2',
			'group_name' => 'TEST2',
			'tbl_member_count' => '4',
		),
		array(
			'id' => '3',
			'group_name' => 'TEST3',
			'tbl_member_count' => '3',
		),
		array(
			'id' => '4',
			'group_name' => 'TEST4',
			'tbl_member_count' => '2',
		),
		array(
			'id' => '5',
			'group_name' => 'TEST5',
			'tbl_member_count' => '1',
		),
		
	);

}
