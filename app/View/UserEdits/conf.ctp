<!-- UserEdits/conf -->
<?php 
$ctlHelper	= $this->UserEdit;

if (!$ctlHelper instanceof UserEditHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$formStart		= $ctlHelper->getFormStart(array('action' => 'conf'));
$valueUserId		= $ctlHelper->getValueUserId		();
$valueUserName		= $ctlHelper->getValueUserName		();
$valueUserMail		= $ctlHelper->getValueUserMail		();
$valuePassword		= $ctlHelper->getValuePassword		();
$valueLoginFlag		= $ctlHelper->getValueLoginFlag		();

$submitBack		= $ctlHelper->getSubmitBack('input');
$submitSave		= $ctlHelper->getSubmitSave();
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
			<td><?php echo $valueUserName; ?></td>
		</tr>
		<tr>
			<th>メールアドレス</th>
			<td><?php echo $valueUserMail; ?></td>
		</tr>
		<tr>
			<th>パスワード</th>
			<td><?php echo $valuePassword; ?></td>
		</tr>
		<tr>
			<th>ログイン許可</th>
			<td><?php echo $valueLoginFlag; ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo $submitBack; ?>
				<?php echo $submitSave; ?>
			</td>
		</tr>
	</table>
	<?php echo $formEnd; ?>
</div>
<div class="actions">
	<h3>操作</h3>
		<li><?php echo $linkAccountList		; ?></li>
		<li><?php echo $linkAccountCreate	; ?></li>
	</ul>
</div>