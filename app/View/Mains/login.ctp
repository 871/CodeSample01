<!-- Mains/login -->
<?php 
$ctlHelper	= $this->Main;

if (! $ctlHelper	instanceof MainHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

// ログインフォーム
$formStart	= $ctlHelper->getFormStart();
$inputUserMail	= $ctlHelper->getInputUserMail();
$inputPassword	= $ctlHelper->getInputPassword();
$submitLogin	= $ctlHelper->getSubmitLogin();
$formEnd	= $ctlHelper->getFormEnd();

?>
<h2 class="title">ログイン</h2>
<?php echo $formStart; ?> 
	<table>
		<tr>
			<th>E-Mail</th>
			<td><?php echo $inputUserMail; ?></td>
		</tr>
		<tr>
			<th>パスワード</th>
			<td><?php echo $inputPassword; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $submitLogin; ?></td>
		</tr>
	</table>
<?php echo $formEnd; ?>