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
		/**/
		'tbl_groups' => array(
			array('id' => '1', 'group_name' => 'TEST1', 'tbl_member_count' => '0',),
			array('id' => '2', 'group_name' => 'TEST2', 'tbl_member_count' => '0',),
			array('id' => '3', 'group_name' => 'TEST3', 'tbl_member_count' => '0',),
			array('id' => '4', 'group_name' => 'TEST4', 'tbl_member_count' => '0',),
			array('id' => '5', 'group_name' => 'TEST5', 'tbl_member_count' => '0',),
			array('id' => '6', 'group_name' => 'TEST6', 'tbl_member_count' => '0',),
			array('id' => '7', 'group_name' => 'TEST7', 'tbl_member_count' => '0',),
			array('id' => '8', 'group_name' => 'TEST8', 'tbl_member_count' => '0',),
			array('id' => '9', 'group_name' => 'TEST9', 'tbl_member_count' => '0',),
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
