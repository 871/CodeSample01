<!-- UserEdits/input -->
<?php 
$ctlHelper	= $this->UserEdit;

if (!$ctlHelper instanceof UserEditHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$formStart		= $ctlHelper->getFormStart(array('action' => 'input'));
$valueUserId		= $ctlHelper->getValueUserId		();
$inputUserName		= $ctlHelper->getInputUserName		();
$inputUserMail		= $ctlHelper->getInputUserMail		();
$inputPassword		= $ctlHelper->getInputPassword		();
$inputPasswordConf	= $ctlHelper->getInputPasswordConf	();
$inputLoginFlag		= $ctlHelper->getInputLoginFlag		();
$submitConfirm		= $ctlHelper->getSubmitConfirm		();
$formEnd		= $ctlHelper->getFormEnd();

// リンク
$linkAccountList	= $ctlHelper->getLinkAccountList	();
$linkAccountCreate	= $ctlHelper->getLinkAccountCreate	();

?>
<div class="form">
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>管理者ID</th>
			<td><?php echo $valueUserId; ?></td>
		</tr>
		<tr>
			<th>管理者名</th>
			<td><?php echo $inputUserName; ?></td>
		</tr>
		<tr>
			<th>メールアドレス</th>
			<td><?php echo $inputUserMail; ?></td>
		</tr>
		<tr>
			<th>パスワード</th>
			<td><?php echo $inputPassword; ?></td>
		</tr>
		<tr>
			<th>パスワード（確認）</th>
			<td><?php echo $inputPasswordConf; ?></td>
		</tr>
		<tr>
			<th>ログイン許可</th>
			<td><?php echo $inputLoginFlag; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $submitConfirm; ?></td>
		</tr>
	</table>
	<?php echo $formEnd; ?>
</div>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $linkAccountList		; ?></li>
		<li><?php echo $linkAccountCreate	; ?></li>
	</ul>
</div>