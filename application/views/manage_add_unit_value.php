<div id="body" style="text-align:justify;">
	
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
</div>
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