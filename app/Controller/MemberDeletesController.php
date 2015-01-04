<?php
App::uses('AppController', 'Controller');
App::uses('UrlUtil', 'Lib/Util');

/**
 * MemberDeletes Controller
 *
 * @property MemberDelete $MemberDelete
 * @property PaginatorComponent $Paginator
 */
class MemberDeletesController extends AppController {

	
	public function index($tbl_member_id) {
		$ctl		= $this;
		$model		= $ctl->MemberDelete;
		$request	= $ctl->request;
		$session	= $ctl->Session;
		
		$flashMessage = __('メンバ情報の削除に失敗しました');
		if ($request->is('post')) {
			if ($model->deleteMember($tbl_member_id)) {
				$flashMessage = __('メンバ情報の削除が完了しました');
			}
		}
		$session->setFlash($flashMessage);
		$url = UrlUtil::getMemberSearch();
		$ctl->redirect($url);
	}
	
}
