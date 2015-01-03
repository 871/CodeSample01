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
class UserList extends AppCtlModel {
	
	const PAGINATE_ORM_NAME = 'TblUser';
	
	/**
	 * ページェント設定
	 * @param UserListsController $ctl
	 */
	public function setPaginateParams(UserListsController $ctl) {
		$paginateOrmName = self::PAGINATE_ORM_NAME;
		
		$ctl->{$paginateOrmName} = ClassRegistry::init($paginateOrmName);
		$ctl->paginate = array(
			$paginateOrmName => array(
				'fields' => array(
					$paginateOrmName . '.id',
					$paginateOrmName . '.user_name',
					$paginateOrmName . '.user_mail',
					$paginateOrmName . '.login_flag',
					$paginateOrmName . '.create_ip',
					$paginateOrmName . '.update_ip',
					$paginateOrmName . '.created',
					$paginateOrmName . '.updated',
				),
				'recursive'		=> 0,
				'limit'			=> 20,
				'order' => array(
					$paginateOrmName . '.id'	=> 'DESC',
				),
			),
		);
	}
	
	/**
	 * ページェントデータを取得
	 * @param UserListsController $ctl
	 * @return array
	 */
	public function getDataPaginate(UserListsController $ctl) {
		$paginateOrmName = self::PAGINATE_ORM_NAME;
		return $ctl->paginate($paginateOrmName);
	}
}