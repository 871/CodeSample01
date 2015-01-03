<?php
App::uses('AppController', 'Controller');
App::uses('AjaxUtil', 'Lib/Util');
App::uses('UrlUtil'	, 'Lib/Util');

/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController {

	
	public function index() {
		$ctl	= $this;
		$model	= $ctl->Group;
		
		// ページェント設定
		$model->setPaginateParams($ctl);
		// ページェントデータを取得
		$dataPaginate = $model->getDataPaginate($ctl);
		
		$ctl->set(compact('dataPaginate'));
	}
	
	/**
	 * Ajaxアクセス専用
	 * @param string $requestToken
	 * @throws BadRequestException
	 */
	public function save($requestToken) {
		$ctl		= $this;
		$model		= $ctl->Group;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		if ($request->is('ajax') && AjaxUtil::checkToken($requestToken, $session)) {
			$result = $model->saveGroup($request->data);
			if ($result->result) {
				$session->setFlash(__('グループ情報を更新しました'));
			}
			echo json_encode($result);
		} else {
			throw new BadRequestException();
		}
		$ctl->autoRender = false;
	}
	
	
	public function delete($tbl_group_id) {
		$ctl		= $this;
		$model		= $ctl->Group;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		if ($request->is('post') && $model->deleteGroup($tbl_group_id)) {
			$session->setFlash(__('グループ情報の削除が完了しました'));
		} else {
			$session->setFlash(__('グループ情報の削除に失敗しました'));
		}
		$url = UrlUtil::getGroupList();
		$ctl->redirect($url);
	}
	
	public function beforeFilter() {
		$this->Security->unlockedActions = array('save');
		return parent::beforeFilter();
	}
}
