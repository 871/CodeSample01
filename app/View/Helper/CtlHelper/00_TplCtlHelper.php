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

App::uses('AppCtlHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 * @property ExtFormHelper $ExtForm
 */
class TplCtlHelper extends AppCtlHelper {

	/**
	 * フォーム開始
	 * @return string
	 */
	public function getFormStart($options = array()) {
		$form	= $this->ExtForm;
		$alias	= $this->alias;
		return $form->create($alias, $options);
	}
	
	/**
	 * フォーム終了
	 * @return string
	 */
	public function getFormEnd() {
		$form = $this->ExtForm;
		return $form->end();
	}
	
	
	
	
	
	/**
	 * サブミットボタン(確認)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitConfirm() {
		$form	= $this->ExtForm;
		$caption	= '確認';
		$options	= array(
			'class' => 'bt_confirm',
			'div'	=> false,
		);
		return $form->submit($caption, $options);
	}
	
	/**
	 * サブミットボタン(戻る)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitBack() {
		$form	= $this->ExtForm;
		$caption	= '戻る';
		$options	= array(
			'class' => 'bt_back',
			'div'	=> false,
		);
		return $form->submit($caption, $options);
	}
	
	/**
	 * サブミットボタン(保存)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitSave() {
		$form	= $this->ExtForm;
		$caption	= '保存';
		$options	= array(
			'class' => 'bt_save',
			'div'	=> false,
		);
		return $form->submit($caption, $options);
	}

	public function getDivNaviLinks() {
		
	}
	/**/
}
