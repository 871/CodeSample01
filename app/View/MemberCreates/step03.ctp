<!-- MemberCreates/step03 -->
<?php 
$ctlHelper	= $this->MemberCreate;

if (!$ctlHelper instanceof MemberCreateHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
// フォーム
$formStart			= $ctlHelper->getFormStart(array('action' => 'step03'));
$inputTblGroup		= $ctlHelper->getInputTblGroup	();
$submitBack			= $ctlHelper->getSubmitBack		('step02');
$submitConf			= $ctlHelper->getSubmitConf		();
$formEnd			= $ctlHelper->getFormEnd();
// リンク
$linkMemberSearch	= $ctlHelper->getLinkMemberSearch();
$divNaviLinks		= $ctlHelper->getDivNaviLinks		();
?>
<div class="form">
	<h2>新規メンバー登録</h2>
	<?php echo $divNaviLinks; ?>
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>グループ</th>
			<td><?php echo $inputTblGroup; ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo $submitConf; ?>
				<?php echo $submitBack; ?>
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
