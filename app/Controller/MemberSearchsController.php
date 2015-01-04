<?php
App::uses('AppController', 'Controller');
/**
 * MemberSearchs Controller
 *
 * @property MemberSearch $MemberSearch
 * @property PaginatorComponent $Paginator
 */
class MemberSearchsController extends AppController {
	
	public function index() {
		$ctl		= $this;
		$model		= $ctl->MemberSearch;
		$request	= $ctl->request;
		$session	= $ctl->Session;
		
		$model->setInputFormParams();
		if ($request->is('post')) {
			$model->setRequestToSessionData($session, $request);
		} else {
			$model->setSessionToRequestData($request, $session);
		}
		// ページェント設定
		$model->setPaginateParams($ctl, $request);
		// ページェントデータを取得
		$dataPaginate = $model->getDataPaginate($ctl);
		
		$ctl->set(compact('dataPaginate'));
	}
	
	public function beforeFilter() {
		$this->Security->unlockedActions[] = 'index';
		return parent::beforeFilter();
	}
}
