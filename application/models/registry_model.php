<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registry_model extends CI_Model {
	
	function __construct(){
        parent::__construct();
    }
	
	// update next id for invoice
	// $inv_id is the current id
	// $field is the field using for remark which invoice
	public function insertNextInvoiceId($inv_id,$field){
		$data['value']  = ($inv_id + 1);
		$this->db->where('next_id', ''.$field.'');
		$this->db->update('nextid', $data);
	}
	
	// update next id register
	public function insertNextRegisterId($Reg_id){
		$data['value']  = ($Reg_id + 1);
		$this->db->where('next_id', 'register_id');
		$this->db->update('nextid', $data);
	}
	
	// update test id 
	public function insertNextTestId($Test_id){ 
		$data['value']  = ($Test_id +1) ;
		$this->db->where('next_id', 'test_id');
		$this->db->update('nextid', $data);
	} 
	
	// tracking the user
	public function auditrail(){
		
	}
	
	
    public function filterRoomByClassID($class_id) {
        $this->db->select('room_id,room_number');
        $this->db->from('room');
        $this->db->join('class_room', 'room.id = class_room.room_id');
        $array = array('class_id' => $class_id);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result(); 
    }
	public function get_district($country, $type, $province) {
        //return $this->db->query('select * from location where type = 3 and country = 1 and province ='.$province)->result();
        $this->db->select('district, name');
        $array = array('type' => $type, 'country' => $country, 'province' => $province);
        $this->db->where($array);
        $query = $this->db->get('location');
        return $query->result(); 
    } 

    public function get_commune($country, $type, $province, $district) {
        $this->db->select('commune, name');
        $array = array('type' => $type, 'country' => $country, 'province' => $province, 'district' => $district);
        $this->db->where($array);
        $query = $this->db->get('location');
        return $query->result(); 
    }

    public function sample($country, $type) {
        $this->db->select('id, name');
        $this->db->where('type =', 2);
        $this->db->where('country =', 1); 
        $query = $this->db->get('location');
        $data = array();
        if($query->num_rows() > 0) {
            foreach($query->result() as $rows) {
                $data['id'] = $rows->id;
                $data['name'] = $rows->name;
            }
            return $data;
        }
    }
}

