<div class="tblUsers view">
<h2><?php echo __('Tbl User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Name'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['user_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Mail'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['user_mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Password'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['user_password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create Ip'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['create_ip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update Ip'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['update_ip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($tblUser['TblUser']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tbl User'), array('action' => 'edit', $tblUser['TblUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tbl User'), array('action' => 'delete', $tblUser['TblUser']['id']), null, __('Are you sure you want to delete # %s?', $tblUser['TblUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tbl Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tbl User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
