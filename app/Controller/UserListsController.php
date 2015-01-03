<?php
App::uses('AppController', 'Controller');
/**
 * UserLists Controller
 *
 * @property UserList $UserList
 * @property PaginatorComponent $Paginator
 */
class UserListsController extends AppController {
	
	public function index() {
		$ctl		= $this;
		$ctlModel	= $ctl->UserList;
		
		// ページェント設定
		$ctlModel->setPaginateParams($ctl);
		// ページェントデータを取得
		$dataPaginate = $ctlModel->getDataPaginate($ctl);
		
		$ctl->set(compact('dataPaginate'));
	}
}
