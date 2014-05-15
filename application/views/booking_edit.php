<?php 
	if($this->session->flashdata('success'))
		{
			echo "<span style='background:yellow;'>Data Entry Successful</span>";
		} 
?>
<?php 
	if($this->session->flashdata('exec_remove'))
		{
			echo "<span style='background:yellow;'>Removed Successful</span>";
		} 
?>
<div id="databox" style="margin-top:20px; margin-left:10px;">
<?php echo form_open('', array('onsubmit'=>"confirmation()")); ?>
	<label><b>Booking Id: </b></label><?php echo $id; ?><br/>
	<label><b>Project: </b></label><?php echo $all_data[0]->project; ?><br/>
	<label><b>Builder: </b></label><?php echo $all_data[0]->builder; ?><br/>
	<h2>Client Details</h2>
	<label><b>Client Name: </b></label><?php echo form_input('client_name', $all_data[0]->name); ?><br/>
	<?php echo form_hidden('client_id', $all_data[0]->client_id); ?>
	<label><b>Client Email: </b></label><?php echo form_input('client_email', $all_data[0]->email); ?><br/>
	<label><b>Client Address: </b></label><?php echo form_input('client_address', $all_data[0]->address).', '.form_input('client_city', $all_data[0]->city); ?><br/>
	<label><b>Client Contact: </b></label><?php echo form_input('client_contact', $all_data[0]->phone); ?><br/>
	<h2>Booking Details</h2>
	<label><b>Change Booking Date: </b></label><?php echo form_input(array('name'=>'booking_date', 'class'=>'datepicker', 'type'=>'text'), $all_data[0]->booking_date); ?></p>
	<label><b>Unit No.: </b></label><?php echo form_input('unit_no', $all_data[0]->unit_no); ?><br/>
	<label><b>Unit Type: </b></label><?php echo $all_data[0]->unit_type; ?><br/>
	<label><b>Size: </b></label><?php echo $all_data[0]->size; ?><br/>
	<label><b>Basic Rate: </b></label><?php echo $all_data[0]->basic_rate; ?><br/>
	<label><b>Revenue: </b></label><?php echo $all_data[0]->revenue; ?><br/>
	<label><b>Cashback: </b></label><?php echo $all_data[0]->cashback; ?><br/>
	<h2>Executive's Details</h2>
	<?php 
	foreach ($all_data as $key => $value) {
		
	?>
	<b><?php echo $key+1; ?></b>
	<label><b>Executive Name: </b></label><?php echo $value->firstname; ?><br/>
	<label><b>Executive Contribution: </b></label><?php echo $value->contribution; ?><br/>
	<?php echo anchor("booking/remove_executive_contri/$id/$value->executive_id", 'Remove this executive', array('onClick'=>"return confirmation();")); ?><br/><br/>
	<?php
	}
	?>

	<!-- baap code -->
	<h2>Enter Executive Contributions</h2>
    
    <?php 
        $exec_options = array();
        foreach ($executives as $executive) {
            $exec_options[$executive->id] = $executive->firstname;
        }
        ?><div id="p_scents"><p>
    <?php
        
        echo form_dropdown('executive[]', $exec_options,'1',array('id'=>'exec_options')).' '.form_input(array('name'=>'contribution[]','placeholder'=>'Contribution', 'size'=>'20'),set_value('contribution'));
    ?></p></div>
    <a class='add-button' href="#" id="addScnt">Add</a>
    <a class='add-button' href="#" id="remScnt">Remove</a>

    <br/><br/>
	<!-- //baap code -->
<?php echo form_submit('submit', 'Submit'); ?>
<?php echo form_close(); ?>
<br/><br/>
<?php echo anchor("booking/delete_booking/$id", "Delete this Booking!!", array('onClick'=>"return confirmation();")); ?>

<!-- 
<h2>Invoice Details</h2>

<?php/* 
$revenue = $all_data[0]->revenue;
if(!$invoice_and_collection){
	echo "No invoice has been Done for this Booking";
}else{
	foreach ($invoice_and_collection as $key => $value) {
		$due_invoice = $revenue - $value->invoice_amount;
?>
<b><?php echo $key+1; ?></b><br/>
<label><b>Invoice Serial: </b></label><?php echo $value->invoice_serial; ?><br/>
<label><b>Invoice Number: </b></label><?php echo $value->invoice_no; ?><br/>
<label><b>Invoice Amount: </b></label><?php echo $value->invoice_amount; ?><br/>
<label><b>Invoice Month: </b></label><?php echo $value->invoice_month; ?><br/>
<label><b>Invoing Due: </b></label><?php echo $due_invoice; ?><br/>
<label><b>Collection Date: </b></label><?php if($value->invoice_month){echo $value->updated_at;}else{echo "Not Collected";} ?><br/><br/><br>


<?php
		$revenue = $due_invoice;
	}
}
?>
<?php
echo br();
echo anchor("booking/edit/$id", "Edit This Booking");
echo br();
echo anchor("booking/reversal/$id", "Reversed Booking", array('onClick'=>"return confirmation();"));
echo br();
*/?>
 -->

</div>
<?php

//var_dump($all_data);
?>
<script>
function confirmation() {
          return confirm("Are you sure?")
      }
</script>
<script type="text/javascript">
        $("div.header").html("<h1>Edit a Booking</h1>");
        $(function() {
                var scntDiv = $("#p_scents p");
                var pscent = $("#p_scents");
                var i = $('#p_scents p').size() + 1;
                
                $('#addScnt').on('click', function() {
                        scntDiv.clone().appendTo(pscent);
                        console.log(scntDiv);//$('#p_scents').clone().appendTo(scntDiv);
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
   
