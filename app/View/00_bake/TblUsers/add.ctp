<div class="tblUsers form">
<?php echo $this->Form->create('TblUser'); ?>
	<fieldset>
		<legend><?php echo __('Add Tbl User'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Tbl Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
