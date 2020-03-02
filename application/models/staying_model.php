<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staying_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }
	
	function clear_cache()
	{
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
	}   
	
	//
	function loadStayInfo($obj){
		$sql = " SELECT 
					*
				FROM  staying s
				inner join room r on r.room_id = s.room_id
				WHERE  r.name = ?
				 
				
				
		";  
		return $this->db->query($sql,array($obj->room_name))->row();
	}
	//
	function loadWaterUsageInfo($obj){
		$sql = " SELECT 
					room_id,
					room_name,date_entry,paid_date,
					MIN(old_usage) AS old_usage,
					MAX(new_usage) AS new_usage,
					SUM(usage_amount) AS usage_amount
				FROM
				(
					SELECT 
						u.`room_id`,
						r.`name` AS room_name,
						DATE_FORMAT(u.date,'%Y-%m-%d') AS date_entry,
						DATE_FORMAT(u.paid_date,'%Y-%m-%d') AS paid_date,
						u.`old_usage`,
						u.`new_usage`,
						0 usage_amount 
						 
					FROM `usage` u
					INNER JOIN room r ON r.`room_id` = u.`room_id` 
					WHERE u.`status` = 1
					AND u.`type_id` = ?
					AND r.`name` = ?
					
					UNION ALL
					
					SELECT 
						u.`room_id`,
						r.`name` AS room_name,
						DATE_FORMAT(u.date,'%Y-%m-%d') AS date_entry,
						DATE_FORMAT(u.paid_date,'%Y-%m-%d') AS paid_date,
						MIN(u.`old_usage`) AS old_usage,
						MAX(u.`new_usage`) AS new_usage,
						SUM(u.`usage_amount`) AS usage_amount
						 
					FROM `usage` u
					INNER JOIN room r ON r.`room_id` = u.`room_id` 
					WHERE u.`status` = 0
					AND u.`type_id` = ?
					AND r.`name` =  ?
					GROUP BY u.`room_id`
				) t
				GROUP BY room_id, room_name 
			";  
		return $this->db->query($sql,array($obj->type_id,$obj->room_name, $obj->type_id,$obj->room_name))->row();
	}
	// listed reserve room
	function reserve_room_list(){
		$sql = ' select * number from room where room_id not in(
					select room_id from staying 
					where status = 1
					and  room_id>0
					group by room_id
					)
				';  
		return $this->db->query($sql)->result_array();
		 
	} 
	// count reserve room
	function reserve_room_count(){
		$sql = ' select * from room where room_id not in(
					select room_id from staying 
					where status in(4,5,6)
					and  room_id>0
					group by room_id
					)
				';  
				
		$query =$this->db->query($sql);
		if ($query->num_rows === 0)
		{
			return 0;
		}
 
		return (int) $query->num_rows; 
	} 
	 
}

