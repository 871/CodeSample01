<?php
App::uses('AppController', 'Controller');
/**
 * MemberDetails Controller
 *
 * @property MemberDetail $MemberDetail
 * @property PaginatorComponent $Paginator
 */
class MemberDetailsController extends AppController {

	
	public function index($tbl_member_id) {
		$ctl		= $this;
		$model		= $ctl->MemberDetail;
		
		$dataDetail = $model->getDataDetail($tbl_member_id);
		$ctl->set(compact('dataDetail'));
	}
}
