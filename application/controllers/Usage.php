<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Usage extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model('usage_model');
        
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    // mobile entry
	function mobile_entry()
    {


        $data['building_id']    = $this->input->post('building_id');
        $data['room_id']        = $this->input->post('room_id');
		$data['type_id']        = $this->input->post('type_id');
		$data['old_usage']      = $this->input->post('old_usage');
		$data['new_usage']      = $this->input->post('new_usage');
		$data['usage_amount']   = ($this->input->post('new_usage') - $this->input->post('old_usage'));


        // new obj
        $obj = new stdClass();
        $obj->room_id           = $data['room_id'];
        if($data['type_id']==7) {
            $obj->old_water = $data['new_usage'];
        }else if($data['type_id']==8){
            $obj->old_elect = $data['new_usage'];

        }
        // create new usage
        $data['date']       = date('Y-m-d h:i');
        $data['entry_by']   = $this->session->userdata("user_id");
        $this->db->insert('`usage`', $data);
        // update room info
        $this->crud_model->update_room($obj);

	}


}
