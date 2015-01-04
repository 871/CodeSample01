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
		// ログイン可能フラグ
		'login_flag'				=> array('comment' => 'ログイン可能フラグ',		'type' => 'boolean',						'null' => false,	'default' => null,),
		
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
		/**/
		'tbl_users' => array(
			array('id' => '1'	, 'user_name' => '管理者1'	, 'user_mail' => '871@hanahubuki.jp','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '2'	, 'user_name' => '管理者2'	, 'user_mail' => '2test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '3'	, 'user_name' => '管理者3'	, 'user_mail' => '3test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '4'	, 'user_name' => '管理者4'	, 'user_mail' => '4test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '5'	, 'user_name' => '管理者5'	, 'user_mail' => '5test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '6'	, 'user_name' => '管理者6'	, 'user_mail' => '6test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '7'	, 'user_name' => '管理者7'	, 'user_mail' => '7test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '8'	, 'user_name' => '管理者8'	, 'user_mail' => '8test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '9'	, 'user_name' => '管理者9'	, 'user_mail' => '9test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '10'	, 'user_name' => '管理者10'	, 'user_mail' => 'test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			
			array('id' => '11'	, 'user_name' => '管理者11'	, 'user_mail' => '11test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '12'	, 'user_name' => '管理者12'	, 'user_mail' => '12test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '13'	, 'user_name' => '管理者13'	, 'user_mail' => '13test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '14'	, 'user_name' => '管理者14'	, 'user_mail' => '14test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '15'	, 'user_name' => '管理者15'	, 'user_mail' => '15test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '16'	, 'user_name' => '管理者16'	, 'user_mail' => '16test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '17'	, 'user_name' => '管理者17'	, 'user_mail' => '17test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '18'	, 'user_name' => '管理者18'	, 'user_mail' => '18test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '19'	, 'user_name' => '管理者19'	, 'user_mail' => '19test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			array('id' => '20'	, 'user_name' => '管理者20'	, 'user_mail' => '20test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '0','create_ip' => '','update_ip' => '',),
			
			array('id' => '21'	, 'user_name' => '管理者21'	, 'user_mail' => '21test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '22'	, 'user_name' => '管理者22'	, 'user_mail' => '22test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '23'	, 'user_name' => '管理者23'	, 'user_mail' => '23test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '24'	, 'user_name' => '管理者24'	, 'user_mail' => '24test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '25'	, 'user_name' => '管理者25'	, 'user_mail' => '25test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '26'	, 'user_name' => '管理者26'	, 'user_mail' => '26test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '27'	, 'user_name' => '管理者27'	, 'user_mail' => '27test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '28'	, 'user_name' => '管理者28'	, 'user_mail' => '28test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '29'	, 'user_name' => '管理者29'	, 'user_mail' => '29test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '30'	, 'user_name' => '管理者30'	, 'user_mail' => '30test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			
			array('id' => '31'	, 'user_name' => '管理者31'	, 'user_mail' => '31test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '32'	, 'user_name' => '管理者32'	, 'user_mail' => '32test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '33'	, 'user_name' => '管理者33'	, 'user_mail' => '33test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '34'	, 'user_name' => '管理者34'	, 'user_mail' => '34test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '35'	, 'user_name' => '管理者35'	, 'user_mail' => '35test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '36'	, 'user_name' => '管理者36'	, 'user_mail' => '36test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '37'	, 'user_name' => '管理者37'	, 'user_mail' => '37test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '38'	, 'user_name' => '管理者38'	, 'user_mail' => '38test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '39'	, 'user_name' => '管理者39'	, 'user_mail' => '39test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '40'	, 'user_name' => '管理者40'	, 'user_mail' => '40test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			
			array('id' => '41'	, 'user_name' => '管理者41'	, 'user_mail' => '41test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '42'	, 'user_name' => '管理者42'	, 'user_mail' => '42test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '43'	, 'user_name' => '管理者43'	, 'user_mail' => '43test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '44'	, 'user_name' => '管理者44'	, 'user_mail' => '44test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '45'	, 'user_name' => '管理者45'	, 'user_mail' => '45test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '46'	, 'user_name' => '管理者46'	, 'user_mail' => '46test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '47'	, 'user_name' => '管理者47'	, 'user_mail' => '47test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '48'	, 'user_name' => '管理者48'	, 'user_mail' => '48test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '49'	, 'user_name' => '管理者49'	, 'user_mail' => '49test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '50'	, 'user_name' => '管理者50'	, 'user_mail' => '50test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			
			array('id' => '51'	, 'user_name' => '管理者51'	, 'user_mail' => '51test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '52'	, 'user_name' => '管理者52'	, 'user_mail' => '52test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '53'	, 'user_name' => '管理者53'	, 'user_mail' => '53test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '54'	, 'user_name' => '管理者54'	, 'user_mail' => '54test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '55'	, 'user_name' => '管理者55'	, 'user_mail' => '55test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '56'	, 'user_name' => '管理者56'	, 'user_mail' => '56test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '57'	, 'user_name' => '管理者57'	, 'user_mail' => '57test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '58'	, 'user_name' => '管理者58'	, 'user_mail' => '58test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '59'	, 'user_name' => '管理者59'	, 'user_mail' => '59test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
			array('id' => '60'	, 'user_name' => '管理者60'	, 'user_mail' => '60test@871.nagoya','password' => 'b982108fef663f83f4e5a190d2e679d5cbd47c91','user_password' => 'Ljnqmfhp8y8RhMX5t/dgMVDCyv7IrtH2Nct1GUvxOZQkJACSrv8rKyKq4sudeLCr4lBG2wx2DL4tOZCTiUY58j53','login_flag' => '1','create_ip' => '','update_ip' => '',),
		),
		
		/**/
		'tbl_members' => array(
			array('id' => '1', 'member_name' => 'MEMBER_NAME1', 'member_mail' => 'member_mail1@871.nagoya', 'member_birthday' => '1910-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '9',),
			array('id' => '2', 'member_name' => 'MEMBER_NAME2', 'member_mail' => 'member_mail2@871.nagoya', 'member_birthday' => '1920-12-31', 'mst_sex_id' => '2', 'tbl_group_count' => '8',),
			array('id' => '3', 'member_name' => 'MEMBER_NAME3', 'member_mail' => 'member_mail3@871.nagoya', 'member_birthday' => '1930-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '7',),
			array('id' => '4', 'member_name' => 'MEMBER_NAME4', 'member_mail' => 'member_mail4@871.nagoya', 'member_birthday' => '1940-12-31', 'mst_sex_id' => '2', 'tbl_group_count' => '6',),
			array('id' => '5', 'member_name' => 'MEMBER_NAME5', 'member_mail' => 'member_mail5@871.nagoya', 'member_birthday' => '1950-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '5',),
			array('id' => '6', 'member_name' => 'MEMBER_NAME6', 'member_mail' => 'member_mail6@871.nagoya', 'member_birthday' => '1960-12-31', 'mst_sex_id' => '2', 'tbl_group_count' => '4',),
			array('id' => '7', 'member_name' => 'MEMBER_NAME7', 'member_mail' => 'member_mail7@871.nagoya', 'member_birthday' => '1970-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '3',),
			array('id' => '8', 'member_name' => 'MEMBER_NAME8', 'member_mail' => 'member_mail8@871.nagoya', 'member_birthday' => '1980-12-31', 'mst_sex_id' => '2', 'tbl_group_count' => '2',),
			array('id' => '9', 'member_name' => 'MEMBER_NAME9', 'member_mail' => 'member_mail9@871.nagoya', 'member_birthday' => '1990-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '1',),
			array('id' => '10', 'member_name' => 'MEMBER_NAME10', 'member_mail' => 'member_mail10@871.nagoya', 'member_birthday' => '1910-12-31', 'mst_sex_id' => '2', 'tbl_group_count' => '0',),
			array('id' => '11', 'member_name' => 'MEMBER_NAME11', 'member_mail' => 'member_mail11@871.nagoya', 'member_birthday' => '1911-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '12', 'member_name' => 'MEMBER_NAME12', 'member_mail' => 'member_mail12@871.nagoya', 'member_birthday' => '1912-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '13', 'member_name' => 'MEMBER_NAME13', 'member_mail' => 'member_mail13@871.nagoya', 'member_birthday' => '1913-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '14', 'member_name' => 'MEMBER_NAME14', 'member_mail' => 'member_mail14@871.nagoya', 'member_birthday' => '1914-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '15', 'member_name' => 'MEMBER_NAME15', 'member_mail' => 'member_mail15@871.nagoya', 'member_birthday' => '1915-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '16', 'member_name' => 'MEMBER_NAME16', 'member_mail' => 'member_mail16@871.nagoya', 'member_birthday' => '1916-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '17', 'member_name' => 'MEMBER_NAME17', 'member_mail' => 'member_mail17@871.nagoya', 'member_birthday' => '1917-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '18', 'member_name' => 'MEMBER_NAME18', 'member_mail' => 'member_mail18@871.nagoya', 'member_birthday' => '1918-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '19', 'member_name' => 'MEMBER_NAME19', 'member_mail' => 'member_mail19@871.nagoya', 'member_birthday' => '1919-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '20', 'member_name' => 'MEMBER_NAME20', 'member_mail' => 'member_mail20@871.nagoya', 'member_birthday' => '1920-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '21', 'member_name' => 'MEMBER_NAME21', 'member_mail' => 'member_mail21@871.nagoya', 'member_birthday' => '1921-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '22', 'member_name' => 'MEMBER_NAME22', 'member_mail' => 'member_mail22@871.nagoya', 'member_birthday' => '1922-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '23', 'member_name' => 'MEMBER_NAME23', 'member_mail' => 'member_mail23@871.nagoya', 'member_birthday' => '1923-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '24', 'member_name' => 'MEMBER_NAME24', 'member_mail' => 'member_mail24@871.nagoya', 'member_birthday' => '1924-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '25', 'member_name' => 'MEMBER_NAME25', 'member_mail' => 'member_mail25@871.nagoya', 'member_birthday' => '1925-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '26', 'member_name' => 'MEMBER_NAME26', 'member_mail' => 'member_mail26@871.nagoya', 'member_birthday' => '1926-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '27', 'member_name' => 'MEMBER_NAME27', 'member_mail' => 'member_mail27@871.nagoya', 'member_birthday' => '1927-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '28', 'member_name' => 'MEMBER_NAME28', 'member_mail' => 'member_mail28@871.nagoya', 'member_birthday' => '1928-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '29', 'member_name' => 'MEMBER_NAME29', 'member_mail' => 'member_mail29@871.nagoya', 'member_birthday' => '1929-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '30', 'member_name' => 'MEMBER_NAME30', 'member_mail' => 'member_mail30@871.nagoya', 'member_birthday' => '1930-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '31', 'member_name' => 'MEMBER_NAME31', 'member_mail' => 'member_mail31@871.nagoya', 'member_birthday' => '1931-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '32', 'member_name' => 'MEMBER_NAME32', 'member_mail' => 'member_mail32@871.nagoya', 'member_birthday' => '1932-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '33', 'member_name' => 'MEMBER_NAME33', 'member_mail' => 'member_mail33@871.nagoya', 'member_birthday' => '1933-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '34', 'member_name' => 'MEMBER_NAME34', 'member_mail' => 'member_mail34@871.nagoya', 'member_birthday' => '1934-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '35', 'member_name' => 'MEMBER_NAME35', 'member_mail' => 'member_mail35@871.nagoya', 'member_birthday' => '1935-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '36', 'member_name' => 'MEMBER_NAME36', 'member_mail' => 'member_mail36@871.nagoya', 'member_birthday' => '1936-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '37', 'member_name' => 'MEMBER_NAME37', 'member_mail' => 'member_mail37@871.nagoya', 'member_birthday' => '1937-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '38', 'member_name' => 'MEMBER_NAME38', 'member_mail' => 'member_mail38@871.nagoya', 'member_birthday' => '1938-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '39', 'member_name' => 'MEMBER_NAME39', 'member_mail' => 'member_mail39@871.nagoya', 'member_birthday' => '1939-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '40', 'member_name' => 'MEMBER_NAME40', 'member_mail' => 'member_mail40@871.nagoya', 'member_birthday' => '1940-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '41', 'member_name' => 'MEMBER_NAME41', 'member_mail' => 'member_mail41@871.nagoya', 'member_birthday' => '1941-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '42', 'member_name' => 'MEMBER_NAME42', 'member_mail' => 'member_mail42@871.nagoya', 'member_birthday' => '1942-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '43', 'member_name' => 'MEMBER_NAME43', 'member_mail' => 'member_mail43@871.nagoya', 'member_birthday' => '1943-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '44', 'member_name' => 'MEMBER_NAME44', 'member_mail' => 'member_mail44@871.nagoya', 'member_birthday' => '1944-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '45', 'member_name' => 'MEMBER_NAME45', 'member_mail' => 'member_mail45@871.nagoya', 'member_birthday' => '1945-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '46', 'member_name' => 'MEMBER_NAME46', 'member_mail' => 'member_mail46@871.nagoya', 'member_birthday' => '1946-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '47', 'member_name' => 'MEMBER_NAME47', 'member_mail' => 'member_mail47@871.nagoya', 'member_birthday' => '1947-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '48', 'member_name' => 'MEMBER_NAME48', 'member_mail' => 'member_mail48@871.nagoya', 'member_birthday' => '1948-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '49', 'member_name' => 'MEMBER_NAME49', 'member_mail' => 'member_mail49@871.nagoya', 'member_birthday' => '1949-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '50', 'member_name' => 'MEMBER_NAME50', 'member_mail' => 'member_mail50@871.nagoya', 'member_birthday' => '1950-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '51', 'member_name' => 'MEMBER_NAME51', 'member_mail' => 'member_mail51@871.nagoya', 'member_birthday' => '1951-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '52', 'member_name' => 'MEMBER_NAME52', 'member_mail' => 'member_mail52@871.nagoya', 'member_birthday' => '1952-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '53', 'member_name' => 'MEMBER_NAME53', 'member_mail' => 'member_mail53@871.nagoya', 'member_birthday' => '1953-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '54', 'member_name' => 'MEMBER_NAME54', 'member_mail' => 'member_mail54@871.nagoya', 'member_birthday' => '1954-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '55', 'member_name' => 'MEMBER_NAME55', 'member_mail' => 'member_mail55@871.nagoya', 'member_birthday' => '1955-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '56', 'member_name' => 'MEMBER_NAME56', 'member_mail' => 'member_mail56@871.nagoya', 'member_birthday' => '1956-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '57', 'member_name' => 'MEMBER_NAME57', 'member_mail' => 'member_mail57@871.nagoya', 'member_birthday' => '1957-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '58', 'member_name' => 'MEMBER_NAME58', 'member_mail' => 'member_mail58@871.nagoya', 'member_birthday' => '1958-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '59', 'member_name' => 'MEMBER_NAME59', 'member_mail' => 'member_mail59@871.nagoya', 'member_birthday' => '1959-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '60', 'member_name' => 'MEMBER_NAME60', 'member_mail' => 'member_mail60@871.nagoya', 'member_birthday' => '1960-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '61', 'member_name' => 'MEMBER_NAME61', 'member_mail' => 'member_mail61@871.nagoya', 'member_birthday' => '1961-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '62', 'member_name' => 'MEMBER_NAME62', 'member_mail' => 'member_mail62@871.nagoya', 'member_birthday' => '1962-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '63', 'member_name' => 'MEMBER_NAME63', 'member_mail' => 'member_mail63@871.nagoya', 'member_birthday' => '1963-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '64', 'member_name' => 'MEMBER_NAME64', 'member_mail' => 'member_mail64@871.nagoya', 'member_birthday' => '1964-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '65', 'member_name' => 'MEMBER_NAME65', 'member_mail' => 'member_mail65@871.nagoya', 'member_birthday' => '1965-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '66', 'member_name' => 'MEMBER_NAME66', 'member_mail' => 'member_mail66@871.nagoya', 'member_birthday' => '1966-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '67', 'member_name' => 'MEMBER_NAME67', 'member_mail' => 'member_mail67@871.nagoya', 'member_birthday' => '1967-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '68', 'member_name' => 'MEMBER_NAME68', 'member_mail' => 'member_mail68@871.nagoya', 'member_birthday' => '1968-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '69', 'member_name' => 'MEMBER_NAME69', 'member_mail' => 'member_mail69@871.nagoya', 'member_birthday' => '1969-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '70', 'member_name' => 'MEMBER_NAME70', 'member_mail' => 'member_mail70@871.nagoya', 'member_birthday' => '1970-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '71', 'member_name' => 'MEMBER_NAME71', 'member_mail' => 'member_mail71@871.nagoya', 'member_birthday' => '1971-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '72', 'member_name' => 'MEMBER_NAME72', 'member_mail' => 'member_mail72@871.nagoya', 'member_birthday' => '1972-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '73', 'member_name' => 'MEMBER_NAME73', 'member_mail' => 'member_mail73@871.nagoya', 'member_birthday' => '1973-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '74', 'member_name' => 'MEMBER_NAME74', 'member_mail' => 'member_mail74@871.nagoya', 'member_birthday' => '1974-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '75', 'member_name' => 'MEMBER_NAME75', 'member_mail' => 'member_mail75@871.nagoya', 'member_birthday' => '1975-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '76', 'member_name' => 'MEMBER_NAME76', 'member_mail' => 'member_mail76@871.nagoya', 'member_birthday' => '1976-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '77', 'member_name' => 'MEMBER_NAME77', 'member_mail' => 'member_mail77@871.nagoya', 'member_birthday' => '1977-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '78', 'member_name' => 'MEMBER_NAME78', 'member_mail' => 'member_mail78@871.nagoya', 'member_birthday' => '1978-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '79', 'member_name' => 'MEMBER_NAME79', 'member_mail' => 'member_mail79@871.nagoya', 'member_birthday' => '1979-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			array('id' => '80', 'member_name' => 'MEMBER_NAME80', 'member_mail' => 'member_mail80@871.nagoya', 'member_birthday' => '1980-12-31', 'mst_sex_id' => '1', 'tbl_group_count' => '0',),
			
		),
		/**/
		'tbl_members_tbl_groups' => array(
			array('tbl_member_id'=>'1', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '2',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '3',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '4',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '5',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '6',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '7',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '8',),
			array('tbl_member_id'=>'1', 'tbl_group_id' => '9',),
			
			array('tbl_member_id'=>'2', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'2', 'tbl_group_id' => '2',),
			array('tbl_member_id'=>'2', 'tbl_group_id' => '3',),
			array('tbl_member_id'=>'2', 'tbl_group_id' => '4',),
			array('tbl_member_id'=>'2', 'tbl_group_id' => '5',),
			array('tbl_member_id'=>'2', 'tbl_group_id' => '6',),
			array('tbl_member_id'=>'2', 'tbl_group_id' => '7',),
			array('tbl_member_id'=>'2', 'tbl_group_id' => '8',),
			
			array('tbl_member_id'=>'3', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'3', 'tbl_group_id' => '2',),
			array('tbl_member_id'=>'3', 'tbl_group_id' => '3',),
			array('tbl_member_id'=>'3', 'tbl_group_id' => '4',),
			array('tbl_member_id'=>'3', 'tbl_group_id' => '5',),
			array('tbl_member_id'=>'3', 'tbl_group_id' => '6',),
			array('tbl_member_id'=>'3', 'tbl_group_id' => '7',),
			
			array('tbl_member_id'=>'4', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'4', 'tbl_group_id' => '2',),
			array('tbl_member_id'=>'4', 'tbl_group_id' => '3',),
			array('tbl_member_id'=>'4', 'tbl_group_id' => '4',),
			array('tbl_member_id'=>'4', 'tbl_group_id' => '5',),
			array('tbl_member_id'=>'4', 'tbl_group_id' => '6',),
			
			array('tbl_member_id'=>'5', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'5', 'tbl_group_id' => '2',),
			array('tbl_member_id'=>'5', 'tbl_group_id' => '3',),
			array('tbl_member_id'=>'5', 'tbl_group_id' => '4',),
			array('tbl_member_id'=>'5', 'tbl_group_id' => '5',),
			
			array('tbl_member_id'=>'6', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'6', 'tbl_group_id' => '2',),
			array('tbl_member_id'=>'6', 'tbl_group_id' => '3',),
			array('tbl_member_id'=>'6', 'tbl_group_id' => '4',),
			
			array('tbl_member_id'=>'7', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'7', 'tbl_group_id' => '2',),
			array('tbl_member_id'=>'7', 'tbl_group_id' => '3',),
			
			array('tbl_member_id'=>'8', 'tbl_group_id' => '1',),
			array('tbl_member_id'=>'8', 'tbl_group_id' => '2',),
			
			array('tbl_member_id'=>'9', 'tbl_group_id' => '1',),
			
		),
		/**/
		'tbl_member_details' => array(
			array('id' => '00000000001','tbl_member_id'=>'1','remarks' => "00000000001\nAAA\nAAAA"),
			array('id' => '00000000002','tbl_member_id'=>'2','remarks' => "00000000002\nAAA\nAAAA"),
			array('id' => '00000000003','tbl_member_id'=>'3','remarks' => "00000000003\nAAA\nAAAA"),
			array('id' => '00000000004','tbl_member_id'=>'4','remarks' => "00000000004\nAAA\nAAAA"),
			array('id' => '00000000005','tbl_member_id'=>'5','remarks' => "00000000005\nAAA\nAAAA"),
			array('id' => '00000000006','tbl_member_id'=>'6','remarks' => "00000000006\nAAA\nAAAA"),
			array('id' => '00000000007','tbl_member_id'=>'7','remarks' => "00000000007\nAAA\nAAAA"),
			array('id' => '00000000008','tbl_member_id'=>'8','remarks' => "00000000008\nAAA\nAAAA"),
			array('id' => '00000000009','tbl_member_id'=>'9','remarks' => "00000000009\nAAA\nAAAA"),
			
			array('id' => '00000000011','tbl_member_id'=>'11','remarks' => "000000000011\nAAA\nAAAA"),
			array('id' => '00000000012','tbl_member_id'=>'12','remarks' => "000000000012\nAAA\nAAAA"),
			array('id' => '00000000013','tbl_member_id'=>'13','remarks' => "000000000013\nAAA\nAAAA"),
			array('id' => '00000000014','tbl_member_id'=>'14','remarks' => "000000000014\nAAA\nAAAA"),
			array('id' => '00000000015','tbl_member_id'=>'15','remarks' => "000000000015\nAAA\nAAAA"),
			array('id' => '00000000016','tbl_member_id'=>'16','remarks' => "000000000016\nAAA\nAAAA"),
			array('id' => '00000000017','tbl_member_id'=>'17','remarks' => "000000000017\nAAA\nAAAA"),
			array('id' => '00000000018','tbl_member_id'=>'18','remarks' => "000000000018\nAAA\nAAAA"),
			array('id' => '00000000019','tbl_member_id'=>'19','remarks' => "000000000019\nAAA\nAAAA"),
			
			array('id' => '00000000021','tbl_member_id'=>'21','remarks' => "000000000021\nAAA\nAAAA"),
			array('id' => '00000000022','tbl_member_id'=>'22','remarks' => "000000000022\nAAA\nAAAA"),
			array('id' => '00000000023','tbl_member_id'=>'23','remarks' => "000000000023\nAAA\nAAAA"),
			array('id' => '00000000024','tbl_member_id'=>'24','remarks' => "000000000024\nAAA\nAAAA"),
			array('id' => '00000000025','tbl_member_id'=>'25','remarks' => "000000000025\nAAA\nAAAA"),
			array('id' => '00000000026','tbl_member_id'=>'26','remarks' => "000000000026\nAAA\nAAAA"),
			array('id' => '00000000027','tbl_member_id'=>'27','remarks' => "000000000027\nAAA\nAAAA"),
			array('id' => '00000000028','tbl_member_id'=>'28','remarks' => "000000000028\nAAA\nAAAA"),
			array('id' => '00000000029','tbl_member_id'=>'29','remarks' => "000000000029\nAAA\nAAAA"),
			
			array('id' => '00000000031','tbl_member_id'=>'31','remarks' => "00000000031\nAAA\nAAAA"),
			array('id' => '00000000032','tbl_member_id'=>'32','remarks' => "00000000032\nAAA\nAAAA"),
			array('id' => '00000000033','tbl_member_id'=>'33','remarks' => "00000000033\nAAA\nAAAA"),
			array('id' => '00000000034','tbl_member_id'=>'34','remarks' => "00000000034\nAAA\nAAAA"),
			array('id' => '00000000035','tbl_member_id'=>'35','remarks' => "00000000035\nAAA\nAAAA"),
			array('id' => '00000000036','tbl_member_id'=>'36','remarks' => "00000000036\nAAA\nAAAA"),
			array('id' => '00000000037','tbl_member_id'=>'37','remarks' => "00000000037\nAAA\nAAAA"),
			array('id' => '00000000038','tbl_member_id'=>'38','remarks' => "00000000038\nAAA\nAAAA"),
			array('id' => '00000000039','tbl_member_id'=>'39','remarks' => "00000000039\nAAA\nAAAA"),
			
			array('id' => '00000000041','tbl_member_id'=>'41','remarks' => "00000000041\nAAA\nAAAA"),
			array('id' => '00000000042','tbl_member_id'=>'42','remarks' => "00000000042\nAAA\nAAAA"),
			array('id' => '00000000043','tbl_member_id'=>'43','remarks' => "00000000043\nAAA\nAAAA"),
			array('id' => '00000000044','tbl_member_id'=>'44','remarks' => "00000000044\nAAA\nAAAA"),
			array('id' => '00000000045','tbl_member_id'=>'45','remarks' => "00000000045\nAAA\nAAAA"),
			array('id' => '00000000046','tbl_member_id'=>'46','remarks' => "00000000046\nAAA\nAAAA"),
			array('id' => '00000000047','tbl_member_id'=>'47','remarks' => "00000000047\nAAA\nAAAA"),
			array('id' => '00000000048','tbl_member_id'=>'48','remarks' => "00000000048\nAAA\nAAAA"),
			array('id' => '00000000049','tbl_member_id'=>'49','remarks' => "00000000049\nAAA\nAAAA"),
			
			array('id' => '00000000051','tbl_member_id'=>'51','remarks' => "00000000051\nAAA\nAAAA"),
			array('id' => '00000000052','tbl_member_id'=>'52','remarks' => "00000000052\nAAA\nAAAA"),
			array('id' => '00000000053','tbl_member_id'=>'53','remarks' => "00000000053\nAAA\nAAAA"),
			array('id' => '00000000054','tbl_member_id'=>'54','remarks' => "00000000054\nAAA\nAAAA"),
			array('id' => '00000000055','tbl_member_id'=>'55','remarks' => "00000000055\nAAA\nAAAA"),
			array('id' => '00000000056','tbl_member_id'=>'56','remarks' => "00000000056\nAAA\nAAAA"),
			array('id' => '00000000057','tbl_member_id'=>'57','remarks' => "00000000057\nAAA\nAAAA"),
			array('id' => '00000000058','tbl_member_id'=>'58','remarks' => "00000000058\nAAA\nAAAA"),
			array('id' => '00000000059','tbl_member_id'=>'59','remarks' => "00000000059\nAAA\nAAAA"),
			
			array('id' => '00000000061','tbl_member_id'=>'61','remarks' => "00000000061\nAAA\nAAAA"),
			array('id' => '00000000062','tbl_member_id'=>'62','remarks' => "00000000062\nAAA\nAAAA"),
			array('id' => '00000000063','tbl_member_id'=>'63','remarks' => "00000000063\nAAA\nAAAA"),
			array('id' => '00000000064','tbl_member_id'=>'64','remarks' => "00000000064\nAAA\nAAAA"),
			array('id' => '00000000065','tbl_member_id'=>'65','remarks' => "00000000065\nAAA\nAAAA"),
			array('id' => '00000000066','tbl_member_id'=>'66','remarks' => "00000000066\nAAA\nAAAA"),
			array('id' => '00000000067','tbl_member_id'=>'67','remarks' => "00000000067\nAAA\nAAAA"),
			array('id' => '00000000068','tbl_member_id'=>'68','remarks' => "00000000068\nAAA\nAAAA"),
			array('id' => '00000000069','tbl_member_id'=>'69','remarks' => "00000000069\nAAA\nAAAA"),
			
			array('id' => '00000000071','tbl_member_id'=>'71','remarks' => "00000000071\nAAA\nAAAA"),
			array('id' => '00000000072','tbl_member_id'=>'72','remarks' => "00000000072\nAAA\nAAAA"),
			array('id' => '00000000073','tbl_member_id'=>'73','remarks' => "00000000073\nAAA\nAAAA"),
			array('id' => '00000000074','tbl_member_id'=>'74','remarks' => "00000000074\nAAA\nAAAA"),
			array('id' => '00000000075','tbl_member_id'=>'75','remarks' => "00000000075\nAAA\nAAAA"),
			array('id' => '00000000076','tbl_member_id'=>'76','remarks' => "00000000076\nAAA\nAAAA"),
			array('id' => '00000000077','tbl_member_id'=>'77','remarks' => "00000000077\nAAA\nAAAA"),
			array('id' => '00000000078','tbl_member_id'=>'78','remarks' => "00000000078\nAAA\nAAAA"),
			array('id' => '00000000079','tbl_member_id'=>'79','remarks' => "00000000079\nAAA\nAAAA"),
			
			array('id' => '00000000080','tbl_member_id'=>'80','remarks' => "00000000080\nAAA\nAAAA"),
		),
		/**/
		'tbl_member_locks' => array(
			array('id' => '1',),
			array('id' => '2',),
			array('id' => '3',),
			array('id' => '4',),
			array('id' => '5',),
			array('id' => '6',),
			array('id' => '7',),
			array('id' => '8',),
			array('id' => '9',),
			array('id' => '10',),
			array('id' => '11',),
			array('id' => '12',),
			array('id' => '13',),
			array('id' => '14',),
			array('id' => '15',),
			array('id' => '16',),
			array('id' => '17',),
			array('id' => '18',),
			array('id' => '19',),
			array('id' => '20',),
			array('id' => '21',),
			array('id' => '22',),
			array('id' => '23',),
			array('id' => '24',),
			array('id' => '25',),
			array('id' => '26',),
			array('id' => '27',),
			array('id' => '28',),
			array('id' => '29',),
			array('id' => '30',),
			array('id' => '31',),
			array('id' => '32',),
			array('id' => '33',),
			array('id' => '34',),
			array('id' => '35',),
			array('id' => '36',),
			array('id' => '37',),
			array('id' => '38',),
			array('id' => '39',),
			array('id' => '40',),
			array('id' => '41',),
			array('id' => '42',),
			array('id' => '43',),
			array('id' => '44',),
			array('id' => '45',),
			array('id' => '46',),
			array('id' => '47',),
			array('id' => '48',),
			array('id' => '49',),
			array('id' => '50',),
			array('id' => '51',),
			array('id' => '52',),
			array('id' => '53',),
			array('id' => '54',),
			array('id' => '55',),
			array('id' => '56',),
			array('id' => '57',),
			array('id' => '58',),
			array('id' => '59',),
			array('id' => '60',),
			array('id' => '61',),
			array('id' => '62',),
			array('id' => '63',),
			array('id' => '64',),
			array('id' => '65',),
			array('id' => '66',),
			array('id' => '67',),
			array('id' => '68',),
			array('id' => '69',),
			array('id' => '70',),
			array('id' => '71',),
			array('id' => '72',),
			array('id' => '73',),
			array('id' => '74',),
			array('id' => '75',),
			array('id' => '76',),
			array('id' => '77',),
			array('id' => '78',),
			array('id' => '79',),
			array('id' => '80',),
		),
		/**
		'tbl_member_sub_mails' => array(
			
		),
		/**/
		'tbl_groups' => array(
			array('id' => '1', 'group_name' => 'TEST1', 'tbl_member_count' => '9',),
			array('id' => '2', 'group_name' => 'TEST2', 'tbl_member_count' => '8',),
			array('id' => '3', 'group_name' => 'TEST3', 'tbl_member_count' => '7',),
			array('id' => '4', 'group_name' => 'TEST4', 'tbl_member_count' => '6',),
			array('id' => '5', 'group_name' => 'TEST5', 'tbl_member_count' => '5',),
			array('id' => '6', 'group_name' => 'TEST6', 'tbl_member_count' => '4',),
			array('id' => '7', 'group_name' => 'TEST7', 'tbl_member_count' => '3',),
			array('id' => '8', 'group_name' => 'TEST8', 'tbl_member_count' => '2',),
			array('id' => '9', 'group_name' => 'TEST9', 'tbl_member_count' => '1',),
			array('id' => '10', 'group_name' => 'TEST10', 'tbl_member_count' => '0',),
			
			array('id' => '11', 'group_name' => 'TEST11', 'tbl_member_count' => '0',),
			array('id' => '12', 'group_name' => 'TEST12', 'tbl_member_count' => '0',),
			array('id' => '13', 'group_name' => 'TEST13', 'tbl_member_count' => '0',),
			array('id' => '14', 'group_name' => 'TEST14', 'tbl_member_count' => '0',),
			array('id' => '15', 'group_name' => 'TEST15', 'tbl_member_count' => '0',),
			array('id' => '16', 'group_name' => 'TEST16', 'tbl_member_count' => '0',),
			array('id' => '17', 'group_name' => 'TEST17', 'tbl_member_count' => '0',),
			array('id' => '18', 'group_name' => 'TEST18', 'tbl_member_count' => '0',),
			array('id' => '19', 'group_name' => 'TEST19', 'tbl_member_count' => '0',),
			array('id' => '20', 'group_name' => 'TEST20', 'tbl_member_count' => '0',),
			
			array('id' => '21', 'group_name' => 'TEST21', 'tbl_member_count' => '0',),
			array('id' => '22', 'group_name' => 'TEST22', 'tbl_member_count' => '0',),
			array('id' => '23', 'group_name' => 'TEST23', 'tbl_member_count' => '0',),
			array('id' => '24', 'group_name' => 'TEST24', 'tbl_member_count' => '0',),
			array('id' => '25', 'group_name' => 'TEST25', 'tbl_member_count' => '0',),
			array('id' => '26', 'group_name' => 'TEST26', 'tbl_member_count' => '0',),
			array('id' => '27', 'group_name' => 'TEST27', 'tbl_member_count' => '0',),
			array('id' => '28', 'group_name' => 'TEST28', 'tbl_member_count' => '0',),
			array('id' => '29', 'group_name' => 'TEST29', 'tbl_member_count' => '0',),
			array('id' => '30', 'group_name' => 'TEST30', 'tbl_member_count' => '0',),
			
			array('id' => '31', 'group_name' => 'TEST31', 'tbl_member_count' => '0',),
			array('id' => '32', 'group_name' => 'TEST32', 'tbl_member_count' => '0',),
			array('id' => '33', 'group_name' => 'TEST33', 'tbl_member_count' => '0',),
			array('id' => '34', 'group_name' => 'TEST34', 'tbl_member_count' => '0',),
			array('id' => '35', 'group_name' => 'TEST35', 'tbl_member_count' => '0',),
			array('id' => '36', 'group_name' => 'TEST36', 'tbl_member_count' => '0',),
			array('id' => '37', 'group_name' => 'TEST37', 'tbl_member_count' => '0',),
			array('id' => '38', 'group_name' => 'TEST38', 'tbl_member_count' => '0',),
			array('id' => '39', 'group_name' => 'TEST39', 'tbl_member_count' => '0',),
			array('id' => '40', 'group_name' => 'TEST40', 'tbl_member_count' => '0',),
			
			array('id' => '41', 'group_name' => 'TEST41', 'tbl_member_count' => '0',),
			array('id' => '42', 'group_name' => 'TEST42', 'tbl_member_count' => '0',),
			array('id' => '43', 'group_name' => 'TEST43', 'tbl_member_count' => '0',),
			array('id' => '44', 'group_name' => 'TEST44', 'tbl_member_count' => '0',),
			array('id' => '45', 'group_name' => 'TEST45', 'tbl_member_count' => '0',),
			array('id' => '46', 'group_name' => 'TEST46', 'tbl_member_count' => '0',),
			array('id' => '47', 'group_name' => 'TEST47', 'tbl_member_count' => '0',),
			array('id' => '48', 'group_name' => 'TEST48', 'tbl_member_count' => '0',),
			array('id' => '49', 'group_name' => 'TEST49', 'tbl_member_count' => '0',),
			array('id' => '50', 'group_name' => 'TEST50', 'tbl_member_count' => '0',),
			
			array('id' => '51', 'group_name' => 'TEST51', 'tbl_member_count' => '0',),
			array('id' => '52', 'group_name' => 'TEST52', 'tbl_member_count' => '0',),
			array('id' => '53', 'group_name' => 'TEST53', 'tbl_member_count' => '0',),
			array('id' => '54', 'group_name' => 'TEST54', 'tbl_member_count' => '0',),
			array('id' => '55', 'group_name' => 'TEST55', 'tbl_member_count' => '0',),
			array('id' => '56', 'group_name' => 'TEST56', 'tbl_member_count' => '0',),
			array('id' => '57', 'group_name' => 'TEST57', 'tbl_member_count' => '0',),
			array('id' => '58', 'group_name' => 'TEST58', 'tbl_member_count' => '0',),
			array('id' => '59', 'group_name' => 'TEST59', 'tbl_member_count' => '0',),
			array('id' => '60', 'group_name' => 'TEST60', 'tbl_member_count' => '0',),
			
			array('id' => '61', 'group_name' => 'TEST61', 'tbl_member_count' => '0',),
			array('id' => '62', 'group_name' => 'TEST62', 'tbl_member_count' => '0',),
			array('id' => '63', 'group_name' => 'TEST63', 'tbl_member_count' => '0',),
			array('id' => '64', 'group_name' => 'TEST64', 'tbl_member_count' => '0',),
			array('id' => '65', 'group_name' => 'TEST65', 'tbl_member_count' => '0',),
			array('id' => '66', 'group_name' => 'TEST66', 'tbl_member_count' => '0',),
			array('id' => '67', 'group_name' => 'TEST67', 'tbl_member_count' => '0',),
			array('id' => '68', 'group_name' => 'TEST68', 'tbl_member_count' => '0',),
			array('id' => '69', 'group_name' => 'TEST69', 'tbl_member_count' => '0',),
			array('id' => '70', 'group_name' => 'TEST70', 'tbl_member_count' => '0',),
			
		),
		/**/
		'tbl_group_locks' => array(
			array('id' => '1',),
			array('id' => '2',),
			array('id' => '3',),
			array('id' => '4',),
			array('id' => '5',),
			array('id' => '6',),
			array('id' => '7',),
			array('id' => '8',),
			array('id' => '9',),
			array('id' => '10',),
			
			array('id' => '11',),
			array('id' => '12',),
			array('id' => '13',),
			array('id' => '14',),
			array('id' => '15',),
			array('id' => '16',),
			array('id' => '17',),
			array('id' => '18',),
			array('id' => '19',),
			array('id' => '20',),
			
			array('id' => '21',),
			array('id' => '22',),
			array('id' => '23',),
			array('id' => '24',),
			array('id' => '25',),
			array('id' => '26',),
			array('id' => '27',),
			array('id' => '28',),
			array('id' => '29',),
			array('id' => '30',),
			
			array('id' => '31',),
			array('id' => '32',),
			array('id' => '33',),
			array('id' => '34',),
			array('id' => '35',),
			array('id' => '36',),
			array('id' => '37',),
			array('id' => '38',),
			array('id' => '39',),
			array('id' => '40',),
			
			array('id' => '41',),
			array('id' => '42',),
			array('id' => '43',),
			array('id' => '44',),
			array('id' => '45',),
			array('id' => '46',),
			array('id' => '47',),
			array('id' => '48',),
			array('id' => '49',),
			array('id' => '50',),
			
			array('id' => '51',),
			array('id' => '52',),
			array('id' => '53',),
			array('id' => '54',),
			array('id' => '55',),
			array('id' => '56',),
			array('id' => '57',),
			array('id' => '58',),
			array('id' => '59',),
			array('id' => '60',),
			
			array('id' => '61',),
			array('id' => '62',),
			array('id' => '63',),
			array('id' => '64',),
			array('id' => '65',),
			array('id' => '66',),
			array('id' => '67',),
			array('id' => '68',),
			array('id' => '69',),
			array('id' => '70',),
			
		),
		/**/
		'mst_sexes' => array(
			array('id' => 1	, 'name' => '男姓'	, 'sort' => 100, 'options' => null,),
			array('id' => 2	, 'name' => '女姓'	, 'sort' => 200, 'options' => null,),
		),
		/**/
	);
}
