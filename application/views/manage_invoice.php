	<div id="body">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)){echo $error; }?>
        <h1>1. Add Invoice Data</h1>
		<?php echo form_open(); ?>
		<p>Invoice Number:
      <?php $options1 = array(
                              '1' => '1',
                              '2' => '2',
                              '3' => '3',
                              ); 
      ?>

		<?php echo form_dropdown('invoice_no', $options1); ?></p>
    <p>Invoice Serial:
    <?php echo form_input(array('name'=>'invoice_serial[]', 'size'=>'5'), 'PPRPL'); ?>-<?php echo form_input(array('name'=>'invoice_serial[]', 'size'=>'8')); ?>-<?php echo form_input(array('name'=>'invoice_serial[]', 'size'=>'3')); ?></p>
        <p>Invoice Amount:
        <?php echo form_input(array('name'=>'invoice_amount', 'id'=>'invoice'), set_value('invoice_amount')); ?></p>

        <p>Invoice Date:
        <?php
        echo form_input(array('name'=>'invoice_month', 'class'=>'datepicker')); 
        ?></p>
        <h1>2. Enter Booking Ids</h1><sub><b>Help: </b>Select the unit number and the booking id will automatically be entered.</sub>
        <h3><a href="#" id="addScnt">Add Another Value</a></h3>
        <h3><a href="#" id="remScnt">Remove Input Box</a></h3>

        <div id="p_scents">
          <p id="hahaha">
            <?php            
                echo form_input(array('name'=>'booking_id[]', 'class'=>'booking', 'class'=>'options', 'placeholder'=>'Unit-No', 'size'=>'20'),set_value('booking_id')).' '.form_input(array('name'=>'percent[]', 'class'=>'percent', 'placeholder'=>'Percent', 'size'=>'20'),set_value('percent'));
            ?>
          </p>
        </div>
        <div id="serv_resp"></div>
        <?php echo form_submit('submit', 'Submit Data'); ?>
        
		<?php echo form_close(); ?>
        <h1>3. Invoice Already added:</h1>
        <?php if($invoices){ ?>
        <table border="1px">
            <tr>
                <th>Invoice Serial</th>
                <th>Invoice No.</th>
                <th>Invoice Value</th>
                <th>Invoice Month</th>
                <th>Booking Id</th>
                <th>Percent</th>
                <th>Collection</th>
            </tr>
                <?php foreach ($invoices as $invoice) {
                echo "<tr><td>$invoice->invoice_serial</td><td>$invoice->invoice_no</td><td>$invoice->invoice_amount</td><td>$invoice->invoice_month</td><td>".anchor("booking/index/$invoice->booking_id", $invoice->booking_id)."</td><td>$invoice->percent</td>";
                ?>
                <td>
                <?php
                if(!$invoice->collected){
                 echo anchor("manage/collection_done/$invoice->invoice_no", 'Collection Done', array('onClick'=>"return confirmation();"));
                }else{
                  echo "Collected";
                }
                ?>

                <?php
                "</td></tr>";
                                                  } 
                ?>
        </table>
        <?php }else{ ?>
        <?php echo "You have Not Entered Any Data";} ?>
	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Manage Invoice</h1>");

	</script>
  <script type="text/javascript">
        $("div.header").html("<h1>Make a Booking</h1>");
        $(function() {
                var scntDiv = $("#p_scents p");
                var pscent = $("#p_scents");
                var i = $('#p_scents p').size() + 1;
                
                $('#addScnt').on('click', function(e) {
                        console.log(e.target);
                        scntDiv.clone().appendTo(pscent);
                        //console.log(scntDiv);//$('#p_scents').clone().appendTo(scntDiv);
                        i++;
                        $(function() {
                           var availableTags = [
                                 <?php foreach ($all_units as $key => $value) {
                                   echo '{';
                                   echo 'label: '.json_encode($value['unit_no'].' in '.$value['project']).", ";
                                   echo 'value: '.json_encode($value['id']);
                                   echo '},';
                                 } 
                                 ?>
                            ];
                            
                            $( ".options" ).autocomplete({
                              source: availableTags
                            });
                        });
                        return false;
                });
                
                $('#remScnt').on('click', function() { 
                        if( i > 2 ) {
                                $('#p_scents p:last').remove();
                                i--;
                        }
                        return false;
                });
                /*
                $("#p_scents").on('keyup', 'input.booking', function(e){
                  var a = String(event.target.value || "");
                  var base_url = "<?php echo base_url();?>";
                  $.ajax({
                       type: "POST",
                       url: base_url + "index.php/manage/search_unit", 
                       data: {unit: a},
                       dataType: "text",
                       success: 
                            function(data){
                              $('#serv_resp').html(data); //as a debugging message.
                            }
                  });
                });*/
        });
          function confirmation() {
              return confirm("Are you sure?")
          }
    </script>
<script>
$(function() {
    var availableTags = [
        <?php foreach ($all_units as $key => $value) {
            echo '{';
                echo 'label: '.json_encode($value['unit_no'].' in '.$value['project']).", ";
                echo 'value: '.json_encode($value['id']);
            echo '},';
        } 
        ?>
    ];

    $( ".options" ).autocomplete({
        source: availableTags
    });
});
</script>
