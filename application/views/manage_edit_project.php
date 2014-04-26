<div id="body">
	<?php if($this->session->flashdata('unit_deletion')){echo $this->session->flashdata('unit_deletion');} ?>
	<?php $s =  sizeof($project_details); ?>
	<?php $project_id =  $project_details[0]->id; ?>
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p>Project Name: 
	<?php echo form_input(array('name'=>'project', 'size'=>'70'),$project_details[0]->project); ?></p>
	<p>Enter Builder: 
	<?php echo form_input(array('name'=>'builder', 'size'=>'70'),$project_details[0]->builder); ?></p>
	<p>Enter Brokerage: 
	<?php echo form_input(array('name'=>'brokerage', 'size'=>'10'),$project_details[0]->brokerage); ?><sub>%</sub></p>

	
	<p><h2>1. Enter Unit Type: </h2>
	<?php echo form_input(array('name'=>'type','placeholder'=>'Enter Type in BHK' ,'size'=>'20'),set_value('type')); ?></p>

	<p><h2>2. Enter Unit Size options: </h2>
		<h3><a href="#" id="addScnt">Add Another Value</a></h3>
		<h3><a href="#" id="remScnt">Remove Input Box</a></h3>

		<div id="p_scents">
		    <p>
		        <label for="p_scnts"><input type="text" id="p_scnt" size="20" name="size[]" value="" placeholder="Input Value" /></label>
		    </p>
		</div>

	</p>
	<?php echo form_submit('submit', 'Submit'); ?>
	<?php echo form_close(); ?>

	<p><h2>3. Unit Options Already added: </h2>
		<table>
			<tr>
				<td>Unit Type
				</td>
				<td>Area Option id
				</td>
				<td>Area Option
				</td>
				<td>Delete
				</td>
			</tr>
			<?php
			foreach ($project_details as $key => $value) {
			?>
			<?php $uid = $project_details[$key]->uid; ?>
				<tr>
					<td>
						<?php echo $project_details[$key]->unit_type; ?>
					</td>
					<td>
						<?php echo $project_details[$key]->option_id; ?>
					</td>
					<td>
						<?php echo $project_details[$key]->option; ?>
					</td>
					<td>
						<?php echo anchor("manage/delete_unit_value/$project_id/$uid", 'Delete this entry', array('onClick'=>"return confirmation();")); ?>
					</td>

				</tr>
			<?php	
			}

			?>
		</table>


	</p>
</div>




<script type="text/javascript">
	$("div.header").html("<h1>Edit a Project</h1>");
</script>

<script type="text/javascript">
$("div.header").html("<h1>Add a Unit</h1>");
$(function() {
	var scntDiv = $('#p_scents');
	var i = $('#p_scents p').size() + 1;

	$('#addScnt').on('click', function() {
		$('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="size[]" value="" placeholder="Input Value" /></label> </p>').appendTo(scntDiv);
		i++;
		return false;
	});

	$('#remScnt').on('click', function() { 
		if( i > 2 ) {
			$('#p_scents p:last').remove();
			i--;
		}
		return false;
	});
});
</script>

<script>
	function confirmation() {
		return confirm("Are you sure?")
	}
</script>