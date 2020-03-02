<?php
/**
 * Autocomplete_Model
 *
 * @package autocomplete
 */

class Auto_model extends CI_Model{

	function __construct() {
		parent::__construct();
		$this->load->database() ;
	}

     function lookup($obj){ 
		$sql = "select 
					em.*,
					
					(select emp_name from emp where id = em.report_to) report_to_name,
					(select emp_name from emp where id = em.hod) hod_name,
					
					(select email from emp where id = em.report_to) report_to_email,
					(select email from emp where id = em.hod) hod_email ,
					dp.department,
					dg.group_name
					
				from emp em
				inner join departments dp on dp.id = em.dep_id 
				inner join department_group dg on dg.id = em.`group` 
				where em.emp_no like ? ";
        return $this->db->query($sql,array($obj["keyword"].'%'))->result(); 
		 
    }  
	
	// model look up name
	function name_lookup($obj){ 
		$sql = "select 
					 * 
				from  room r
				inner join staying s on s.room_id = r.room_id
				where CONCAT(s.staying_name,' ', r.name) like ? ";
        return $this->db->query($sql,array('%'.$obj["keyword"].'%'))->result(); 
		 
    }  
	/*** validation date rang and checking room ***/
	function validatorRoom($obj){
		
		$sql = "select 
					* 
				from room r
				where r.containing >= ?
				and r.id not in (select 
					 distinct n.room_number
				from noticeboard n 
				where create_timestamp =?
				and n.to_hour>=?)";
        return $this->db->query($sql,array($obj->bmember,$obj->dates,$obj->hours))->result(); 
	}
}