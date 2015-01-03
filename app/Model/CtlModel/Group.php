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
App::uses('OrmModelUtil', 'Lib/Util');
App::uses('GroupToTblGroup', 'Lib/Convert/TblGroup');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Group extends AppCtlModel {
	
	const PAGINATE_ORM_NAME = 'TblGroup';
	
	const TMP_REQUEST_SESSION_KEY = 'tmp.Request.Group';
	
	public $validate = array(
		'id' => array(
			'numeric' => array(
				'rule'			=> array('numeric',),
				'message'		=> 'GroupIDが不正です',
				'allowEmpty'	=> true,
				// 'required'	=> true,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_name' => array(
			'notEmpty' => array(
				'rule'			=> array('notEmpty', ),
				'message'		=> 'グループ名を入力して下さい',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule'			=> array('maxlength', 50),
				'message'		=> 'グループ名は50文字以内で入力して下さい',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
			'checkUnique' => array(
				'rule'			=> array('checkUnique', 'TblGroup', 'group_name', 'id'),
				'message'		=> 'このグループ名は登録済です',
				// 'allowEmpty'	=> true,
				// 'required'	=> false,
				// 'last'		=> false, // Stop validation after this rule
				// 'on'			=> 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	
	/**
	 * フォーム設定用のパラメータ
	 * @var type 
	 */
	public $fieldParams = array(
		'id' => array(
			'type'			=> 'hidden',
		),
		'group_name' => array(
			'type'			=> 'text',
			'maxlength'		=> 50,
			'required'		=> true,
		),
	);
	
	
	/**
	 * ページェント設定
	 * @param GroupsController $ctl
	 */
	public function setPaginateParams(GroupsController $ctl) {
		$paginateOrmName = self::PAGINATE_ORM_NAME;
		
		$ctl->{$paginateOrmName} = ClassRegistry::init($paginateOrmName);
		$ctl->paginate = array(
			$paginateOrmName => array(
				'fields' => array(
					$paginateOrmName . '.id',
					$paginateOrmName . '.group_name',
					$paginateOrmName . '.tbl_member_count',
					$paginateOrmName . '.create_ip',
					$paginateOrmName . '.update_ip',
					$paginateOrmName . '.created',
					$paginateOrmName . '.updated',
				),
				'recursive'		=> 0,
				'limit'			=> 20,
				'order' => array(
					$paginateOrmName . '.updated'	=> 'DESC',
				),
			),
		);
	}
	
	/**
	 * ページェントデータを取得
	 * @param GroupsController $ctl
	 * @return array
	 */
	public function getDataPaginate(GroupsController $ctl) {
		$paginateOrmName = self::PAGINATE_ORM_NAME;
		return $ctl->paginate($paginateOrmName);
	}
	
	/**
	 * グループ情報の作成、更新
	 * @param array $data
	 * @return \stdClass
	 */
	public function saveGroup(array $data) {
		$ctlModel = $this;
		$result = new stdClass();
		
		$ctlModel->set($data);
		$result->result = $ctlModel->validates();
		if ($result->result) {
			$result->result = self::saveTransaction($ctlModel);
		}
		if (! $result->result) {
			$result->errMessages = self::getErrorMessages($ctlModel);
		}
		return $result;
	}
	
	private static function saveTransaction(self $ctlModel) {
		$db			= $ctlModel->getDataSource();
		$tblGroup	= ClassRegistry::init('TblGroup');
		
		try {
			$db->begin();
			// アカウント情報
			GroupToTblGroup::convert($ctlModel, $tblGroup);
			OrmModelUtil::transactionSave($tblGroup);
			$db->commit();
		} catch (ErrorException $e) {
			$db->rollback();
			$ctlModel->validationErrors[] = $e->getMessage();
			return false;
		}
		return true;
	}
	
	private static function getErrorMessages(self $ctlModel) {
		$arrTmp1	= $ctlModel->validationErrors;
		$arrTmp2	= Hash::flatten($arrTmp1);
		return array_values($arrTmp2);
	}
	
	/**
	 * グループ削除
	 * @param int $tbl_geoup_id
	 * @return boolean
	 */
	public function deleteGroup($tbl_geoup_id) {
		$tblGroup = ClassRegistry::init('TblGroup');
		return $tblGroup->delete($tbl_geoup_id);
	}
}