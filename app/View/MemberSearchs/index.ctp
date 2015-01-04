<!-- MemberSearchs/index -->
<?php 
$ctlHelper	= $this->MemberSearch;

if (!isset($dataPaginate))						throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
if (!$ctlHelper instanceof MemberSearchHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$ctlHelper->setDataPaginate($dataPaginate);
// ソート用リンク
$paginatorSortId				= $ctlHelper->getPaginatorSortId			();
$paginatorSortMemberName		= $ctlHelper->getPaginatorSortMemberName	();
$paginatorSortMemberMail		= $ctlHelper->getPaginatorSortMemberMail	();
$paginatorSortMemberBirthday	= $ctlHelper->getPaginatorSortMemberBirthday();
$paginatorSortMstSexId			= $ctlHelper->getPaginatorSortMstSexId		();
$paginatorSortTblGroupCount		= $ctlHelper->getPaginatorSortTblGroupCount	();
$paginatorSortCreated			= $ctlHelper->getPaginatorSortCreated		();
$paginatorSortUpdated			= $ctlHelper->getPaginatorSortUpdated		();
// カウンタテキスト
$paginatorCounter		= $ctlHelper->getPaginatorCounter		();
// ページ遷移リンク
$paginatorLinks			= $ctlHelper->getPaginatorLinks			();
// リンク
$linkMemberCreate		= $ctlHelper->getLinkAccountMemberCreate();
?>
<div class="index">
	<h2>メンバ検索</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>
				<?php echo $paginatorSortId;		?>
			</th>
			<th>
				<?php echo $paginatorSortMemberName;	?>
				<?php echo $paginatorSortMemberMail;	?>
			</th>
			<th>
				<?php echo $paginatorSortMstSexId;	?>
				<?php echo $paginatorSortMemberBirthday;	?>
			</th>
			<th>
				<?php echo $paginatorSortTblGroupCount;	?>
			</th>
			<th>
				<?php echo $paginatorSortCreated;	?>
				<?php echo $paginatorSortUpdated;	?>
			</th>
			<th class="actions">操作</th>
		</tr>
		<?php for ($i = 0, $cnt = $ctlHelper->getDataPaginateCount(); $i < $cnt; ++$i) { 
			// テキスト
			$textId				= $ctlHelper->getTextId				($i);
			$textMemberName		= $ctlHelper->getTextMemberName		($i);
			$textMemberMail		= $ctlHelper->getTextMemberMail		($i);
			$textMstSexName		= $ctlHelper->getTextMstSexName		($i);
			$textMemberBirthday	= $ctlHelper->getTextMemberBirthday	($i);
			$textMemberAge		= $ctlHelper->getTextMemberAge		($i);
			$textTblGroupCount	= $ctlHelper->getTextTblGroupCount	($i);
			$textCreated		= $ctlHelper->getTextCreated		($i);
			$textUpdated		= $ctlHelper->getTextUpdated		($i);
			// リンク
			$linkMemberDetail	= $ctlHelper->getLinkMemberDetail	($i);
			$linkMemberEdit		= $ctlHelper->getLinkMemberEdit		($i);
			$linkMemberDelete	= $ctlHelper->getLinkMemberDelete	($i);
		?>
		<tr>
			<td>
				<?php echo $textId;			?>
			</td>
			<td>
				<?php echo $textMemberName;	?><br />
				<?php echo $textMemberMail;	?>
			</td>
			<td>
				<?php echo $textMstSexName;	?><br />
				<?php echo $textMemberBirthday;	?>
				<span class="age">(<?php echo $textMemberAge; ?>)</span>
			</td>
			<td>
				<?php echo $textTblGroupCount;	?>
			</td>
			<td>
				<?php echo $textCreated;	?><br />
				<?php echo $textUpdated;	?>
			</td>
			<td class="actions">
				<?php echo $linkMemberDetail;	?>
				<?php echo $linkMemberEdit;		?>
				<?php echo $linkMemberDelete;	?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<p><?php echo $paginatorCounter; ?></p>
	<div class="paging"><?php echo $paginatorLinks; ?></div>
</div>
<script>(function($){
	var el = 'div.index';
	if ($(el).height() < 1000) {
		$(el).height(1000);
	}
})(jQuery);</script>
<?php
// 検索フォーム
$formStart				= $ctlHelper->getFormStart				();
$inputTblGroupId		= $ctlHelper->getInputTblGroupId		();
$inputMemberName		= $ctlHelper->getInputMemberName		(); 
$inputMemberMail		= $ctlHelper->getInputMemberMail		();
$inputMemberAgeMin		= $ctlHelper->getInputMemberAgeMin		();
$inputMemberAgeMax		= $ctlHelper->getInputMemberAgeMax		();
$inputMemberBirthdayMin	= $ctlHelper->getInputMemberBirthdayMin	();
$inputMemberBirthdayMax	= $ctlHelper->getInputMemberBirthdayMax	();
$inputTblGroupCountMin	= $ctlHelper->getInputTblGroupCountMin	();
$inputTblGroupCountMax	= $ctlHelper->getInputTblGroupCountMax	();
$submitSearch			= $ctlHelper->getSubmitSearch			();
$formEnd				= $ctlHelper->getFormEnd				();

?>
<div class="actions">
	<h3>検索</h3>
	<?php echo $formStart; ?>
	<dl>
		<dt>所属グループ</dt>
		<dd><?php echo $inputTblGroupId; ?></dd>
		<dt>メンバ名</dt>
		<dd><?php echo $inputMemberName; ?></dd>
		<dt>メールアドレス</dt>
		<dd><?php echo $inputMemberMail; ?></dd>
		<dt>年齢（下限-上限）</dt>
		<dd>
			<?php echo $inputMemberAgeMin; ?>-<?php echo $inputMemberAgeMax; ?>
		</dd>
		<dt>生年月日<br />（年-月-日）<br />（下限-上限）</dt>
		<dd>
			<?php echo $inputMemberBirthdayMin; ?>-<?php echo $inputMemberBirthdayMax; ?>
		</dd>
		<dt>所属グループ数<br />（下限-上限）</dt>
		<dd>
			<?php echo $inputTblGroupCountMin; ?>-<?php echo $inputTblGroupCountMax; ?>
		</dd>
	</dl>
	<?php echo $submitSearch; ?>
	<?php echo $formEnd; ?>
</div>
<script>(function($){
	var elDate = '.inputDate';
	$(elDate).datepicker();
	$(elDate).val(function(i, v){
		return v? v: '----/--/--';
	});	
})(jQuery)</script>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $linkMemberCreate; ?></li>
	</ul>
</div>