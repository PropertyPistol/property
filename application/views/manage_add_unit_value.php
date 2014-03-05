<div id="body" style="text-align:justify;">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p>Enter Unit Type: 
	<?php echo form_input(array('name'=>'type','placeholder'=>'Enter Type in BHK' ,'size'=>'20'),set_value('type')); ?><sub>BHK</sub></p>
	<p>Enter Unit Number: 
	<?php echo form_input(array('name'=>'unit_no','placeholder'=>'Enter Unit Number', 'size'=>'50'),set_value('unit_no')); ?></p>
	<p>Enter Unit Size: 
	<?php echo form_input(array('name'=>'size','placeholder'=>'Area in Square Feet', 'size'=>'20'),set_value('size')); ?><sub>Square Feet</sub></p>
	<p>Enter Basic Rate: 
	<?php echo form_input(array('name'=>'basic_rate','placeholder'=>'Rate per Square Feet', 'size'=>'20'),set_value('basic_rate')); ?><sub>Rs. Per Square Feet</sub></p>
	<p>Car Parking Available: 
	<?php echo form_checkbox('car_park', '1', FALSE); ?><sub>Yes/No</sub></p>
	<p>Floor Rise Cost: 
	<?php echo form_input(array('name'=>'floor_rise','placeholder'=>'Enter Floor Rise Cost', 'size'=>'20'),set_value('floor_rise')); ?><sub>Rs.</sub></p>
	<p>PLC: 
	<?php echo form_input(array('name'=>'plc','placeholder'=>'Enter PLC', 'size'=>'20'),set_value('plc')); ?><sub>Rs.</sub></p>
	<p>Revenue Rate: 
	<?php echo form_input(array('name'=>'rev_rate','placeholder'=>'Enter Revenue Rate (in %)', 'size'=>'20'),set_value('rev_rate')); ?><sub>%</sub></p>

	<?php echo form_submit('submit', 'Submit'); ?>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
		$("div.header").html("<h1>Add a Unit</h1>");
	</script>