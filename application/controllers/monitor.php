<?php 

class Monitor extends CI_Controller {
 
 	function validatorRoom(){
		 $obj = new stdClass();
		$this->load->model('auto_model');
		$obj->bmember 	= $this->input->post('member',TRUE);
		$obj->dates 		= strtotime($this->input->post('date',TRUE));
		/*$obj->start_hour= $this->input->post('start_hour',TRUE);
		$obj->start_mn 	= $this->input->post('start_mn',TRUE);
		$obj->to_hour 	= $this->input->post('to_hour',TRUE);
		$obj->to_mn 		= $this->input->post('to_mn',TRUE); */
		
		//echo strtotime('06/17/2016');
		
		$obj->hours = $this->input->post('start_hour').":".$this->input->post('start_mn').":00";
		 
		$rows = $this->auto_model->validatorRoom($obj);
		 

		$json_array = array();
		foreach ($rows as $row){   
			array_push($json_array, $row); 
		}
		echo json_encode($json_array);
 
	}
	 

	 
}