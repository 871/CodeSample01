<?php
App::uses('AppController', 'Controller');
App::uses('UrlUtil', 'Lib/Util');

/**
 * UserDeletes Controller
 *
 * @property UserDelete $UserDelete
 * @property PaginatorComponent $Paginator
 */
class UserDeletesController extends AppController {


	public function index($tbl_user_id) {
		$ctl		= $this;
		$model		= $ctl->UserDelete;
		$request	= $ctl->request;
		$session	= $ctl->Session;
		
		$flashMessage = __('アカウント情報の削除に失敗しました');
		if ($request->is('post')) {
			if ($model->deleteUser($tbl_user_id)) {
				$flashMessage = __('アカウント情報の削除が完了しました');
			}
		}
		$session->setFlash($flashMessage);
		$url = UrlUtil::getAccountList();
		$ctl->redirect($url);
	}
}
