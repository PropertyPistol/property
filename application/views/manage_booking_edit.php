<div id="body">
	<?php echo $booking_id; ?>
	<?php echo validation_errors(); ?>
	<h2>Select an action</h2>	
	<?php echo anchor("manage/add_invoice/$booking_id", 'Add Invoice'); ?>
	<?php echo anchor("manage/add_collection/$booking_id", 'Add Collection'); ?>
	<?php ?>
	<?php //echo form_close(); ?>
</div>
<script type="text/javascript">
		$("div.header").html("<h1>Edit a Project</h1>");
	</script>