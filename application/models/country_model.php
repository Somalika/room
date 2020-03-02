<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country_model extends CI_Model {
	
	function __construct(){
        parent::__construct();
    }
	 public function getSchedule($time_id) {
        $this->db->select('class_id,name');
        $this->db->from('class'); 
        $array = array('schedule_id' => $time_id,'branch_id'=>$this->session->userdata('branch_id'));
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();         
    }
    public function filterNationalityByCountryID($country_id) {
        $this->db->select('id,nationality');
        $this->db->from('country');
        //$this->db->join('class_room', 'room.id = class_room.room_id');
        $array = array('country_id' => $country_id);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();         
    }
    public function filterProvince($country,$type) {
        $this->db->select('id,province,name');
        $this->db->from('location');
        //$this->db->join('class_room', 'room.id = class_room.room_id');
        $array = array('country' => $country,'type' => $type);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();         
    }
    public function filterDistrict($country,$type,$province) {
        $this->db->select('id,district,name');
        $this->db->from('location');
        //$this->db->join('class_room', 'room.id = class_room.room_id');
        $array = array('country' => $country,'type' => $type,'province' => $province);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();         
    }
    public function filterCommune($country,$type,$province,$district) {
        $this->db->select('id,commune,name');
        $this->db->from('location');
        //$this->db->join('class_room', 'room.id = class_room.room_id');
        $array = array('country' => $country,'type' => $type,'province' => $province,'district' => $district);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();         
    }
    public function insertLocation($insertType,$data){        
        $this->db->select_max($insertType);
        switch ($insertType) {
            case 'country':
                $condition = array('type'=>1);
                $this->db->where($condition);
                break;
            case 'province':
                $condition = array('type'=>$data['type'],'country'=>$data['country']);
                $this->db->where($condition);
                break;
            case 'district':
                $condition = array('type'=>$data['type'],'country'=>$data['country'],'province'=>$data['province']);
                $this->db->where($condition);
                break;
            case 'commune':
                $condition = array('type'=>$data['type'],'country'=>$data['country'],'province'=>$data['province'],'district'=>$data['district']);
                $this->db->where($condition);
            default:
                
                break;
        }        
        $result = $this->db->get('location')->row();
        //echo $result->$insertType;
        //return;

        $max=($result->$insertType)?$result->$insertType+1:1;
        //prepare data
        //$data['name']=$this->input->post('data')['name'];
        $data[$insertType]=$max;        
        $index=$this->db->insert('location', $data);
        if($index){
            $data=json_encode($data);
            return $data;
        }
    }
    public function insertCountry($data){
        $index=$this->db->insert('country', $data);
        $data['id'] = mysql_insert_id();
        if($index){
            $data=json_encode($data);
            return $data;
        }
    }


}

