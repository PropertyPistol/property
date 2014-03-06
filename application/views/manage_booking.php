<div id="body">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p><h2>1. Enter Unit Type</h2>
	<?php echo form_input(array('name'=>'unit', 'id'=>'unit', 'size'=>'20', 'placeholder'=>'Enter Value', 'autocomplete'=>'off'),set_value('project')); ?></p>
  <h2>2. Select the Project</h2>
  <div id="serv_resp"></div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
	$("div.header").html("<h1>Make a Booking</h1>");
	$(document).ready(function(){   
            var base_url = "<?php echo base_url();?>"
            $("#unit").keyup(function()
            {
            var variable = $("#unit").val()       
             $.ajax({
                 type: "POST",
                 url: base_url + "index.php/manage/search_unit", 
                 data: {unit: variable},
                 dataType: "text",
                 success: 
                      function(data){
                        $('#serv_resp').html(data); //as a debugging message.
                      }
                  });// you have missed this bracket
			});
	});
</script>