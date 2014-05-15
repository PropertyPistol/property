

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
</div>
<script type="text/javascript">
		$("div.header").html("<h1>Add a Project</h1>");
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