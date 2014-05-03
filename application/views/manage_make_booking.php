<div id="body" style="text-align:justify;">
    <?php echo validation_errors(); ?>
    <?php echo form_open("manage/make_booking/$project"); ?>
    <h2>1. Select Options</h2>
    <?php 
        $avail_options = array(); 
        foreach ($options as $key => $value) {
            $avail_options[$value->option] = $value->option;
        }
        echo 'Available Area Options: '.form_dropdown('options', $avail_options);

    ?>
    <h2>2. Enter Booking Details</h2>
    <p>Select Date of Booking: 
    <input type="text" class="datepicker" name='booking_date'></p>
    <p>Enter Unit Number: 
    <?php echo form_input(array('name'=>'unit_no','placeholder'=>'Unit Number' ,'size'=>'20'),set_value('unit_no')); ?></p>
    <p>Enter Basic Rate: 
    <?php echo form_input(array('name'=>'rate','placeholder'=>'Basic Rate' ,'size'=>'20'),set_value('rate')); ?><sub>Rs per Sq. ft.</sub></p>
    <p>Enter Floor Rise Cost: 
    <?php echo form_input(array('name'=>'floor_rise','placeholder'=>'Floor Rise Cost', 'size'=>'50'),set_value('floor_rise')); ?><sub>Rs</sub></p>
    <p>Enter PLC: 
    <?php echo form_input(array('name'=>'plc','placeholder'=>'PLC', 'size'=>'20'),set_value('plc')); ?><sub>Rs</sub></p>
    <p>Car Parking: 
    <?php echo form_radio('car_park', '1', FALSE, 'onClick="show_car_park_cost();"'); ?><sub>Yes</sub>&nbsp;&nbsp;&nbsp;<?php echo form_radio('car_park', '0', TRUE, 'onClick="fade_car_park_cost();"'); ?><sub>No</sub>
    <span id="car_park_cost" style="display:none;"><?php echo form_input(array('name'=>'car_park_cost', 'placeholder'=>'Car Parking Cost', 'size'=>'20'),set_value('car_park')); ?><sub>Rs</sub></span></p>
    <p>Enter Cashback: 
    <?php echo form_input(array('name'=>'cashback','placeholder'=>'Cashback', 'size'=>'20'),set_value('cashback')); ?><sub>Rs</sub></p>
    <?php echo form_hidden('types', $types); ?>

    <h2>3. Enter Client Details</h2>
    <p>Client Id: 
    <?php echo form_input(array('name'=>'client_id','placeholder'=>'Client ID', 'size'=>'20'),set_value('client_id')); ?></p>
    <p>Enter Name: 
    <?php echo form_input(array('name'=>'client_name','placeholder'=>'Client Name', 'size'=>'20'),set_value('client_name')); ?></p>
    <p>Enter Address: 
    <?php echo form_input(array('name'=>'client_address','placeholder'=>'Client Address', 'size'=>'20'),set_value('client_address')); ?></p>
    <p>Enter City: 
    <?php echo form_input(array('name'=>'client_city','placeholder'=>'Client City', 'size'=>'20'),set_value('client_city')); ?></p>
    <p>Enter E-Mail: 
    <?php echo form_input(array('name'=>'client_email','placeholder'=>'Client EMail', 'size'=>'20'),set_value('client_email')); ?></p>
    <p>Enter Contact: 
    <?php echo form_input(array('name'=>'client_contact','placeholder'=>'Client EMail', 'size'=>'20'),set_value('client_email')); ?></p>

    <h2>4. Enter Executive Contributions</h2>
    <h3><a href="#" id="addScnt">Add Another Value</a></h3>
    <h3><a href="#" id="remScnt">Remove Input Box</a></h3>
    <?php 
        $exec_options = array();
        foreach ($executives as $executive) {
            $exec_options[$executive->id] = $executive->firstname;
        }
        ?><div id="p_scents"><p>
    <?php
        
        echo form_dropdown('executive[]', $exec_options,'1',array('id'=>'exec_options')).' '.form_input(array('name'=>'contribution[]','placeholder'=>'Contribution', 'size'=>'20'),set_value('contribution'));
    ?></p></div>
    <p>Enter Comments: 
        <textarea name='comments' rows='4' cols='50'></textarea></p>
        <?php echo form_submit('submit', 'Enter Data'); ?>
</div>
<script type="text/javascript">
        $("div.header").html("<h1>Make a Booking</h1>");
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
                        }
                        return false;
                });
        });
    </script>
    <script>
    function show_car_park_cost(){
        $("#car_park_cost").show();
    }
    function fade_car_park_cost(){
        $("#car_park_cost").hide();
    }
    </script>