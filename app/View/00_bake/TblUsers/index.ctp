<div class="tblUsers index">
	<h2><?php echo __('Tbl Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_name'); ?></th>
			<th><?php echo $this->Paginator->sort('user_mail'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('user_password'); ?></th>
			<th><?php echo $this->Paginator->sort('create_ip'); ?></th>
			<th><?php echo $this->Paginator->sort('update_ip'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tblUsers as $tblUser): ?>
	<tr>
		<td><?php echo h($tblUser['TblUser']['id']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['user_name']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['user_mail']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['password']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['user_password']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['create_ip']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['update_ip']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['created']); ?>&nbsp;</td>
		<td><?php echo h($tblUser['TblUser']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tblUser['TblUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tblUser['TblUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tblUser['TblUser']['id']), null, __('Are you sure you want to delete # %s?', $tblUser['TblUser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Tbl User'), array('action' => 'add')); ?></li>
	</ul>
</div>
