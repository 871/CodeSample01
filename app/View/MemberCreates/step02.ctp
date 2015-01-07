<!-- MemberCreates/step02 -->
<?php 
$ctlHelper	= $this->MemberCreate;

if (!$ctlHelper instanceof MemberCreateHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
// フォーム
$formStart				= $ctlHelper->getFormStart(array('action' => 'step02'));
$inputMemberMail		= $ctlHelper->getInputMemberMail();
$inputSubMails			= $ctlHelper->getInputSubMails	();
$submitBack				= $ctlHelper->getSubmitBack		('step01');
$submitNext				= $ctlHelper->getSubmitNext		();
$formEnd				= $ctlHelper->getFormEnd();
// リンク
$linkMailAdd			= $ctlHelper->getLinkMailAdd();	// JSイベント用
$linkMemberSearch		= $ctlHelper->getLinkMemberSearch();
// テキスト
$titleSubMails			= $ctlHelper->getTitleSubMails();

?>
<div class="form">
	<h2>新規メンバー登録</h2>
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>メールアドレス1</th>
			<td>
				<?php echo $inputMemberMail;	?>
				<?php echo $linkMailAdd;		?>
			</td>
		</tr>
		<?php for ($i = 0, $cnt = count($inputSubMails); $i < $cnt; ++$i) { ?>
		<tr class="sysSubMail">
			<th><?php echo $titleSubMails[$i]; ?></th>
			<td><?php echo $inputSubMails[$i]; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td></td>
			<td>
				<?php echo $submitBack; ?>
				<?php echo $submitNext; ?>
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
