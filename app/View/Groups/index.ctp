<!-- Groups/index -->
<?php 
$ctlHelper	= $this->Group;

if (!isset($dataPaginate))				throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
if (!$ctlHelper instanceof GroupHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$ctlHelper->setDataPaginate($dataPaginate);
// ソート用リンク
$paginatorSortId				= $ctlHelper->getPaginatorSortId				();
$paginatorSortTblMemberCount	= $ctlHelper->getPaginatorSortTblMemberCount	();
$paginatorSortGroupName			= $ctlHelper->getPaginatorSortGroupName			();
$paginatorSortCreateIp			= $ctlHelper->getPaginatorSortCreateIp			();
$paginatorSortUpdateIp			= $ctlHelper->getPaginatorSortUpdateIp			();
$paginatorSortCreated			= $ctlHelper->getPaginatorSortCreated			();
$paginatorSortUpdated			= $ctlHelper->getPaginatorSortUpdated			();
// カウンタテキスト
$paginatorCounter		= $ctlHelper->getPaginatorCounter		();
// ページ遷移リンク
$paginatorLinks			= $ctlHelper->getPaginatorLinks			();

// フォーム
$formStart			= $ctlHelper->getFormStart		();
$inputGroupName		= $ctlHelper->getInputGroupName	();
$formEnd			= $ctlHelper->getFormEnd		();
$linkGroupSave		= $ctlHelper->getLinkGroupSave	();
			
?>
<div class="index">
	<h2>グループ情報</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>
				グループ作成
			</th>
			<td>
				<?php echo $formStart;		?>
				<?php echo $inputGroupName;	?>
				<?php echo $formEnd;		?>
			</td>
			<td class="actions">
				<?php echo $linkGroupSave;	?>
			</td>
		</tr>
	</table>
			
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>
				<?php echo $paginatorSortId;		?>
			</th>
			<th>
				<?php echo $paginatorSortTblMemberCount;	?>
			</th>
			<th>
				<?php echo $paginatorSortGroupName;	?>
			</th>
			<th>
				<?php echo $paginatorSortCreateIp;	?>
				<?php echo $paginatorSortUpdateIp;	?>
			</th>
			<th>
				<?php echo $paginatorSortCreated;	?>
				<?php echo $paginatorSortUpdated;	?>
			</th>
			<th class="actions">操作</th>
		</tr>
		<?php for ($i = 0, $cnt = $ctlHelper->getDataPaginateCount(); $i < $cnt; ++$i) { 
			// フォーム
			$formStart			= $ctlHelper->getFormStart			($i);
			$inputId			= $ctlHelper->getInputId			($i);
			$inputGroupName		= $ctlHelper->getInputGroupName		($i);
			$formEnd			= $ctlHelper->getFormEnd			($i);
			// テキスト
			$textId				= $ctlHelper->getTextId				($i);
			$textTblMemberCount	= $ctlHelper->getTextTblMemberCount	($i);
			$textCreateIp		= $ctlHelper->getTextCreateIp		($i);
			$textUpdateIp		= $ctlHelper->getTextUpdateIp		($i);
			$textCreated		= $ctlHelper->getTextCreated		($i);
			$textUpdated		= $ctlHelper->getTextUpdated		($i);
			// リンク
			$linkGroupSave		= $ctlHelper->getLinkGroupSave		($i);
			$linkGroupDelete	= $ctlHelper->getLinkGroupDelete	($i);
		?>
		<tr>
			<td>
				<?php echo $textId;			?>
			</td>
			<td>
				<?php echo $textTblMemberCount;	?>
			</td>
			<td>
				<?php echo $formStart;			?>
				<?php echo $inputId;			?>
				<?php echo $inputGroupName;		?>
				<?php echo $formEnd;			?>
			</td>
			<td>
				<?php echo $textCreateIp;		?><br />
				<?php echo $textUpdateIp;		?>
			</td>
			<td>
				<?php echo $textCreated;		?><br />
				<?php echo $textUpdated;		?>
			</td>
			<td class="actions">
				<?php echo $linkGroupSave;		?>
				<?php echo $linkGroupDelete;	?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<script>(function($){
		var ajaxSubmit = {
			getUrl: function(elLink) {
				return $(elLink).attr('href');
			},
			getFormData: function(elForm) {
				var data = {};
				$(elForm).find('input').each(function(i, e){
					var key = $(e).attr('name');
					var val = $(e).val();
					data[key] = val;
				});
				return data;
			},
			callback: function(d, t, x) {
				if (d.result) {
					location.href = '/Groups';
				} else {
					alert(d.errMessages.join('\n'));
				}
			},
			run: function(elForm, elLink) {
				var url			= this.getUrl(elLink);
				var data		= this.getFormData(elForm);
				var callback	= this.callback;
				$.post(url, data, callback, 'json');
				return false;
			}
		};
		$.ajaxSubmit = ajaxSubmit;
	})(jQuery)</script>
	<p><?php echo $paginatorCounter; ?></p>
	<div class="paging"><?php echo $paginatorLinks; ?></div>
</div>