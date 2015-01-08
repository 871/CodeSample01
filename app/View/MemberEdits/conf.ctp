<!-- MemberEdits/conf -->
<?php 
$ctlHelper	= $this->MemberEdit;

if (!$ctlHelper instanceof MemberEditHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
// フォーム
$formStart				= $ctlHelper->getFormStart(array('action' => 'conf'));
$valueMemberId			= $ctlHelper->getValueMemberId		();
$valueMemberName		= $ctlHelper->getValueMemberName	();
$valueMemberBirthday	= $ctlHelper->getValueMemberBirthday();
$valueMstSexId			= $ctlHelper->getValueMstSexId		();
$valueRemarks			= $ctlHelper->getValueRemarks		();
$valueMemberMail		= $ctlHelper->getValueMemberMail	();
$valuesSubMail			= $ctlHelper->getValuesSubMail		();
$valueTblGroup			= $ctlHelper->getValueTblGroup		();
$submitBack				= $ctlHelper->getSubmitBack			('input');
$submitComp				= $ctlHelper->getSubmitComp			();
$formEnd				= $ctlHelper->getFormEnd();
// リンク
$ctlHelper->setTblMemberId($valueMemberId);
$ctlHelper->setTblMemberName($valueMemberName);
$linkMemberCreate		= $ctlHelper->getLinkMemberCreate	();
$linkMemberSearch		= $ctlHelper->getLinkMemberSearch	();
$linkMemberDetail		= $ctlHelper->getLinkMemberDetail	();
$linkMemberDelete		= $ctlHelper->getLinkMemberDelete	();
// テキスト
$titlesSubMail			= $ctlHelper->getTitlesSubMail();

?>
<div class="form">
	<h2>メンバー情報編集</h2>
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>メンバーID</th>
			<td><?php echo $valueMemberId; ?></td>
		</tr>
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
		<?php for ($i = 0, $cnt = count($valuesSubMail); $i < $cnt; ++$i) { ?>
		<tr class="sysSubMail">
			<th><?php echo $titlesSubMail[$i]; ?></th>
			<td><?php echo $valuesSubMail[$i]; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>グループ</th>
			<td><?php echo $valueTblGroup; ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo $submitComp; ?>
				<?php echo $submitBack; ?>
			</td>
		</tr>
	</table>
	<?php echo $formEnd; ?>
	<script>(function($){
		var elSubMailRow	= 'tr.sysSubMail';
		var subMailRows = $(elSubMailRow);
		for (var i = subMailRows.length - 1; i >= 0; --i) {
			var el = subMailRows[i];
			if (!$(el).find('td').text()) {
				$(el).hide();
			}	
		}
	})(jQuery);</script>
</div>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $linkMemberCreate; ?></li>
		<li><?php echo $linkMemberSearch; ?></li>
		<li><?php echo $linkMemberDetail; ?></li>
		<li><?php echo $linkMemberDelete; ?></li>
	</ul>
</div>
