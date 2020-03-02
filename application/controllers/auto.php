<?php 

class Auto extends CI_Controller {
  
 
 	function lookup(){
		
		$this->load->model('auto_model');
		$forwhom_auto = $this->input->post('forwhom_auto',TRUE);
		

		if (strlen($forwhom_auto) < 2) break;

		$rows = $this->auto_model->lookup(array('keyword' => $forwhom_auto));
		 

		$json_array = array();
		foreach ($rows as $row){
			array_push($json_array, $row->emp_no);
		}
 
		echo json_encode($json_array);
	}
	
	// name look up
	function name_lookup(){
		
		$this->load->model('auto_model');
		$forwhom_auto = $this->input->post('forwhom_auto',TRUE);
		

		if (strlen($forwhom_auto) < 2) break;

		$rows = $this->auto_model->name_lookup(array('keyword' => $forwhom_auto));
		 

		$json_array = array();
		foreach ($rows as $row){
			array_push($json_array, $row->staying_name.' - '.$row->name);
		}
 
		echo json_encode($json_array);
	} 
	
	// get data staff login detail from database
	function getDataDetail(){
		$this->load->model('auto_model');
		$staff_id = $this->input->post('emp_id_auto',TRUE);
		

		if (strlen($staff_id) < 2) break;

		$rows = $this->auto_model->lookup(array('keyword' => $staff_id));
		 

		$json_array = array();
		foreach ($rows as $row){ 
			
			array_push($json_array, $row);
		}
 
		echo json_encode($json_array);
	} 

	 
}