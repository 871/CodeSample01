<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Paginator',
		'Session',
		'Security',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'TblUser',
					'fields' => array(
						'username'	=> 'user_mail',
						'password'	=> 'password',
					),
					'scope' => array(
						'TblUser.login_flag' => true,
					),
				),
			),
			//ログイン後の移動先
			'loginRedirect'		=> array('controller' => 'Mains', 'action' => 'index'),
			//ログアウ後の移動先
			'logoutRedirect'	=> array('controller' => 'Mains', 'action' => 'login'),
			//ログインページのパス
			'loginAction'		=> array('controller' => 'Mains', 'action' => 'login'),
			'authError'			=> 'ログインしてください',
		),
	);
	
	public $helpers = array(
		'Session',
		'Html',
		'ExtForm',
		'Project',
	);
}