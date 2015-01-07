<!-- MemberCreates/step01 -->
<?php 
$ctlHelper	= $this->MemberCreate;

if (!$ctlHelper instanceof MemberCreateHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
// フォーム
$formStart				= $ctlHelper->getFormStart(array('action' => 'step01'));
$inputMemberName		= $ctlHelper->getInputMemberName		();
$inputMemberBirthday	= $ctlHelper->getInputMemberBirthday	();
$inputMstSexId			= $ctlHelper->getInputMstSexId			();
$inputRemarks			= $ctlHelper->getInputRemarks			();
$submitNext				= $ctlHelper->getSubmitNext				();
$formEnd				= $ctlHelper->getFormEnd();
// リンク
$linkMemberSearch = $ctlHelper->getLinkMemberSearch();

?>
<div class="form">
	<h2>新規メンバー登録</h2>
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>メンバー名</th>
			<td><?php echo $inputMemberName; ?></td>
		</tr>
		<tr>
			<th>生年月日</th>
			<td><?php echo $inputMemberBirthday; ?></td>
		</tr>
		<tr>
			<th>性別</th>
			<td><?php echo $inputMstSexId; ?></td>
		</tr>
		<tr>
			<th>備考</th>
			<td><?php echo $inputRemarks; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $submitNext; ?></td>
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
