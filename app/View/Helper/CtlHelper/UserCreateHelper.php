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
App::uses('UrlUtil', 'Lib/Util');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 * @property ExtFormHelper $ExtForm
 */
class UserCreateHelper extends AppCtlHelper {
	
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
		$caption	= '確　認';
		$options	= array(
			'div'	=> false,
		);
		return $form->submit($caption, $options);
	}
	
	/**
	 * サブミットボタン(戻る)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitBack($backAction) {
		$form	= $this->ExtForm;
		$caption	= '戻　る';
		$options	= array(
			'class'	=> 'bt_back',
			'div'	=> false,
		);
		
		$arrTags = array(
			'<script>(function($) {',
				"$('.bt_back').click(function(){",
					"location.href = '/UserCreates/{$backAction}';",
					'return false;',
				'});',
			'})(jQuery)</script>',
		);
		
		$script = join("\n", $arrTags);
		return $form->submit($caption, $options) . $script;
	}
	
	/**
	 * サブミットボタン(保存)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitSave() {
		$form	= $this->ExtForm;
		$caption	= '登　録';
		$options	= array(
			'div'	=> false,
		);
		return $form->submit($caption, $options);
	}
	
	/**
	 * 管理者名
	 * @return string
	 */
	public function getInputUserName() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'user_name';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * メールアドレス
	 * @return string
	 */
	public function getInputUserMail() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'user_mail';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * パスワード
	 * @return string
	 */
	public function getInputPassword() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'password';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * パスワード（確認）
	 * @return string
	 */
	public function getInputPasswordConf() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'password_conf';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * ログイン許可
	 * @return string
	 */
	public function getInputLoginFlag() {
		$form		= $this->ExtForm;
		$options	= array(
			'before' => '<label>',
			'after'	=> ' ログインを許可する</label>',
		);
		$field		= 'login_flag';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * 管理者名
	 * @return string
	 */
	public function getValueUserName() {
		$form		= $this->ExtForm;
		$field		= 'user_name';
		return h($form->extValue($field));
	}
	
	/**
	 * メールアドレス
	 * @return string
	 */
	public function getValueUserMail() {
		$form		= $this->ExtForm;
		$field		= 'user_mail';
		return h($form->extValue($field));
	}
	
	/**
	 * パスワード
	 * @return string
	 */
	public function getValuePassword() {
		return h('********(非表示)');
	}
	
	/**
	 * ログイン許可
	 * @return string
	 */
	public function getValueLoginFlag() {
		$form		= $this->ExtForm;
		$field		= 'login_flag';
		return h($form->extValue($field));
	}
	
	/**
	 * アカウント情報一覧リンク
	 * @param int $index
	 * @return string
	 */
	public function getLinkAccountList() {
		$form	= $this->ExtForm;
		$title		= __('アカウント一覧');
		$url		= UrlUtil::getAccountList();
		$options	= array();
		return $form->postLink($title, $url, $options);
	}
	/**/
}
