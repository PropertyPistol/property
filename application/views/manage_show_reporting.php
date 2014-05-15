	<?php 
	if(empty($all_data)){
		echo "<br/><br/>No data found for your selection!";
	}else{
		$datas = $all_data;
	}
	if($datas){
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=data.csv');

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');
			fputcsv($output, array('id', 'Client Id', 'Project Id', 'Booking Date', 'Unit Number', 'Unit Type', 'Size', 'Basic Rate', 'Car Park', 'Car Park Cost', 'Floor Rise', 'PLC', 'Agreement Value', 'Revenue', 'Cashback', 'Net Revenue', 'Comments', 'IS_Reversed', 'Executive Name', 'Executive Contribution', 'Invoice Serial', 'Invoice Date', 'Invoice Amount', 'Invoice Percent', 'Is_Collected?'));
		foreach ($datas as $data) {
					// output headers so that the file is downloaded rather than displayed
			

			// output the column headings

			fputcsv($output, array($data->id, $data->client_id, $data->project_id, $data->booking_date, $data->unit_no, $data->unit_type, $data->size, $data->basic_rate, $data->car_park, $data->car_park_cost, $data->floor_rise, $data->plc, $data->agr_value, $data->revenue, $data->cashback, $data->net_revenue, $data->comments, $data->is_reversed, $data->firstname, $data->contribution, $data->invoice_serial, $data->invoice_month, $data->invoice_amount, $data->percent, $data->collected));

			// fetch the data
			//mysql_connect('localhost', 'username', 'password');
			//mysql_select_db('database');
			//$rows = mysql_query('SELECT field1,field2,field3 FROM table');

			// loop over the rows, outputting them
			//while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
				}
		fclose($output);
	}else{
		$this->session->set_flashdata('no_data', "<span class='flash'>No Data Found for your selection!</span>");
		redirect('manage/reporting');
	}
	?>