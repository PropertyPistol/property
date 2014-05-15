<div id="body">
	<br/><br/>
	<?php echo $this->session->flashdata('no_data'); ?>
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<select name="year[]" multiple="multiple" size="10">
		<option value="2013">2013</option>
		<option value="2014">2014</option>
		<option value="2015">2015</option>
	</select>
	<select name="month[]" multiple="multiple" size="10">
		<option value="1">January</option>
		<option value="2">February</option>
		<option value="3">March</option>
		<option value="4">April</option>
		<option value="5">May</option>
		<option value="6">June</option>
		<option value="7">July</option>
		<option value="8">August</option>
		<option value="9">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
	</select>
	<select name="exec_id[]" multiple="multiple" size="10">
	<?php 
		foreach ($executives as $executive) {
		?>
			<option value="<?php echo $executive->id; ?>"><?php echo $executive->firstname; ?></option>
		<?php
		}
	?>
	</select>
	<?php echo form_submit('submit', "Submit") ?>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
$("div.header").html("<h2>See Reporting</h2>");
</script>