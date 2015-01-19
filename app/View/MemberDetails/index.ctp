<!-- MemberDetails/index -->
<?php

$ctlHelper = $this->MemberDetail;

if (! isset($dataTblMember))					throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
if (! $ctlHelper instanceof MemberDetailHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$ctlHelper->setDataTblMember($dataTblMember);
// テキスト
$textTblMemberId						= $ctlHelper->getTextTblMemberId					();
$textTblMemberMemberName				= $ctlHelper->getTextTblMemberMemberName			();
$textMemberMail							= $ctlHelper->getTextMemberMail						();
$textTblMemberMstSexName				= $ctlHelper->getTextTblMemberMstSexName			();
$textTblMemberMemberBirthday			= $ctlHelper->getTextTblMemberMemberBirthday		();
$textMemberAge							= $ctlHelper->getTextMemberAge						();
$textTblMemberTblGroupCount				= $ctlHelper->getTextTblMemberTblGroupCount			();
$textTblGroup							= $ctlHelper->getTextTblGroup						();
$textTblMemberTblMemberDetailRemarks	= $ctlHelper->getTextTblMemberTblMemberDetailRemarks();
$textTblMemberCreateIp					= $ctlHelper->getTextTblMemberCreateIp				();
$textTblMemberUpdateIp					= $ctlHelper->getTextTblMemberUpdateIp				();
$textTblMemberCreated					= $ctlHelper->getTextTblMemberCreated				();
$textTblMemberUpdated					= $ctlHelper->getTextTblMemberUpdated				();
 // リンク
$linkMemberCreate	= $ctlHelper->getLinkMemberCreate	();
$linkMemberSearch	= $ctlHelper->getLinkMemberSearch	();
$linkMemberEdit		= $ctlHelper->getLinkMemberEdit		();
$linkMemberDelete	= $ctlHelper->getLinkMemberDelete	();

?>
<div class="view">
	<h2>メンバー情報詳細</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>ID</th>
			<td><?php echo $textTblMemberId; ?></td>
		</tr>
		<tr>
			<th>メンバ名</th>
			<td><?php echo $textTblMemberMemberName; ?></td>
		</tr>
		<tr>
			<th>メールアドレス</th>
			<td><?php echo $textMemberMail; ?></td>
		</tr>
		<tr>
			<th>性別</th>
			<td><?php echo $textTblMemberMstSexName; ?></td>
		</tr>
		<tr>
			<th>生年月日（年齢）</th>
			<td><?php echo $textTblMemberMemberBirthday; ?>（<?php echo $textMemberAge; ?>）</td>
		</tr>
		<tr>
			<th>所属グループ数</th>
			<td><?php echo $textTblMemberTblGroupCount; ?></td>
		</tr>
		<tr>
			<th>所属グループ（所属人数）</th>
			<td><?php echo $textTblGroup ?></td>
		</tr>
		<tr>
			<th>備考</th>
			<td><?php echo $textTblMemberTblMemberDetailRemarks; ?></td>
		</tr>
		<tr>
			<th>登録IP</th>
			<td><?php echo $textTblMemberCreateIp; ?></td>
		</tr>
		<tr>
			<th>更新IP</th>
			<td><?php echo $textTblMemberUpdateIp; ?></td>
		</tr>
		<tr>
			<th>登録日時</th>
			<td><?php echo $textTblMemberCreated; ?></td>
		</tr>
		<tr>
			<th>更新日時</th>
			<td><?php echo $textTblMemberUpdated; ?></td>
		</tr>
	</table>
</div>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $linkMemberCreate;	?></li>
		<li><?php echo $linkMemberSearch;	?></li>
		<li><?php echo $linkMemberEdit;		?></li>
		<li><?php echo $linkMemberDelete;	?></li>
	</ul>
</div>
