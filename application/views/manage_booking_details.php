
	
	<div id="body">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)){echo $error; }?>

		<?php echo form_open(); ?>
		<p>Unit Number:
		<?php echo form_input(array('name'=>'unit', 'id'=>'unit'), set_value('unit')); ?>
		<div id="serv_resp"></div>
		<?php echo form_close(); ?>

	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Add Booking Details</h1>");

	</script>
	 <script type="text/javascript">
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