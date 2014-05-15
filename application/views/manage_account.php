<div id="body">
	<?php echo validation_errors(); ?>
  <?php echo $this->session->flashdata('error'); ?>
  <?php echo $this->session->flashdata('success'); ?>
	<?php echo form_open(); ?>
	<p><h2>Enter Old password</h2>
	<?php echo form_password(array('name'=>'old_password', 'size'=>'20', 'placeholder'=>'Enter Old Password', 'autocomplete'=>'off'),set_value('old_password')); ?></p>
  <p><h2>Enter New password</h2>
  <?php echo form_password(array('name'=>'new_password', 'size'=>'20', 'placeholder'=>'Enter New Password', 'autocomplete'=>'off'),set_value('new_password')); ?></p>
  <p><h2>Confirm New password</h2>
  <?php echo form_password(array('name'=>'conf_new_password', 'size'=>'20', 'placeholder'=>'Confirm New Password', 'autocomplete'=>'off'),set_value('conf_new_password')); ?></p>
  <?php echo form_submit('submit', 'Reset Your Password'); ?>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
	$("div.header").html("<h1>Manage your account</h1>");
</script>