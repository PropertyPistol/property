
<div id="databox" style="margin-top:40px; margin-left:10px;">
<label><b>Booking Id: </b></label><?php echo $id; ?><br/>
<label><b>Project: </b></label><?php echo $all_data[0]->project; ?><br/>
<label><b>Builder: </b></label><?php echo $all_data[0]->builder; ?><br/>
<h2>Client Details</h2>
<label><b>Client Name: </b></label><?php echo $all_data[0]->name; ?><br/>
<label><b>Client Email: </b></label><?php echo $all_data[0]->email; ?><br/>
<label><b>Client Address: </b></label><?php echo $all_data[0]->address.', '.$all_data[0]->city; ?><br/>
<label><b>Client Contact: </b></label><?php echo $all_data[0]->phone; ?><br/>
<h2>Booking Details</h2>
<label><b>Booking Date: </b></label><?php echo $all_data[0]->booking_date; ?><br/>
<label><b>Unit No.: </b></label><?php echo $all_data[0]->unit_no; ?><br/>
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
<?php
}
?>
<h2>Invoice Details</h2>

<?php
$revenue = $all_data[0]->revenue;
if(!$invoice_and_collection){
	echo "No invoice has been Done for this Booking";
}else{
	foreach ($invoice_and_collection as $key => $value) {
		$due_invoice = $revenue - $invoice_amount;
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
echo br();
echo anchor("booking/reversal/$id", "Reversed Booking", array('onClick'=>"return confirmation();"));
echo br();
?>

</div>
<?php

//var_dump($all_data);
?>
<script>
function confirmation() {
          return confirm("Are you sure?")
      }
</script>
   
