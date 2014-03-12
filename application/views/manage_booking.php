<div id="body">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p><h2>1. Enter Project</h2>
	<?php echo form_input(array('name'=>'project', 'id'=>'project', 'size'=>'20', 'placeholder'=>'Enter Project', 'autocomplete'=>'off'),set_value('project')); ?></p>
  <div id="serv_resp"></div>
  <h2>2. Select the Type</h2>
  <div id="serv_resp1"></div>
  <?php echo form_submit('submit', 'Fill Details'); ?>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
	$("div.header").html("<h1>Make a Booking</h1>");
</script>
<script type="text/javascript">
        $(document).ready(function(){   
            var base_url = "<?php echo base_url();?>"
            $("#project").keyup(function()
            {
            var variable = $("#project").val()       
             $.ajax({
                 type: "POST",
                 url: base_url + "index.php/manage/project_booking_search", 
                 data: {project: variable},
                 dataType: "text",
                 success: 
                      function(data){
                        $('#serv_resp').html(data); //as a debugging message.
                      }
                  });// you have missed this bracket
         });
            $("select[name='type']").on('change', function(e){
              console.log(e.target);
            });

         });
        function init(project_id){
          //console.log(project_name);
          $("input#project").val(project_id);
          var project = project_id;
          var base_url = "<?php echo base_url();?>"
          $.ajax({
            type: "POST",
            url: base_url + "index.php/manage/search_types",
            data: {project: project},
            dataType: "text",
            success: 
                      function(data){
                        $('#serv_resp1').html(data); //as a debugging message.
                      }
          });
        }
    </script>