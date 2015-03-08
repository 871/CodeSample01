<?php
App::uses('AppController', 'Controller');
App::uses('UrlUtil', 'Lib/Util');

/**
 * MemberEdits Controller
 *
 * @property MemberEdit $MemberEdit
 * @property PaginatorComponent $Paginator
 */
class MemberEditsController extends AppController {

	public function index($tbl_member_id) {
		$ctl		= $this;
		$model		= $ctl->MemberEdit;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setEditDataToRequest($request, $tbl_member_id);
		$model->setRequestToSessionData($session, $request);
		$this->setAction('input', true);
	}
	
	/**
	 * 入力（1）
	 */
	public function input($flgSetAction = false) {
		$ctl		= $this;
		$model		= $ctl->MemberEdit;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setInputFormParams();
		$model->setSessionToRequestData($request, $session);
		if ($request->is('post') && $flgSetAction !== true) {
			$model->set($request->data);
			if ($model->validates()) {
				$model->setRequestToSessionData($session, $request);
				$ctl->setAction('conf', true);
				return;
			} else {
				$session->setFlash(__('入力内容を確認して下さい'));
			}
		}
	}
	
	/**
	 * 入力確認
	 */
	public function conf($flgSetAction = false) {
		$ctl		= $this;
		$model		= $ctl->MemberEdit;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setInputFormParams();
		$model->setSessionToRequestData($request, $session);
		if ($request->is('post') && $flgSetAction !== true) {
			if (!empty($request->data) && $model->saveMember($request->data)) {
				$model->deleteRequestSessionData($session);
				$session->setFlash(__('メンバ情報を更新しました'));
				//$ctl->setAction('comp', true);
				return;
			} else {
				$session->setFlash(__('メンバ情報の更新に失敗しました'));
				$ctl->setAction('input', true);
				return;
			}
		}
	}
	
	/**
	 * 登録完了
	 */
	public function comp() {
		$ctl	= $this;
		$url	= UrlUtil::getMemberSearch();
		$ctl->redirect($url);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function beforeRender() {
		parent::beforeRender();
	}
	
	public function afterFilter() {
		parent::afterFilter();
	}
	
}
