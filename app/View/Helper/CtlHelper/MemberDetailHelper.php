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
App::uses('TblMemberView', 'Lib/Trait/OrmView');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 * @property ExtFormHelper $ExtForm
 */
class MemberDetailHelper extends AppCtlHelper {
	
	use TblMemberView;
	
	// TblMemberView::$dataTblMember;
	
	/**
	 * TblMember.member_mail
	 * @return string
	 */
	public function getTextMemberMail() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'member_mail';
		$value	= $data[$alias][$field];
		
		$path	= 'TblMemberSubMail.{n}.sub_mail';
		$arrTmp = Hash::extract($data, $path);
		array_unshift($arrTmp, $value);
		
		$result = join("\n", $arrTmp);
		return nl2br(h($result));
	}
	
	/**
	 * TblMember.member_birthday
	 * @return string
	 */
	public function getTextMemberAge() {
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		
		$value	= $data[$alias][$field];
		if (!empty($value)){
			static $now = null;
			if (is_null($now)) {
				$now = date('Ymd');
			}
			$tmp1 = strtotime($value);
			$tmp2 = date('Ymd', $tmp1);
			$tmp3 = ($now - $tmp2) / 10000;
			return h((int) $tmp3);
		} else {
			return h('--');
		}
	}
	
	/**
	 * TblGroup
	 * @return string
	 */
	public function getTextTblGroup() {
		$data	= $this->dataTblMember;
		$path1	= 'TblGroup.{n}.group_name';
		$path2	= 'TblGroup.{n}.tbl_member_count';
		
		$arrTmp1 = Hash::extract($data, $path1);
		$arrTmp2 = Hash::extract($data, $path2);
		
		$arrTmp3 = array();
		for ($i = 0, $cnt = count($arrTmp1); $i < $cnt; ++$i) {
			$arrTmp3[] = $arrTmp1[$i] . '（' . $arrTmp2[$i] . '）';
		}
		$arrTmp4 = join("\n", $arrTmp3);
		return nl2br(h($arrTmp4));
	}
	
	/**
	 * メンバ情報作成リンク
	 * @return string
	 */
	public function getLinkMemberCreate() {
		$html		= $this->Html;
		$title		= __('新規メンバー登録');
		$url		= UrlUtil::getMemberCreate();
		$options	= array();
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
	 * メンバ情報編集リンク
	 * @return string
	 */
	public function getLinkMemberEdit() {
		$form	= $this->ExtForm;
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'id';
		
		$tbl_member_id = $data[$alias][$field];
		
		$title		= __('メンバー情報編集');
		$url		= UrlUtil::getMemberEdit($tbl_member_id);
		$options	= array();
		return $form->postLink($title, $url, $options);
	}
	
	/**
	 * メンバ情報削除リンク
	 * @return string
	 */
	public function getLinkMemberDelete() {
		$form	= $this->ExtForm;
		$data	= $this->dataTblMember;
		$alias	= 'TblMember';
		$field	= 'id';
		
		$tbl_member_id	= $data[$alias][$field];
		$member_name	= $data[$alias]['member_name'];
		
		$title		= __('メンバー情報削除');
		$url		= UrlUtil::getMemberDelete($tbl_member_id);
		$options	= array();
		$confirmMessage = sprintf(__('ID: %1$s [%2$s]のメンバー情報を削除しますか？'), $tbl_member_id, $member_name);
		return $form->postLink($title, $url, $options, $confirmMessage);
	}
	/**/
}
