<div id="body" style="text-align:justify;">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p><h2>1. Enter Unit Type: </h2>
	<?php echo form_input(array('name'=>'type','placeholder'=>'Enter Type in BHK' ,'size'=>'20'),set_value('type')); ?></p>

	<p><h2>2. Enter Unit Size options: </h2>
	<?php echo form_input(array('name'=>'size','placeholder'=>'Area in Square Feet', 'size'=>'20'),set_value('size')); ?><sub>Square Feet</sub>
	<?php
		$data = array(
		    'name' => 'button',
		    'id' => 'button',
		    'value' => 'true',
		    'type' => 'reset',
		    'content' => 'Add Options'
		);

		echo form_button($data);

	?></p>
	<?php echo form_submit('submit', 'Submit'); ?>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
		$("div.header").html("<h1>Add a Unit</h1>");
	</script>