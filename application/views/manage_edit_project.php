<div id="body">
	<?php if($this->session->flashdata('unit_deletion')){echo $this->session->flashdata('unit_deletion');} ?>
	<?php $s =  sizeof($project_details); ?>
	<?php $project_id =  $project_details[0]->id; ?>
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p><h2>Project Name: </h2>
	<?php echo form_input(array('name'=>'project', 'size'=>'70'),$project_details[0]->project); ?></p>
	<p><h2>Enter Builder: </h2>
	<?php echo form_input(array('name'=>'builder', 'size'=>'70'),$project_details[0]->builder); ?></p>
	<p><h2>Enter Brokerage: </h2>
	<?php echo form_input(array('name'=>'brokerage', 'size'=>'10'),$project_details[0]->brokerage); ?><sub>%</sub></p>

	
	<h2>Enter Unit Size options: </h2>

		<table id="mastertable">
			<tr>
				<td>
					<b>Enter Unit Type</b>
				</td>
				<td>
					<b>Enter Unit Value</b>
				</td>
				<td>
					<span stlye="float:left; display:inline;"><a class="mastertableanchor" style="display:block; width:100%; height:100%; text-decoration:none; margin-bottom:5px;" href="#" id="addScnt">Add</a></span>
					<span style="float:left; display:inline;"><a class="mastertableanchor" style="display:block; width:100%; height:100%; text-decoration:none;"href="#" id="remScnt">Remove</a></span>
				</td>
			</tr>
		    <tr id="master_row">
		       <td> 
		        	<?php echo form_input(array('name'=>'type[]','placeholder'=>'Enter Type in BHK' ,'size'=>'20'),set_value('type')); ?>

		        </td>
		        <td> 
		        	<input type="text" id="p_scnt" size="20" name="size[]" placeholder="Input Value in sqft" />
		        </td>
		        <td> 
		        	
		        </td>
		    </tr>
		</table>
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
	<?php echo anchor("manage/delete_project/$project_id", "Delete This Project", array('onClick'=>"return confirmation();")); ?>
</div>




<script type="text/javascript">
		$("div.header").html("<h1>Edit a Project</h1>");
		$(function() {
		        var scntDiv = $('#mastertable');
		        var i = $('#mastertable #master_row').size() + 1;
		        
		        $('#addScnt').on('click', function() {
		                $("#master_row").clone().appendTo(scntDiv);
		                i++;
		                return false;
		        });
		        
		        $('#remScnt').on('click', function() { 
		                if( i > 2 ) {
		                        $('#mastertable #master_row:last').remove();
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