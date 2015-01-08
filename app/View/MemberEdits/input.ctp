<!-- MemberSearchs/step01 -->
<?php 
$ctlHelper	= $this->MemberEdit;

if (!$ctlHelper instanceof MemberEditHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
// フォーム
$formStart				= $ctlHelper->getFormStart(array('action' => 'input'));
$valueMemberId			= $ctlHelper->getValueMemberId		();
$valueMemberName		= $ctlHelper->getValueMemberName	();
$inputMemberName		= $ctlHelper->getInputMemberName	();
$inputMemberBirthday	= $ctlHelper->getInputMemberBirthday();
$inputMstSexId			= $ctlHelper->getInputMstSexId		();
$inputRemarks			= $ctlHelper->getInputRemarks		();
$inputMemberMail		= $ctlHelper->getInputMemberMail	();
$inputsSubMail			= $ctlHelper->getInputsSubMail		();
$inputTblGroup			= $ctlHelper->getInputTblGroup		();
$submitConf				= $ctlHelper->getSubmitConf			();
$formEnd				= $ctlHelper->getFormEnd();
// リンク
$ctlHelper->setTblMemberId($valueMemberId);
$ctlHelper->setTblMemberName($valueMemberName);
$linkMailAdd			= $ctlHelper->getLinkMailAdd		();	// JSイベント用
$linkMemberCreate		= $ctlHelper->getLinkMemberCreate	();
$linkMemberSearch		= $ctlHelper->getLinkMemberSearch	();
$linkMemberDetail		= $ctlHelper->getLinkMemberDetail	();
$linkMemberDelete		= $ctlHelper->getLinkMemberDelete	();
// テキスト
$titlesSubMail			= $ctlHelper->getTitlesSubMail();

?>
<div class="form">
	<h2>新規メンバー登録</h2>
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>メンバーID</th>
			<td><?php echo $valueMemberId; ?></td>
		</tr>
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
			<th>メールアドレス1</th>
			<td>
				<?php echo $inputMemberMail;	?>
				<?php echo $linkMailAdd;		?>
			</td>
		</tr>
		<?php for ($i = 0, $cnt = count($inputsSubMail); $i < $cnt; ++$i) { ?>
		<tr class="sysSubMail">
			<th><?php echo $titlesSubMail[$i]; ?></th>
			<td><?php echo $inputsSubMail[$i]; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>グループ</th>
			<td><?php echo $inputTblGroup; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $submitConf; ?></td>
		</tr>
	</table>
	<?php echo $formEnd; ?>
	<script>(function($){
		var elRowAdd		= '.sysRowAdd';
		var elSubMailRow	= 'tr.sysSubMail';
		var subMailRows = $(elSubMailRow);
		for (var i = subMailRows.length - 1; i >= 0; --i) {
			var el = subMailRows[i];
			if ($(el).find('input').val()) {
				break;
			}
			$(el).hide();
				
		}
		
		$(elRowAdd).click(function(){
			for (var i = 0; i < subMailRows.length; ++i) {
				var el = subMailRows[i];
				if ($(el).is(':hidden')) {
					$(el).show();
					break;
				}
			}
		});
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
