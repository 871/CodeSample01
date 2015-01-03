<?php
App::uses('AppController', 'Controller');
App::uses('UrlUtil', 'Lib/util');

/**
 * UserCreates Controller
 *
 * @property UserCreate $UserCreate
 * @property PaginatorComponent $Paginator
 */
class UserCreatesController extends AppController {
	
	public function index() {
		$this->setAction('input', true);
	}

	/**
	 * 入力（1）
	 */
	public function input($flgSetAction = false) {
		$ctl		= $this;
		$model		= $ctl->UserCreate;
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
		$model		= $ctl->UserCreate;
		$session	= $ctl->Session;
		$request	= $ctl->request;
		
		$model->setInputFormParams();
		$model->setSessionToRequestData($request, $session);
		if ($request->is('post') && $flgSetAction === false) {
			if (!empty($request->data) && $model->saveUser($request->data)) {
				$model->deleteRequestSessionData($session);
				$session->setFlash(__('アカウントを作成しました'));
				$ctl->setAction('comp', true);
				return;
			} else {
				$session->setFlash(__('アカウントの作成に失敗しました'));
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
		$url	= UrlUtil::getAccountList();
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
