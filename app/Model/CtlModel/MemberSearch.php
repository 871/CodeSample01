<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppCtlModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class MemberSearch extends AppCtlModel {
	
	const PAGINATE_ORM_NAME			= 'TblMember';
	
	const HABTM_ALIAS1				= 'TblMembersTblGroup';
	
	const TMP_REQUEST_SESSION_KEY	= 'tmp.Request.MemberSearch';
	
	private $setInputFormFlag = false;
	
	public $validate = array();
	
	
	/**
	 * フォーム設定用のパラメータ
	 * @var type 
	 */
	public $fieldParams = array();
	
	
	public function setInputFormParams() {
		$ctlModel = $this;
		if ($ctlModel->setInputFormFlag === false) {
			self::setInputFormTblGroupId		($ctlModel);
			self::setInputFormMemberName		($ctlModel);
			self::setInputFormMemberMail			($ctlModel);
			self::setInputFormMemberAgeMin		($ctlModel);
			self::setInputFormMemberAgeMax		($ctlModel);
			self::setInputFormMemberBirthdayMin	($ctlModel);
			self::setInputFormMemberBirthdayMax	($ctlModel);
			self::setInputFormTblGroupCountMin	($ctlModel);
			self::setInputFormTblGroupCountMax	($ctlModel);
			$ctlModel->setInputFormFlag = true;
		}
	}
	
	private static function setInputFormTblGroupId(self $ctlModel) {
		$field		= 'tbl_group_id';
		$tblGroup	= ClassRegistry::init('TblGroup');
		$list		= $tblGroup->find('list');
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'select',
			'empty'		=> '（未選択）',
			'options'	=> $list,
			'required'	=> false,
		);
	}
	
	private static function setInputFormMemberName(self $ctlModel) {
		$field = 'member_name';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'text',
			'required'	=> false,
		);
	}
	
	private static function setInputFormMemberMail(self $ctlModel) {
		$field = 'member_mail';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'text',
			'required'	=> false,
		);
	}
	
	private static function setInputFormMemberAgeMin(self $ctlModel) {
		$field = 'member_age_min';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'number',
			'required'	=> false,
		);
	}
	
	private static function setInputFormMemberAgeMax(self $ctlModel) {
		$field = 'member_age_max';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'number',
			'required'	=> false,
		);
	}
	
	private static function setInputFormMemberBirthdayMin(self $ctlModel) {
		$field = 'member_birthday_min';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'text',
			'required'	=> false,
		);
	}
	
	private static function setInputFormMemberBirthdayMax(self $ctlModel) {
		$field = 'member_birthday_max';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'text',
			'required'	=> false,
		);
	}
	
	private static function setInputFormTblGroupCountMin(self $ctlModel) {
		$field = 'tbl_group_count_min';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'number',
			'required'	=> false,
		);
	}
	
	private static function setInputFormTblGroupCountMax(self $ctlModel) {
		$field = 'tbl_group_count_max';
		$ctlModel->fieldParams[$field] = array(
			'type'		=> 'number',
			'required'	=> false,
		);
	}

	/**
	 * ページェント設定
	 * @param MemberSearchsController $ctl
	 */
	public function setPaginateParams(MemberSearchsController $ctl, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$habtmAlias1		= self::HABTM_ALIAS1;
		
		$ctl->{$paginateOrmName} = ClassRegistry::init($paginateOrmName);
		$ctl->paginate = array(
			$paginateOrmName => array(
				'fields' => array(
					$paginateOrmName . '.id',
					$paginateOrmName . '.member_name',
					$paginateOrmName . '.member_mail',
					$paginateOrmName . '.member_birthday',
					$paginateOrmName . '.tbl_group_count',
					$paginateOrmName . '.create_ip',
					$paginateOrmName . '.update_ip',
					$paginateOrmName . '.created',
					$paginateOrmName . '.updated',
					'MstSex.name',
				),
				'recursive'		=> 0,
				'limit'			=> 20,
				'conditions'	=> self::getConditions($request),
				'joins' => array(
					array(
						'type'	=> 'LEFT',
						'table' => 'tbl_members_tbl_groups',
						'alias' => $habtmAlias1,
						'conditions' => array($paginateOrmName . '.id = ' . $habtmAlias1 . '.tbl_member_id')
					),
					array(
						'type'	=> 'LEFT',
						'table' => 'tbl_groups',
						'alias' => 'TblGroup',
						'conditions' => array($habtmAlias1 . '.tbl_group_id = TblGroup.id')
					),
				), 
				'group' => array(
					$paginateOrmName . '.id',
				),
				'order' => array(
					$paginateOrmName . '.updated'	=> 'DESC',
				),
			),
		);
	}
	
	private static function getConditions(CakeRequest $request) {
		$std = new stdClass();
		$std->conditions = array();
		self::setConditionTblGroupId		($std, $request);
		self::setConditionMemberName		($std, $request);
		self::setConditionMemberMail			($std, $request);
		self::setConditionMemberAgeMin		($std, $request);
		self::setConditionMemberAgeMax		($std, $request);
		self::setConditionMemberBirthdayMin	($std, $request);
		self::setConditionMemberBirthdayMax	($std, $request);
		self::setConditionTblGroupCountMin	($std, $request);
		self::setConditionTblGroupCountMax	($std, $request);
		return $std->conditions;
	}
	
	private static function setConditionTblGroupId(stdClass $std, CakeRequest $request) {
		$habtmAlias1 = self::HABTM_ALIAS1;
		
		$value = $request->data('MemberSearch.tbl_group_id');
		if (!empty($value)) {
			$fieldName = $habtmAlias1 . '.tbl_group_id';
			$std->conditions[$fieldName] = $value;
		}
	}
	
	private static function setConditionMemberName(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.member_name');
		if (!empty($value)) {
			$fieldName = $paginateOrmName . '.member_name Like';
			$std->conditions[0]['or'][$fieldName] = '%' . $value . '%';
		}
	}
	
	private static function setConditionMemberMail(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.member_mail');
		if (!empty($value)) {
			$fieldName = $paginateOrmName . '.member_mail Like';
			$std->conditions[0]['or'][$fieldName] = '%' . $value . '%';
		}
	}
	
	private static function setConditionMemberAgeMin(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.member_age_min');
		if (!empty($value) && is_numeric($value)) {
			$fieldName = $paginateOrmName . '.member_birthday <=';
			$std->conditions[$fieldName] = self::getBirthday($value) . ' 23:59:59';
		}
	}
	
	private static function setConditionMemberAgeMax(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.member_age_max');
		if (!empty($value) && is_numeric($value)) {
			$fieldName = $paginateOrmName . '.member_birthday >=';
			$std->conditions[$fieldName] = self::getBirthday($value + 1) . ' 00:00:00';
		}
	}
	
	private static function getBirthday($age) {
		static $now = null;
		if (is_null($now)) {
			$now = time();
		}
		$tmp = strtotime('-' . $age . ' year', $now);
		return date('Y-m-d', $tmp);
	}

	private static function setConditionMemberBirthdayMin(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.member_birthday_min');
		if (!empty($value) && preg_match('%^[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}$%', $value)) {
			$fieldName = $paginateOrmName . '.member_birthday >=';
			$std->conditions[$fieldName] = $value;
		}
	}
	
	private static function setConditionMemberBirthdayMax(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.member_birthday_max');
		if (!empty($value) && preg_match('%^[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}$%', $value)) {
			$fieldName = $paginateOrmName . '.member_birthday <=';
			$std->conditions[$fieldName] = $value;
		}
	}
	
	private static function setConditionTblGroupCountMin(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.tbl_group_count_min');
		if (!empty($value) && is_numeric($value)) {
			$fieldName = $paginateOrmName . '.tbl_group_count >=';
			$std->conditions[$fieldName] = $value;
		}
	}
	
	private static function setConditionTblGroupCountMax(stdClass $std, CakeRequest $request) {
		$paginateOrmName	= self::PAGINATE_ORM_NAME;
		$value = $request->data('MemberSearch.tbl_group_count_max');
		if (!empty($value) && is_numeric($value)) {
			$fieldName = $paginateOrmName . '.tbl_group_count <=';
			$std->conditions[$fieldName] = $value;
		}
	}

	/**
	 * ページェントデータを取得
	 * @param MemberSearchsController $ctl
	 * @return array
	 */
	public function getDataPaginate(MemberSearchsController $ctl) {
		$paginateOrmName = self::PAGINATE_ORM_NAME;
		return $ctl->paginate($paginateOrmName);
	}
}