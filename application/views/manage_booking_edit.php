<div id="body">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p>Enter Project Name: 
	<?php echo form_input('project',set_value('project'), array('size'=>'70')); ?></p>
	<p>Enter Builder: 
	<?php echo form_input('builder',set_value('builder'), array('size'=>'70')); ?></p>
	<?php echo form_submit('submit', 'Submit'); ?>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
		$("div.header").html("<h1>Add a Project</h1>");
	</script>