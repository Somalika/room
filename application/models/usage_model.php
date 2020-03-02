<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usage_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }
	
	function clear_cache()
	{
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
	}   
	
	function loadUsageList($obj){
		$sql = " 
			
			 SELECT 
				max(u.usage_id) as usage_id,
				u.room_id,
				max(u.old_usage) as old_usage,
				max(u.new_usage) as new_usage,
				max(u.usage_amount) as usage_amount,  
				r.name room_name ,
				t.type_name,
				r.amount
			FROM `usage` u  
			INNER JOIN room r ON r.room_id = u.room_id
			INNER JOIN `type` t ON t.type_id = u.type_id AND t.`status` = 3 
			WHERE u.status = 1 and u.is_build =0
			group by u.room_id,t.type_name  
		";
		return $this->db->query($sql)->result_array();
	}
	 
}

