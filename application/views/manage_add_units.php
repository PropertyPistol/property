<div id="body">
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
    <p>Select a Project: 
    <?php echo form_input(array('name'=>'project', 'id'=>'project', 'autocomplete'=>'off' , 'size'=>'70'),set_value('project')); ?></p>
    <div id="serv_resp"></div>
    <?php echo form_close(); ?>
</div>
    <script type="text/javascript">
        $("div.header").html("<h1>Add a Unit</h1>");
    </script>
    <script type="text/javascript">
        $(document).ready(function(){   
            var base_url = "<?php echo base_url();?>"
            $("#project").keyup(function()
            {
            var variable = $("#project").val()       
             $.ajax({
                 type: "POST",
                 url: base_url + "index.php/manage/search_project", 
                 data: {project: variable},
                 dataType: "text",
                 success: 
                      function(data){
                        $('#serv_resp').html(data); //as a debugging message.
                      }
                  });// you have missed this bracket
         });
         });
    </script>
