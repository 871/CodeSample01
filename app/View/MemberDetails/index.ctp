<!-- MemberDetails/index -->
<?php

$ctlHelper = $this->MemberDetail;

if (! isset($dataDetail))						throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
if (! $ctlHelper instanceof MemberDetailHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$ctlHelper->setDataDetail($dataDetail);

$textId					= $ctlHelper->getTextTblMemberId			();
$textMemberName			= $ctlHelper->getTextTblMemberMemberName	();
$textMemberMail			= $ctlHelper->getTextMemberMail				();
$textMstSexName			= $ctlHelper->getTextMstSexName				();
$textMemberBirthday		= $ctlHelper->getTextTblMemberMemberBirthday();
$textMemberAge			= $ctlHelper->getTextMemberAge				();
$textTblGroupCount		= $ctlHelper->getTextTblMemberTblGroupCount	();

$textTblGroup			= $ctlHelper->getTextTblGroup		();
$textRemarks			= $ctlHelper->getTextRemarks		();

$textCreateIp			= $ctlHelper->getTextTblMemberCreateIp		();
$textUdateIp			= $ctlHelper->getTextTblMemberUpdateIp		();
$textCreated			= $ctlHelper->getTextTblMemberCreated		();
$textUpdated			= $ctlHelper->getTextTblMemberUpdated		();
// リンク
$linkMemberCreate		= $ctlHelper->getLinkMemberCreate	();
$linkMemberSearch		= $ctlHelper->getLinkMemberSearch	();
$linkMemberEdit			= $ctlHelper->getLinkMemberEdit		();
$linkMemberDelete		= $ctlHelper->getLinkMemberDelete	();

?>
<div class="view">
	<h2>メンバー情報詳細</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>ID</th>
			<td><?php echo $textId; ?></td>
		</tr>
		<tr>
			<th>メンバ名</th>
			<td><?php echo $textMemberName; ?></td>
		</tr>
		<tr>
			<th>メールアドレス</th>
			<td><?php echo $textMemberMail; ?></td>
		</tr>
		<tr>
			<th>性別</th>
			<td><?php echo $textMstSexName; ?></td>
		</tr>
		<tr>
			<th>生年月日（年齢）</th>
			<td><?php echo $textMemberBirthday; ?>（<?php echo $textMemberAge; ?>）</td>
		</tr>
		<tr>
			<th>所属グループ数</th>
			<td><?php echo $textTblGroupCount; ?></td>
		</tr>
		<tr>
			<th>所属グループ（所属人数）</th>
			<td><?php echo $textTblGroup ?></td>
		</tr>
		<tr>
			<th>備考</th>
			<td><?php echo $textRemarks; ?></td>
		</tr>
		<tr>
			<th>登録IP</th>
			<td><?php echo $textCreateIp; ?></td>
		</tr>
		<tr>
			<th>更新IP</th>
			<td><?php echo $textUdateIp; ?></td>
		</tr>
		<tr>
			<th>登録日時</th>
			<td><?php echo $textCreated; ?></td>
		</tr>
		<tr>
			<th>更新日時</th>
			<td><?php echo $textUpdated; ?></td>
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
