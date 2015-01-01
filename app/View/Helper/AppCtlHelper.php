<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 * @property ExtFormHelper $ExtForm
 * @property HtmlHelper $Html
 * @property SessionHelper $Session
 * @property PaginatorHelper $Paginator
 */
class AppCtlHelper extends AppHelper {
	
	public $helpers = array('ExtForm', 'Html', 'Session', 'Paginator');

	protected $data = array();
	
	protected $alias = '';
	
	
	public function __construct(View $View, $settings = array()) {
		$this->alias = self::createAlias($this);
		parent::__construct($View, $settings);
	}

	public function setData($data) {
		$this->data = $data;
	}
	
	/**
	 * 
	 * @param self $helper
	 */
	private static function createAlias(self $helper) {
		return preg_replace('/Helper$/', '', get_class($helper));
	}
	
}