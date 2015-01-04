<!-- Mains/index -->
<?php 
$ctlHelper	= $this->Main;

if (!$ctlHelper instanceof MainHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$linkMemberCreate	= $ctlHelper->getLinkMemberCreate	();
$linkMemberSearch	= $ctlHelper->getLinkMemberSearch	();
$linkGroupList		= $ctlHelper->getLinkGroupList		();
$linkAccountCreate	= $ctlHelper->getLinkAccountCreate	();
$linkAccountList	= $ctlHelper->getLinkAccountList	();
$linkLogout			= $ctlHelper->getLinkLogout			();

?>
<div class="index">
<h2 class="title">管理者メニュー</h2>
<table>
	<tr>
		<th><?php echo $linkMemberCreate; ?></th>
		<td>名簿への登録</td>
	</tr>
	<tr>
		<th><?php echo $linkMemberSearch; ?></th>
		<td>名簿を検索</td>
	</tr>
	<tr>
		<th><?php echo $linkGroupList; ?></th>
		<td>グループ情報の管理</td>
	</tr>
	<tr>
		<th><?php echo $linkAccountCreate; ?></th>
		<td>管理者アカウントを作成</td>
	</tr>
	<tr>
		<th><?php echo $linkAccountList; ?></th>
		<td>管理者アカウントの一覧</td>
	</tr>
	<tr>
		<th><?php echo $linkLogout; ?></th>
		<td>システムからログアウト</td>
	</tr>
</table>
</div>
