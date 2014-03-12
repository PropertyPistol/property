<div id="body" style="text-align:justify;">
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
    <h2>1. Enter Client's Details</h2>
    <p>Enter Name: 
    <?php echo form_input(array('name'=>'type','placeholder'=>'Enter Type in BHK' ,'size'=>'20'),set_value('type')); ?><sub>BHK</sub></p>
    <p>Enter Email: 
    <?php echo form_input(array('name'=>'unit_no','placeholder'=>'Enter Unit Number', 'size'=>'50'),set_value('unit_no')); ?></p>
    <p>Enter Phone: 
    <?php echo form_input(array('name'=>'size','placeholder'=>'Area in Square Feet', 'size'=>'20'),set_value('size')); ?><sub>Square Feet</sub></p>
    <p>Enter City: 
    <?php echo form_input(array('name'=>'basic_rate','placeholder'=>'Rate per Square Feet', 'size'=>'20'),set_value('basic_rate')); ?><sub>Rs. Per Square Feet</sub></p>
    <p>Enter State: 
    <?php echo form_checkbox('car_park', '1', FALSE); ?><sub>Yes/No</sub></p>

    <h2>2. Enter Booking Details</h2>
    <p>Select Date of Booking: 
    <input type="text" id="datepicker" name='booking_date'>
    <p>Enter Cashback: 
    <?php echo form_input(array('name'=>'plc','placeholder'=>'Enter PLC', 'size'=>'20'),set_value('plc')); ?><sub>Rs.</sub></p>

    <p>Enter Comments: 
        <textarea name='comments' rows='4' cols='50'></textarea>

    <h2>3. Enter Executive's Contributions</h2>   
        <h3><a href="#" id="addScnt">Add Another Value</a></h3>
        <h3><a href="#" id="remScnt">Remove Input Box</a></h3>
    <?php echo form_submit('submit', 'Submit'); ?>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
        $("div.header").html("<h1>Make a Booking</h1>");
    </script>