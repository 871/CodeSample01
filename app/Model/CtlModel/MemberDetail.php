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
class MemberDetail extends AppCtlModel {
	
	
	public function getDataDetail($tbl_member_id) {
		$tblMember = ClassRegistry::init('TblMember');
		$options = array(
			'conditions' => array(
				'TblMember.id' => $tbl_member_id,
			),
			'recursive'	=> 1,
		);
		return $tblMember->find('first', $options);
	}
}