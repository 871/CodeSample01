<!-- UserLists/index -->
<?php 
$ctlHelper	= $this->UserList;

if (!isset($dataPaginate))					throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
if (!$ctlHelper instanceof UserListHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$ctlHelper->setDataPaginate($dataPaginate);
// ソート用リンク
$paginatorSortId		= $ctlHelper->getPaginatorSortId		();
$paginatorSortLoginFlag	= $ctlHelper->getPaginatorSortLoginFlag	();
$paginatorSortUserName	= $ctlHelper->getPaginatorSortUserName	();
$paginatorSortUserMail	= $ctlHelper->getPaginatorSortUserMail	();
$paginatorSortCreateIp	= $ctlHelper->getPaginatorSortCreateIp	();
$paginatorSortUpdateIp	= $ctlHelper->getPaginatorSortUpdateIp	();
$paginatorSortCreated	= $ctlHelper->getPaginatorSortCreated	();
$paginatorSortUpdated	= $ctlHelper->getPaginatorSortUpdated	();
// カウンタテキスト
$paginatorCounter		= $ctlHelper->getPaginatorCounter		();
// ページ遷移リンク
$paginatorLinks			= $ctlHelper->getPaginatorLinks			();
// リンク
$linkAccountCreate		= $ctlHelper->getLinkAccountCreate		();

?>
<div class="index">
	<h2>管理者アカウント情報</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>
				<?php echo $paginatorSortId;		?>
			</th>
			<th>
				<?php echo $paginatorSortLoginFlag;	?>
			</th>
			<th>
				<?php echo $paginatorSortUserName;	?>
				<?php echo $paginatorSortUserMail;	?>
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
			// テキスト
			$textId				= $ctlHelper->getTextId				($i);
			$textLoginFlag		= $ctlHelper->getTextLoginFlag		($i);
			$textUserName		= $ctlHelper->getTextUserName		($i);
			$textUserMail		= $ctlHelper->getTextUserMail		($i);
			$textCreateIp		= $ctlHelper->getTextCreateIp		($i);
			$textUpdateIp		= $ctlHelper->getTextUpdateIp		($i);
			$textCreated		= $ctlHelper->getTextCreated		($i);
			$textUpdated		= $ctlHelper->getTextUpdated		($i);
			// リンク
			$linkAccountEdit	= $ctlHelper->getLinkAccountEdit	($i);
			$linkAccountDelete	= $ctlHelper->getLinkAccountDelete	($i);
		?>
		<tr>
			<td>
				<?php echo $textId;			?>
			</td>
			<td>
				<?php echo $textLoginFlag;	?>
			</td>
			<td>
				<?php echo $textUserName;	?><br />
				<?php echo $textUserMail;	?>
			</td>
			<td>
				<?php echo $textCreateIp;	?><br />
				<?php echo $textUpdateIp;	?>
			</td>
			<td>
				<?php echo $textCreated;	?><br />
				<?php echo $textUpdated;	?>
			</td>
			<td class="actions">
				<?php echo $linkAccountEdit;	?>
				<?php echo $linkAccountDelete;	?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<p><?php echo $paginatorCounter; ?></p>
	<div class="paging"><?php echo $paginatorLinks; ?></div>
</div>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $linkAccountCreate; ?></li>
	</ul>
</div>