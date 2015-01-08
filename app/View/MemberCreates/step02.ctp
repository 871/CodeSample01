<!-- MemberCreates/step02 -->
<?php 
$ctlHelper	= $this->MemberCreate;

if (!$ctlHelper instanceof MemberCreateHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
// フォーム
$formStart				= $ctlHelper->getFormStart(array('action' => 'step02'));
$inputMemberMail		= $ctlHelper->getInputMemberMail();
$inputsSubMail			= $ctlHelper->getInputsSubMail	();
$submitBack				= $ctlHelper->getSubmitBack		('step01');
$submitNext				= $ctlHelper->getSubmitNext		();
$formEnd				= $ctlHelper->getFormEnd();
// リンク
$linkMailAdd			= $ctlHelper->getLinkMailAdd		();	// JSイベント用
$linkMemberSearch		= $ctlHelper->getLinkMemberSearch	();
$divNaviLinks			= $ctlHelper->getDivNaviLinks		();
// テキスト
$titlesSubMail			= $ctlHelper->getTitlesSubMail();

?>
<div class="form">
	<h2>新規メンバー登録</h2>
	<?php echo $divNaviLinks; ?>
	<?php echo $formStart; ?>
	<table cellpadding="0" cellspacing="0">
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
			<td></td>
			<td>
				<?php echo $submitNext; ?>
				<?php echo $submitBack; ?>
			</td>
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
		<li><?php echo $linkMemberSearch; ?></li>
	</ul>
</div>
