
	
	<div id="body">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)){echo $error; }?>

		<?php echo form_open(); ?>
		<p>Username:
		<?php echo form_input('username', set_value('username')); ?>
		</p>
		<p>Password:
		<?php echo form_password('password'); ?>
		</p>
		<?php echo form_submit('submit', 'Login') ?>
		<?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Login to PropertyPistol</h1>");
	</script>