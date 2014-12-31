<?php
/**
 * TblGroupLockFixture
 *
 */
class TblGroupLockFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'グループ情報ID'),
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
		),
		array(
			'id' => '2',
		),
		array(
			'id' => '3',
		),
		array(
			'id' => '4',
		),
		array(
			'id' => '5',
		),
	);

}
