<?php
App::uses('AppController', 'Controller');
App::uses('UrlUtil', 'Lib/Util');

/**
 * MemberCreates Controller
 *
 * @property MemberCreate $MemberCreate
 * @property PaginatorComponent $Paginator
 */
class MemberCreatesController extends AppController {

	public function index() {
		$this->setAction('step01', true);
	}
	
	/**
	 * 入力（1）
	 */
	public function step01($flgSetAction = false) {
		$ctl		= $this;
		$model		= $ctl->MemberCreate;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setInputFormParams();
		$model->setSessionToRequestData($request, $session);
		if ($request->is('post') && $flgSetAction === false) {
			$model->set($request->data);
			if ($model->validates()) {
				$model->setRequestToSessionData($session, $request);
				$ctl->setAction('step02', true);
				return;
			} else {
				$session->setFlash(__('入力内容を確認して下さい'));
			}
		}
	}
	
	/**
	 * 入力（2）
	 */
	public function step02($flgSetAction = false) {
		$ctl		= $this;
		$model		= $ctl->MemberCreate;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setInputFormParams();
		$model->setSessionToRequestData($request, $session);
		if ($request->is('post') && $flgSetAction === false) {
			$model->set($request->data);
			if ($model->validates()) {
				$model->setRequestToSessionData($session, $request);
				$ctl->setAction('step03', true);
				return;
			} else {
				$session->setFlash(__('入力内容を確認して下さい'));
			}
		}
	}
	
	/**
	 * 入力（3）
	 */
	public function step03($flgSetAction = false) {
		$ctl		= $this;
		$model		= $ctl->MemberCreate;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setInputFormParams();
		$model->setSessionToRequestData($request, $session);
		if ($request->is('post') && $flgSetAction === false) {
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
		$model		= $ctl->MemberCreate;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setInputFormParams();
		$model->setSessionToRequestData($request, $session);
		if ($request->is('post') && $flgSetAction === false) {
			if (!empty($request->data) && $model->saveMember($request->data)) {
				$model->deleteRequestSessionData($session);
				$session->setFlash(__('メンバ情報を作成しました'));
				$ctl->setAction('comp', true);
				return;
			} else {
				$session->setFlash(__('メンバ情報の作成に失敗しました'));
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
