<?php
/**
 * MstSexFixture
 *
 */
class MstSexFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'プライマリID'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '表示名', 'charset' => 'utf8'),
		'sort' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '表示順'),
		'options' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => 'オプション', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'deleted' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => '削除日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mst_sexes_idx1' => array('column' => 'name', 'unique' => 1),
			'mst_sexes_idx2' => array('column' => array('deleted', 'sort'), 'unique' => 0),
			'mst_sexes_idx3' => array('column' => array('options', 'deleted', 'sort'), 'unique' => 0)
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
			'name' => '男姓',
			'sort' => '100',
			'options' => null,
			'created' => '2014-12-31 06:44:28',
			'updated' => '2014-12-31 06:44:28',
			'deleted' => null
		),
		array(
			'id' => '2',
			'name' => '女姓',
			'sort' => '200',
			'options' => null,
			'created' => '2014-12-31 06:44:28',
			'updated' => '2014-12-31 06:44:28',
			'deleted' => null
		),
	);

}
