<?php 
App::import('Lib', 'InitValue');
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}
	
	
	public function __destruct() {
		InitValue::insertData($this->_dbInitData);
	}
	
	/**
	 * ユーザアカウント情報
	 * @var type 
	 */
	public $tbl_users = array(
		'id'						=> array('comment' => 'プライマリID',				'type' => 'integer',	'length' => 11,		'null' => false,	'default' => null, 'key' => 'primary', 'extra' => 'auto_increment'),
		// ユーザ名（公開）	
		'user_name'					=> array('comment' => 'ユーザ名',					'type' => 'string',		'length' => 50,		'null' => true,		'default' => null, 'unique' => true,),
		// メールアドレス	
		'user_mail'					=> array('comment' => 'ユーザのメールアドレス',		'type' => 'string',		'length' => 200,	'null' => false,	'default' => null, 'unique' => true,),
		// パスワード
		// memo:新設時はUserModelのbeforeSaveでハッシュ化する
		'password'					=> array('comment' => 'パスワード(ハッシュ)',		'type' => 'string',		'length' => 50,		'null' => true,		'default' => null,),
		// 暗号化パスワード	
		'user_password'				=> array('comment' => 'パスワード',				'type' => 'text',							'null' => true,		'default' => null,),
		
		'create_ip'	=> array('comment' => '作成IP',		'type' => 'string',		'length' => 200,	'null' => true, 'default' => null),
		'update_ip'	=> array('comment' => '更新IP',		'type' => 'string', 	'length' => 200,	'null' => true, 'default' => null),
		'created'	=> array('comment' => '作成日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		'updated'	=> array('comment' => '更新日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		
		'indexes' => array(
			'PRIMARY'	=> array('column' => 'id',		'unique' => true),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * メンバ情報（リレーション、検索対象項目）
	 * @var type 
	 */
	public $tbl_members = array(
		'id'						=> array('comment' => 'プライマリID',				'type' => 'integer',	'length' => 11,		'null' => false,	'default' => null, 'key' => 'primary', 'extra' => 'auto_increment'),
		// ユーザ名（公開）	
		'member_name'				=> array('comment' => 'メンバ名',					'type' => 'string',		'length' => 50,		'null' => true,		'default' => null,),
		// メールアドレス	
		'member_mail'				=> array('comment' => 'メンバのメールアドレス',		'type' => 'string',		'length' => 200,	'null' => false,	'default' => null, 'unique' => true,),
		// 生年月日
		'member_birthday'			=> array('comment' => '生年月日',					'type' => 'date',							'null' => true,		'default' => null),
		// 性別
		'mst_sex_id'				=> array('comment' => '性別ID',					'type' => 'integer',	'length' => 11,		'null' => false,),
		// 所属グループ数
		'tbl_group_count'			=> array('comment' => '所属グループ数',			'type' => 'integer',	'length' => 11,		'null' => false,	'default' => null,),
		
		'create_ip'	=> array('comment' => '作成IP',		'type' => 'string',		'length' => 200,	'null' => true, 'default' => null),
		'update_ip'	=> array('comment' => '更新IP',		'type' => 'string', 	'length' => 200,	'null' => true, 'default' => null),
		'created'	=> array('comment' => '作成日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		'updated'	=> array('comment' => '更新日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		
		'indexes' => array(
			'PRIMARY'	=> array('column' => 'id',		'unique' => true),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * HABTM メンバ情報、グループ情報
	 * @var type 
	 */
	public $tbl_members_tbl_groups = array(
		// メンバ情報ID
		'tbl_member_id'			=> array('comment' => 'メンバ情報ID',		'type' => 'integer',	'length' => 11,	'null' => false,	'default' => null,),
		// グループ情報ID
		'tbl_group_id'			=> array('comment' => 'グループ情報ID',	'type' => 'integer',	'length' => 11, 'null' => false,	'default' => null,),
		
		'indexes' => array(
			'tbl_members_tbl_groups_idx1' => array(
				'unique' => true,
				'column' => array('tbl_member_id', 'tbl_group_id',),
			),
			'tbl_members_tbl_groups_idx2' => array(
				'unique' => true,
				'column' => array('tbl_group_id', 'tbl_member_id',),
			),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * メンバ情報詳細（否検索項目）
	 * @var type 
	 */
	public $tbl_member_details = array(
		'id'						=> array('comment' => 'プライマリID',				'type' => 'string',		'length' => 11,		'null' => false,	'default' => null, 'key' => 'primary',),
		// メンバ情報ID
		'tbl_member_id'				=> array('comment' => 'メンバ情報ID',				'type' => 'integer',	'length' => 11,		'null' => false,	'unique' => true,),
		// 備考
		'remarks'					=> array('comment' => '備考',							'type' => 'text',						'null' => true,		'default' => null,),
		
		'create_ip'	=> array('comment' => '作成IP',		'type' => 'string',		'length' => 200,	'null' => true, 'default' => null),
		'update_ip'	=> array('comment' => '更新IP',		'type' => 'string', 	'length' => 200,	'null' => true, 'default' => null),
		'created'	=> array('comment' => '作成日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		'updated'	=> array('comment' => '更新日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		
		'indexes' => array(
			'PRIMARY'	=> array('column' => 'id',		'unique' => true),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * メンバ情報（更新処理の行ロック用）
	 * @var type 
	 */
	public $tbl_member_locks = array(
		// メンバ情報ID
		'id'				=> array('comment' => 'メンバ情報ID',				'type' => 'integer',	'length' => 11,		'null' => false,	'key' => 'primary', ),
		'indexes' => array(
			'PRIMARY'	=> array('column' => 'id',		'unique' => true),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * メンバ情報詳細（否検索項目）
	 * @var type 
	 */
	public $tbl_member_sub_mails = array(
		// プライマリID（メンバID（固定長）_枝番（固定長））
		'id'						=> array('comment' => 'プライマリID',					'type' => 'string',		'length' => 23,		'null' => false,	'default' => null, 'key' => 'primary',),
		// メンバ情報ID
		'tbl_member_id'				=> array('comment' => 'メンバ情報ID',					'type' => 'integer',	'length' => 11,		'null' => false,),
		// 枝番
		'branch_no'					=> array('comment' => '枝番',						'type' => 'integer',	'length' => 11,		'null' => false,),
		// メールアドレス	
		'sub_mail'					=> array('comment' => 'メンバのメールアドレス(サブ)',	'type' => 'string',		'length' => 200,	'null' => false,	'default' => null,),
		
		'create_ip'	=> array('comment' => '作成IP',		'type' => 'string',		'length' => 200,	'null' => true, 'default' => null),
		'update_ip'	=> array('comment' => '更新IP',		'type' => 'string', 	'length' => 200,	'null' => true, 'default' => null),
		'created'	=> array('comment' => '作成日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		'updated'	=> array('comment' => '更新日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		
		'indexes' => array(
			'PRIMARY'	=> array('column' => 'id',		'unique' => true),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * グループ情報（リレーション、検索対象項目）
	 * @var type 
	 */
	public $tbl_groups = array(
		'id'						=> array('comment' => 'プライマリID',				'type' => 'integer',	'length' => 11,		'null' => false,	'default' => null, 'key' => 'primary', 'extra' => 'auto_increment'),
		// ユーザ名（公開）	
		'group_name'				=> array('comment' => 'グループ名',				'type' => 'string',		'length' => 50,		'null' => true,		'default' => null, 'unique' => true,),
		// 所属メンバ数
		'tbl_member_count'			=> array('comment' => '所属メンバ数',				'type' => 'integer',	'length' => 11,		'null' => false,	'default' => null,),
		
		'create_ip'	=> array('comment' => '作成IP',		'type' => 'string',		'length' => 200,	'null' => true, 'default' => null),
		'update_ip'	=> array('comment' => '更新IP',		'type' => 'string', 	'length' => 200,	'null' => true, 'default' => null),
		'created'	=> array('comment' => '作成日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		'updated'	=> array('comment' => '更新日時',		'type' => 'datetime',						'null' => true, 'default' => null),
		
		'indexes' => array(
			'PRIMARY'	=> array('column' => 'id',		'unique' => true),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * グループ情報（更新処理の行ロック用）
	 * @var type 
	 */
	public $tbl_group_locks = array(
		// グループ情報ID
		'id'				=> array('comment' => 'グループ情報ID',				'type' => 'integer',	'length' => 11,		'null' => false,	'key' => 'primary', ),
		'indexes' => array(
			'PRIMARY'	=> array('column' => 'id',		'unique' => true),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	/**
	 * 性別マスタ
	 * @var type 
	 */
	public $mst_sexes = array(
		'id'		=> array('comment' => 'プライマリID',		'type' => 'integer',	'length' => 11, 'null' => false,	'default' => null, 'key' => 'primary'),
		'name'		=> array('comment' => '表示名',			'type' => 'string',		'length' => 50, 'null' => false,	'default' => null),
		'sort'		=> array('comment' => '表示順',			'type' => 'integer',	'length' => 11, 'null' => false,	'default' => null),
		'options'	=> array('comment' => 'オプション',		'type' => 'string',		'length' => 10, 'null' => true,		'default' => null),
		
		'created' => array('comment' => '作成日時', 'type' => 'datetime', 'null' => true, 'default' => null),
		'updated' => array('comment' => '更新日時', 'type' => 'datetime', 'null' => true, 'default' => null),
		'deleted' => array('comment' => '削除日時', 'type' => 'datetime', 'null' => true, 'default' => null),
		
		'indexes' => array(
			'PRIMARY'			=> array('column' => 'id',		'unique' => true),
			'mst_sexes_idx1'	=> array('column' => 'name',	'unique' => true),
			'mst_sexes_idx2'	=> array(
				'unique' => false,
				'column' => array('deleted', 'sort',),
			),
			'mst_sexes_idx3'	=> array(
				'unique' => false,
				'column' => array('options', 'deleted', 'sort',),
			),
		),
		'tableParameters' => array(
			'engine' => 'InnoDB',
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
		),
	);
	
	
	
	
	/**
	 * DB初期値設定
	 * @var type 
	 */
	protected $_dbInitData = array(
		/**
		'tbl_users' => array(
			
		),
		
		/**
		'tbl_members' => array(
			
		),
		/**
		'tbl_members_tbl_groups' => array(
			
		),
		/**
		'tbl_member_details' => array(
			
		),
		/**
		'tbl_member_locks' => array(
			
		),
		/**
		'tbl_member_sub_mails' => array(
			
		),
		/**
		'tbl_groups' => array(
			
			
		),
		/**
		'tbl_group_locks' => array(
			
			
		),
		/**/
		'mst_sexes' => array(
			array('id' => 1	, 'name' => '男姓'	, 'sort' => 100, 'options' => null,),
			array('id' => 2	, 'name' => '女姓'	, 'sort' => 200, 'options' => null,),
		),
		/**/
	);
}
