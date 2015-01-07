<!-- MemberCreates/conf -->
<?php 
$ctlHelper	= $this->MemberCreate;

if (!$ctlHelper instanceof MemberCreateHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
// フォーム
$formStart				= $ctlHelper->getFormStart(array('action' => 'conf'));
$valueMemberName		= $ctlHelper->getValueMemberName		();
$valueMemberBirthday	= $ctlHelper->getValueMemberBirthday	();
$valueMstSexId			= $ctlHelper->getValueMstSexId			();
$valueRemarks			= $ctlHelper->getValueRemarks			();
$valueMemberMail		= $ctlHelper->getValueMemberMail		();
$valueSubMails			= $ctlHelper->getValueSubMails			();
$valueTblGroup			= $ctlHelper->getValueTblGroup			();
$submitBack				= $ctlHelper->getSubmitBack				('step03');
$submitComp				= $ctlHelper->getSubmitComp				();
$formEnd				= $ctlHelper->getFormEnd();
// リンク
$linkMemberSearch		= $ctlHelper->getLinkMemberSearch();
// テキスト
$titleSubMails			= $ctlHelper->getTitleSubMails();

?>
<div class="form">
	<h2>新規メンバー登録</h2>
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>メンバー名</th>
			<td><?php echo $valueMemberName; ?></td>
		</tr>
		<tr>
			<th>生年月日</th>
			<td><?php echo $valueMemberBirthday; ?></td>
		</tr>
		<tr>
			<th>性別</th>
			<td><?php echo $valueMstSexId; ?></td>
		</tr>
		<tr>
			<th>備考</th>
			<td><?php echo $valueRemarks; ?></td>
		</tr>
		<tr>
			<th>メールアドレス1</th>
			<td>
				<?php echo $valueMemberMail;	?>
			</td>
		</tr>
		<?php for ($i = 0, $cnt = count($valueSubMails); $i < $cnt; ++$i) { ?>
		<tr class="sysSubMail">
			<th><?php echo $titleSubMails[$i]; ?></th>
			<td><?php echo $valueSubMails[$i]; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>グループ</th>
			<td><?php echo $valueTblGroup; ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo $submitBack; ?>
				<?php echo $submitComp; ?>
			</td>
		</tr>
	</table>
	<?php echo $formEnd; ?>
</div>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $linkMemberSearch; ?></li>
	</ul>
</div>
