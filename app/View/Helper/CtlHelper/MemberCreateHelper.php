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
App::uses('TblMemberSubMail', 'Model');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 * @property ExtFormHelper $ExtForm
 */
class MemberCreateHelper extends AppCtlHelper {

	
	
	
	
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
	 * メンバ名
	 * @return string
	 */
	public function getInputMemberName() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'member_name';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * 生年月日
	 * @return string
	 */
	public function getInputMemberBirthday() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'member_birthday';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * 性別
	 * @return string
	 */
	public function getInputMstSexId() {
		$form		= $this->ExtForm;
		$options	= array(
			'before'	=> '<label>',
			'separator'	=> '</label><label>',
			'after'		=> '</label>',
		);
		$field		= 'mst_sex_id';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * 備考
	 * @return string
	 */
	public function getInputRemarks() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'remarks';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * メンバメールアドレス
	 * @return string
	 */
	public function getInputMemberMail() {
		$form		= $this->ExtForm;
		$options	= array(
			'style' => 'width: 90%;',
		);
		$field		= 'member_mail';
		return $form->error($field) . $form->input($field, $options);
	}
	
	/**
	 * メンバメールアドレス(サブ)
	 * @return string
	 */
	public function getInputsSubMail() {
		$form		= $this->ExtForm;
		$options	= array();
		
		$inputs = array();
		for ($i = 0, $cnt = TblMemberSubMail::MAX_DATA_COUNT; $i < $cnt; ++$i) {
			$field	= 'sub_mail_' . $i;
			
			$inputs[] = $form->error($field) . $form->input($field, $options);
		}
		return $inputs;
	}
	
	/**
	 * グループ
	 * @return type
	 */
	public function getInputTblGroup() {
		$form		= $this->ExtForm;
		$options	= array();
		$field		= 'TblGroup';
		$error		= $form->error($field);
		$tmp		= $form->input($field, $options);
		
		
		$input = preg_replace('%(<div[^>]+>|</div>)%', '', $tmp);
		return $error . $input;
	}
	
	/**
	 * メンバ名
	 * @return string
	 */
	public function getValueMemberName() {
		$form		= $this->ExtForm;
		$field		= 'member_name';
		return h($form->extValue($field));
	}
	
	/**
	 * 生年月日
	 * @return string
	 */
	public function getValueMemberBirthday() {
		$form		= $this->ExtForm;
		$field		= 'member_birthday';
		return h($form->extValue($field));
	}
	
	/**
	 * 性別
	 * @return string
	 */
	public function getValueMstSexId() {
		$form		= $this->ExtForm;
		$field		= 'mst_sex_id';
		return h($form->extValue($field));
	}
	
	/**
	 * 備考
	 * @return string
	 */
	public function getValueRemarks() {
		$form		= $this->ExtForm;
		$field		= 'remarks';
		return nl2br(h($form->extValue($field)));
	}
	
	/**
	 * メンバメールアドレス
	 * @return string
	 */
	public function getValueMemberMail() {
		$form		= $this->ExtForm;
		$field		= 'member_mail';
		return h($form->extValue($field));
	}
	
	/**
	 * メンバメールアドレス(サブ)
	 * @return string
	 */
	public function getValuesSubMail() {
		$form		= $this->ExtForm;
		$values = array();
		for ($i = 0, $cnt = TblMemberSubMail::MAX_DATA_COUNT; $i < $cnt; ++$i) {
			$field	= 'sub_mail_' . $i;
			$values[] = h($form->extValue($field));
		}
		return $values;
	}
	
	/**
	 * グループ
	 * @return type
	 */
	public function getValueTblGroup() {
		$form		= $this->ExtForm;
		$field		= 'TblGroup';
		return h($form->extValue($field));
	}

	/**
	 * サブミットボタン(次へ)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitNext() {
		$form	= $this->ExtForm;
		$caption	= '次　へ';
		$options	= array(
			'div'	=> false,
		);
		return $form->submit($caption, $options);
	}
	
	/**
	 * サブミットボタン(確認)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitConf() {
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
					"location.href = '/MemberCreates/{$backAction}';",
					'return false;',
				'});',
			'})(jQuery)</script>',
		);
		
		$script = join("\n", $arrTags);
		return $form->submit($caption, $options) . $script;
	}
	
	/**
	 * サブミットボタン(登録)
	 * @param string $caption
	 * @return string
	 */
	public function getSubmitComp() {
		$form	= $this->ExtForm;
		$caption	= '登　録';
		$options	= array(
			'div'	=> false,
		);
		return $form->submit($caption, $options);
	}

	/**
	 * メンバメールアドレス(サブ)
	 * @return string
	 */
	public function getTitlesSubMail() {
		$tpl = 'メールアドレス';
		$titles = array();
		for ($i = 0, $cnt = TblMemberSubMail::MAX_DATA_COUNT; $i < $cnt; ++$i) {
			$titles[] = $tpl . ($i + 2);
		}
		return $titles;
	}
	
	/**
	 * メールアドレス追加（表示コントロール）
	 * @return string
	 */
	public function getLinkMailAdd() {
		$html		= $this->Html;
		$title		= __('追加');
		$url		= '#';
		$options	= array(
			'class' => 'sysRowAdd',
		);
		return $html->link($title, $url, $options);
	}

	/**
	 * メンバー検索リンク
	 * @return string
	 */
	public function getLinkMemberSearch() {
		$html		= $this->Html;
		$title		= __('メンバー情報検索');
		$url		= UrlUtil::getMemberSearch();
		$options	= array();
		return $html->link($title, $url, $options);
	}
	
	/**
	 * パンくずナビゲータ
	 * @return string
	 */
	public function getDivNaviLinks() {
		$html		= $this->Html;
		$request	= $this->request;
		$action		= $request->params['action'];
		
		$url1 = $url2 = $url3 = null;
		switch ($action) {
			case 'conf':
				$url3 = array('action' => 'step03',);
			case 'step03':
				$url2 = array('action' => 'step02',);
			case 'step02':
				$url1 = array('action' => 'step01',);
			case 'step01':
			default :
				// 処理無し
				break;
		}
		
		$html->addCrumb('Step1(メンバ情報)'		, $url1);
		$html->addCrumb('Step2(メールアドレス)'	, $url2);
		$html->addCrumb('Step3(グループ情報)'		, $url3);
		$html->addCrumb('登録確認');
		$html->addCrumb('登録完了');
		
		return $html->getCrumbs(" > ");
	}
	/**/
}
