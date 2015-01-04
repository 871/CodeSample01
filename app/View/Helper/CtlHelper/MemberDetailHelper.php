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
class MemberDetailHelper extends AppCtlHelper {
	
	public $dataDetail = array();

	/**
	 * 詳細情報
	 * @param array $dataDetail
	 */
	public function setDataDetail(array $dataDetail) {
		$this->dataDetail = $dataDetail;
	}

	/**
	 * TblMember.id
	 * @return string
	 */
	public function getTextId() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'id';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_name
	 * @return string
	 */
	public function getTextMemberName() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'member_name';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_mail
	 * @return string
	 */
	public function getTextMemberMail() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'member_mail';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * MstSex.name
	 * @return string
	 */
	public function getTextMstSexName() {
		$data	= $this->dataDetail;
		$alias	= 'MstSex';
		$field	= 'name';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_birthday
	 * @return string
	 */
	public function getTextMemberBirthday() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'member_birthday';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.member_birthday
	 * @return string
	 */
	public function getTextMemberAge() {
		$data	= $this->dataDetail;
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
	 * TblMember.tbl_group_count
	 * @return string
	 */
	public function getTextTblGroupCount() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'tbl_group_count';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblGroup
	 * @return string
	 */
	public function getTextTblGroup() {
		$data	= $this->dataDetail;
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
	 * TblMemberDetail.tbl_group_count
	 * @return string
	 */
	public function getTextRemarks() {
		$data	= $this->dataDetail;
		$alias	= 'TblMemberDetail';
		$field	= 'remarks';
		
		return nl2br(h($data[$alias][$field]));
	}
	
	/**
	 * TblMember.create_ip
	 * @return string
	 */
	public function getTextCreateIp() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'create_ip';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.update_ip
	 * @return string
	 */
	public function getTextUdateIp() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'update_ip';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.created
	 * @param int $index
	 * @return string
	 */
	public function getTextCreated() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'created';
		
		return h($data[$alias][$field]);
	}
	
	/**
	 * TblMember.updated
	 * @param int $index
	 * @return string
	 */
	public function getTextUpdated() {
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'updated';
		
		return h($data[$alias][$field]);
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
		$data	= $this->dataDetail;
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
		$data	= $this->dataDetail;
		$alias	= 'TblMember';
		$field	= 'id';
		
		$tbl_member_id	= $data[$alias][$field];
		$user_name		= $data[$alias]['member_name'];
		
		$title		= __('メンバー情報削除');
		$url		= UrlUtil::getMemberDelete($tbl_member_id);
		$options	= array();
		$confirmMessage = sprintf(__('ID: %1$s [%2$s]のメンバー情報を削除しますか？'), $tbl_member_id, $user_name);
		return $form->postLink($title, $url, $options, $confirmMessage);
	}
	/**/
}
