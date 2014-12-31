<?php
/**
 * TblMembersTblGroupFixture
 *
 */
class TblMembersTblGroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'tbl_member_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'メンバ情報ID'),
		'tbl_group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'グループ情報ID'),
		'indexes' => array(
			'tbl_members_tbl_groups_idx1' => array('column' => array('tbl_member_id', 'tbl_group_id'), 'unique' => 1),
			'tbl_members_tbl_groups_idx2' => array('column' => array('tbl_group_id', 'tbl_member_id'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		// 2
		array(
			'tbl_member_id' => 2,
			'tbl_group_id'	=> 2,
		),
		// 3
		array(
			'tbl_member_id' => 3,
			'tbl_group_id'	=> 2,
		),
		array(
			'tbl_member_id' => 3,
			'tbl_group_id'	=> 3,
		),
		// 4
		array(
			'tbl_member_id' => 4,
			'tbl_group_id'	=> 2,
		),
		array(
			'tbl_member_id' => 4,
			'tbl_group_id'	=> 3,
		),
		array(
			'tbl_member_id' => 4,
			'tbl_group_id'	=> 4,
		),
		// 5
		array(
			'tbl_member_id' => 5,
			'tbl_group_id'	=> 2,
		),
		array(
			'tbl_member_id' => 5,
			'tbl_group_id'	=> 3,
		),
		array(
			'tbl_member_id' => 5,
			'tbl_group_id'	=> 4,
		),
		array(
			'tbl_member_id' => 5,
			'tbl_group_id'	=> 5,
		),
	);

}
