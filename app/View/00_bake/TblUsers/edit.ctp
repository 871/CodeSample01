<div class="tblUsers form">
<?php echo $this->Form->create('TblUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tbl User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_name');
		echo $this->Form->input('user_mail');
		echo $this->Form->input('password');
		echo $this->Form->input('user_password');
		echo $this->Form->input('create_ip');
		echo $this->Form->input('update_ip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TblUser.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TblUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tbl Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
