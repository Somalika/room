<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Joyonto Roy
 *	date		: 27 september, 2014
 *	FPS School Management System Pro
 *	http://codecanyon.net/user/FreePhpSoftwares
 *	support@freephpsoftwares.com
 */

class Accounting extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {  
        if ($this->session->userdata('is_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
			
        if ($this->session->userdata('is_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }
	
	// get register nextid
	function nextid(){
		$arr = array();
		
        $this->db->select('next_id, value');
		$this->db->where('next_id','register_id');
		$nextid = $this->db->get('nextid')->result_array();
		
		foreach($nextid as $row):
		 	$arr['regid'] = $row["value"];
		 	$this->registry_model->insertNextRegisterId($arr['regid']); 
		endforeach;  
		 
		 $arr['prefixs'] = $this->session->userdata('prefix'); 
		 		
		return $arr;
	}
	
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
			 
		$page_data['room_avaiable']  = $this->staying_model->reserve_room_count();
		//$page_data['reserver_ticket']  = $this->meeting_model->reserveTicketCount();
		//$page_data['reserver_leave']  = $this->meeting_model->reserveLeaveCount();
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);
		
    }
	 
	/****MANAGE building*****/
    function building($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric'); 
            $this->db->insert('building', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/building/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric'); 
            
            $this->db->where('building_id', $param2);
            $this->db->update('building', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/building/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('building', array(
                'building_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('building_id', $param2);
            $this->db->delete('building');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/building/', 'refresh');
        }
        $page_data['building']    = $this->db->get('building')->result_array();
        $page_data['sub_folder']  = 'building/';
        $page_data['page_name']  = 'building';
        $page_data['page_title'] = get_phrase('manage_building');
        $this->load->view('backend/index', $page_data);
    }
	
	/****MANAGE ROOM*****/
    function room($building_id = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        // detect the first class
        if ($building_id == '')
            $building_id           =   $this->db->get('building')->first_row()->building_id;

        $page_data['sub_folder']  = 'room/';
        $page_data['page_name']  = 'room';
        $page_data['page_title'] = get_phrase('manage_rooms');
        $page_data['building_id']   = $building_id;
        $this->load->view('backend/index', $page_data);    
    }

    function rooms($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        //
		$data['name']       =   $this->input->post('name');
		$data['amount']  	=   $this->input->post('amount');
		$data['building_id'] =   $this->input->post('building_id'); 
		//
        if ($param1 == 'create') {
            $this->db->insert('room' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/room/' . $data['building_id'] , 'refresh');
        }

        if ($param1 == 'edit') { 
            $this->db->where('room_id' , $param2);
            $this->db->update('room' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/room/' . $data['building_id'] , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('room_id' , $param2);
            $this->db->delete('room');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/room' , 'refresh');
        }
    }
	/****MANAGE staying*****/
    function staying($room_id = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        // detect the first class
        if ($room_id == '')
            $room_id           =   $this->db->get('room')->first_row()->room_id;

        $page_data['sub_folder']  = 'staying/';
        $page_data['page_name']  = 'staying';
        $page_data['page_title'] = get_phrase('manage_staying');
        $page_data['room_id']   = $room_id;
        $this->load->view('backend/index', $page_data);    
    }

    function stayings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
		
		//
		$data['staying_name']       =   $this->input->post('name');
		$data['gender_id']       =   $this->input->post('gender');
		$data['date_in']  =   date('Y-m-d',strtotime($this->input->post('date_in')));
		$data['next_paid_date']  =   date('Y-m-d',strtotime($this->input->post('date_in')));
		$data['id_card']  =   $this->input->post('id_card');
		$data['phone']   =   $this->input->post('phone'); 
		$data['job']   =   $this->input->post('job'); 
		$data['number_person']   =   $this->input->post('number_person'); 
		$data['room_id']   =   $this->input->post('room_id'); 
		$data['booking']   =   $this->input->post('booking'); 
		//	
        if ($param1 == 'create') {
            $this->db->insert('staying' , $data); 
			
			// update room info
			$this->db->where('room_id',$this->input->post('room_id'));
			$this->db->set('water_old_date',$data['date_in']);
			$this->db->set('elect_old_date',$data['date_in']);
			$this->db->set('booking',$this->input->post('booking'));
			$this->db->set('staying_id',$this->db->insert_id());
			$this->db->update('room');
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/staying/' . $this->input->post('room_id') , 'refresh');
        }

        if ($param1 == 'edit') {  
			   
            $this->db->where('staying_id' , $this->input->post('staying_id')); 
			$this->db->set('status',$this->input->post('is_staying'));
            $this->db->update('staying',$data);
			
			//	update room info		
			$this->db->where('room_id',$this->input->post('room_id'));
			$this->db->set('water_old_date',$data['date_in']);
			$this->db->set('elect_old_date',$data['date_in']);
			$this->db->set('booking',$this->input->post('booking'));
			$this->db->set('staying_id',$this->input->post('staying_id'));
			$this->db->update('room');
			 
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/staying/' . $this->input->post('room_id') , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('staying_id' , $param2);
            $this->db->delete('staying');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/staying' , 'refresh');
        }
    }

    function get_building_room($building_id)
    {
        $rooms = $this->db->get_where('room' , array(
            'building_id' => $building_id
        ))->result_array();
        foreach ($rooms as $row) {
            echo '<option value="' . $row['room_id'] . '">' . $row['name'] . '</option>';
        }
    }

      
	//
	function create_room_payment($param1 = '', $param2 = '', $param3 = ''){
		if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		} 
        if ($param1 == 'create') {
            $data['room_id']         = $this->input->post('room_id');
            $data['type_id'] = $this->input->post('type_id'); 
            $data['old_usage'] = $this->input->post('old_usage'); 
            $data['new_usage'] = $this->input->post('new_usage'); 
            $data['usage_amount'] = ($this->input->post('new_usage') - $this->input->post('old_usage')); 
            $data['date'] = date('Y-m-d'); 
            $data['entry_by'] = $this->session->userdata("user_id"); 
			
			
            $this->db->insert('`usage`', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/entry/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['room_id']         = $this->input->post('room_id');
            $data['type_id'] = $this->input->post('type_id'); 
            $data['old_usage'] = $this->input->post('old_usage'); 
            $data['new_usage'] = $this->input->post('new_usage'); 
            $data['usage_amount'] = ($this->input->post('new_usage') - $this->input->post('old_usage')); 
            $data['modified_date'] = date('Y-m-d'); 
            $data['modified_by'] = $this->session->userdata("user_id"); 
            
            $this->db->where('usage_id', $param2);
            $this->db->update('`usage`', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/entry/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('usage', array(
                'usage_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('usage_id', $param2);
            $this->db->delete('`usage`');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/entry/', 'refresh');
        } 
		
		$sql = "
			select 
				u.usage_id,
				u.room_id,
				u.old_usage,
				u.new_usage,
				u.usage_amount,
				u.date, 
				t.type_name,
				r.name room_name 
			from `usage` u 
			inner join `type` t on t.type_id = u.type_id
			inner join room r on r.room_id = u.room_id
			where u.status = 0
		";
		$page_data['entry']    = $this->db->query($sql)->result_array();
		$page_data['filter_data']  = '';
        $page_data['sub_folder']  = 'accounting/';
        $page_data['page_name']  = 'create_room_payment';
        $page_data['page_title'] = get_phrase('create_room_payment');
        $this->load->view('backend/index', $page_data);
	}
	//
	function room_payment($param1 = '' , $param2 = '')
    {
       if ($this->session->userdata('is_login') != 1)
            redirect('login', 'refresh');
			
		$sql = "
					select 
						* ,
						r.name
					from invoice inv 
					inner join staying s on s.room_id = inv.room_id
					inner join room r on r.room_id = inv.room_id 
					where inv.is_paid = ?
					
				";
		$sql1 = "
					select 
						ind.*, 
						inv.room_id,
						inv.is_paid,
						inv.invoice_date,
						r.name
					from invoice inv
					inner join payment ind on ind.invoice_id = inv.invoice_id 
					inner join room r on r.room_id = inv.room_id 
					where inv.is_paid = ?
				";
			
        $page_data['sub_folder']  = 'accounting/';
        $page_data['page_name']  = 'room_payment';
        $page_data['page_title'] = get_phrase('room_payment'); 
        $page_data['invoices'] = $this->db->query($sql,array('unpaid'))->result_array();
        $page_data['invoices_history'] = $this->db->query($sql1,array('paid'))->result_array();
        $this->load->view('backend/index', $page_data); 
    } 
	/******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    { 	 
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
		
		// set up price
        $water_price     	= $this->crud_model->get_system_settings_description('water_price');
        $electricity        = $this->crud_model->get_system_settings_description('electricity');
		        
        if ($param1 == 'create') {
            $data['building_id']        = $this->input->post('building_id');
            $data['room_id']         	= $this->input->post('room_id');
            $data['staying_id']         = $this->input->post('staying_id');
            $data['title']              = $this->input->post('title'); 
			   
            $data['description']        = $this->input->post('description');
            $data['room_amount']        = $this->input->post('room_price');
            $data['next_paid_date'] 	= $this->input->post('next_paid_date');
            $data['start_billing_date'] = $this->input->post('next_paid_date');
            $data['end_billing_date']   = date('Y-m-d',strtotime("+1 month",strtotime($this->input->post('next_paid_date'))));
			
			
            $data['water_amount']       = (int)$this->input->post('water_usage') * (int)$water_price;
            $data['elect_amount']       = (int)$this->input->post('elect_usage') * (int)$electricity;
			
            $data['due']                = ($data['room_price'] + $data1['water_amont'] + $data1['elect_amount']) - $data['amount_paid']; 
            $data['water_due']         =  $data['water_amount']  - $this->input->post('amount_water');
            $data['elect_due']         =  $data['elect_amount'] - $this->input->post('amount_elect'); 
			
			
            $data['is_paid']             = $this->input->post('status');
            $data['payment_method']     = $this->input->post('method');
			
            $data['invoice_date']		= date('Y-m-d',strtotime($this->input->post('date')));
			$data['created_date'] 		= date('Y-m-d'); 
            $data['created_by'] 		= $this->session->userdata("user_id"); 
            
            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();
			
			
            $data1['unit']              = 1;
            $data1['unit_price']              = $this->input->post('room_price');
            $data1['total_room']              = $this->input->post('room_price');
			// usage power
            $data1['water_old']              = $this->input->post('water_old');
            $data1['water_new']              = $this->input->post('water_new');
            $data1['water_usage']            = $this->input->post('water_usage');
            $data1['water_price']            = $water_price;
            $data1['total_water_price']      =  (int)$water_price *  (int)$this->input->post('water_usage');
			
            $data1['elect_old']              = $this->input->post('elect_old');
            $data1['elect_new']              = $this->input->post('elect_new');
            $data1['elect_usage']            = $this->input->post('elect_usage');
            $data1['elect_price']            = $electricity;
            $data1['total_elect_price']      = (int)$electricity * (int)$this->input->post('elect_usage'); 
			
            $data1['invoice_id']        =   $invoice_id;
			
			// invoice detail
			$this->db->insert('invoice_detail' , $data1);
			
			// update room for last usage
			$update["water_old_usage"] = $this->input->post('water_new');
			$update["elect_old_usage"] = $this->input->post('elect_new');
			$update["water_old_date"] = $data['invoice_date'];
			$update["elect_old_date"] = $data['invoice_date'];
			$this->db->where('room_id',$this->input->post('room_id'));
			$this->db->update('room',$update);
			
			
			// paid on room
			if($this->input->post('status')=='paid'){
			
					// payment
					$data2['invoice_id']        =   $invoice_id;
					$data2['room_id']         	=   $this->input->post('room_id');
					$data2['title']             =   $this->input->post('title');
					$data2['description']       =   $this->input->post('description');
					$data2['payment_type']      =  'income';
					
					$data2['method']            =   $this->input->post('method'); 
					
					$data2['room_amount']	=   $this->input->post('room_price');
					$data2['water_amount']	=   (int)$water_price *  (int)$this->input->post('water_usage');
					$data2['elect_amount']	=   (int)$electricity * (int)$this->input->post('elect_usage');
					$data2['timestamp']    	=   strtotime($this->input->post('date'));
					//
					$this->db->insert('payment' , $data2); 
					 
					
					$this->db->where('invoice_id' , $invoice_id);
					$this->db->set('room_amount', 'room_amount - ' . $this->input->post('room_price'), FALSE);
					$this->db->set('water_amount', 'water_amount - ' . (int)$water_price *  (int)$this->input->post('water_usage'), FALSE);
					$this->db->set('elect_amount', 'elect_amount - ' . (int)$electricity * (int)$this->input->post('elect_usage'), FALSE);
					//
					$this->db->update('invoice');
					//
					$this->db->where('room_id',$this->input->post('room_id'));
					$this->db->where_in('status',array('5','4'));
					$this->db->set('paid_date',date('Y-m-d',strtotime($this->input->post('date')))); 
					$this->db->set('next_paid_date',$this->input->post('next_paid_date')); 
					$this->db->update('staying');
					 
			}
			 

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			redirect(base_url() . 'index.php?admin/room_payment', 'refresh');
        } 
         

        if ($param1 == 'do_update') {
            $data['room_id']         = $this->input->post('room_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'take_payment') {
			
            $data['invoice_id']   	=   $this->input->post('invoice_id');
            $data['room_id']   		=   $this->input->post('room_id');
            $data['title']        	=   $this->input->post('title');
            $data['description']  	=   $this->input->post('description');
            $data['payment_type'] 	=   'income';
            $data['method']       	=   $this->input->post('method');
            $data['room_amount']	=   $this->input->post('room_amount');
            $data['water_amount']	=   $this->input->post('water_amount');
            $data['elect_amount']	=   $this->input->post('elect_amount');
            $data['timestamp']    	=   strtotime($this->input->post('timestamp'));
           //
		    $this->db->insert('payment' , $data);

            $data2['room_amount']	=   $this->input->post('room_amount');
            $data2['water_amount']	=   $this->input->post('water_amount');
            $data2['elect_amount']	=   $this->input->post('elect_amount');
            $data3['is_paid']		=   'paid';
			
            $this->db->where('invoice_id' , $this->input->post('invoice_id'));
            $this->db->set('room_amount', 'room_amount - ' . $data2['room_amount'], FALSE);
            $this->db->set('water_amount', 'water_amount - ' . $data2['water_amount'], FALSE);
            $this->db->set('elect_amount', 'elect_amount - ' . $data2['elect_amount'], FALSE);
            //
			$this->db->update('invoice',$data3);
			//
			$this->db->where('room_id',$this->input->post('room_id'));
			$this->db->where_in('status',array('5','4'));
			$this->db->set('paid_date',date('Y-m-d',strtotime($this->input->post('timestamp')))); 
			$this->db->set('next_paid_date',$this->input->post('next_paid_date')); 
			$this->db->update('staying');
			//var_dump($this->db->queries);
			//die();
            $this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?admin/room_payment', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        $page_data['page_name']  = 'room_payment';
        $page_data['page_title'] = get_phrase('manage_invoice/payment'); 
		
		$sql = "select * from invoice inv inner join room r on r.room_id = inv.room_id";
        $page_data['invoices'] = $this->db->query($sql)->result_array();
        $this->load->view('backend/index', $page_data);
    }
	//**************** billing process ********************//
	function billing($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		} 
		 
		$page_data['sub_folder']  = 'accounting/';
        $page_data['page_name']  = 'billing';
        $page_data['page_title'] = get_phrase('billing');
        $this->load->view('backend/index', $page_data);
	}
	// get old usage
	function get_old_usage($room_id)
    {
		$sql = "select 
					 s.staying_id,
					 water_old_usage,
					 elect_old_usage,
					 water_old_date,
					 elect_old_date,
					 r.amount,
					 s.next_paid_date
					 
					 
				from staying s
				inner join room r on r.room_id = s.room_id
				where r.room_id = ?
				";
        $room = $this->db->query($sql, array($room_id))->result_array(); 
        foreach ($room as $row) {
			$data["water_old_usage"] = $row['water_old_usage'];
			$data["elect_old_usage"] = $row['elect_old_usage'];
			$data["room_price"] = $row['amount'];
			$data["staying_id"] = $row['staying_id'];
			
			// set up price
			$data["water_price"]    	= $this->crud_model->get_system_settings_description('water_price');
			$data["electricity"]       = $this->crud_model->get_system_settings_description('electricity');
			
			$data["water_old_date"]    	= $row['water_old_date'];
			$data["elect_old_date"]       = $row['elect_old_date'];
			$data["next_paid_date"]    	= $row['next_paid_date'];
        }
		
		echo json_encode($data);
    }
	//////////////
	function get_building($building_id)
    {
		$sql = "select
					r.room_id,
					r.name					
				from
				room r
				inner join staying s on s.room_id = r.room_id
				where r.building_id = ?
				and r.room_id not in (select room_id from invoice where is_paid = 'unpaid')
				";
        $room = $this->db->query($sql, array($building_id))->result_array();
			echo "<option value=''>Select room First</option>";
        foreach ($room as $row) {
            echo '<option value="' . $row['room_id'] . '">' . $row['name'] . '</option>';
        }
    }
	//////////////
	function get_building_mass($building_id)
    {
        $room = $this->db->get_where('room' , array(
            'building_id' => $building_id
        ))->result_array();
        echo '<div class="form-group">
                <label class="col-sm-3 control-label">' . get_phrase('builling') . '</label>
                <div class="col-sm-9">';
        foreach ($room as $row) {
            echo '<div class="checkbox">
                    <label><input type="checkbox" class="check" name="room_id[]" value="' . $row['room_id'] . '">' . $row['name'] .'</label>
                </div>';
        }
        echo '<br><button type="button" class="btn btn-default" onClick="select()">'.get_phrase('select_all').'</button>';
        echo '<button style="margin-left: 5px;" type="button" class="btn btn-default" onClick="unselect()"> '.get_phrase('select_none').' </button>';
        echo '</div></div>';
    }
	//
	function entry($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		} 
        if ($param1 == 'create') {
            $data['room_id']         = $this->input->post('room_id');
            $data['type_id'] = $this->input->post('type_id'); 
            $data['old_usage'] = $this->input->post('old_usage'); 
            $data['new_usage'] = $this->input->post('new_usage'); 
            $data['usage_amount'] = ($this->input->post('new_usage') - $this->input->post('old_usage')); 
            $data['date'] = date('Y-m-d'); 
            $data['entry_by'] = $this->session->userdata("user_id"); 
			
			
            $this->db->insert('`usage`', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/entry/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['room_id']         = $this->input->post('room_id');
            $data['type_id'] = $this->input->post('type_id'); 
            $data['old_usage'] = $this->input->post('old_usage'); 
            $data['new_usage'] = $this->input->post('new_usage'); 
            $data['usage_amount'] = ($this->input->post('new_usage') - $this->input->post('old_usage')); 
            $data['modified_date'] = date('Y-m-d'); 
            $data['modified_by'] = $this->session->userdata("user_id"); 
            
            $this->db->where('usage_id', $param2);
            $this->db->update('`usage`', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/entry/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('usage', array(
                'usage_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('usage_id', $param2);
            $this->db->delete('`usage`');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/entry/', 'refresh');
        } 
		
		$sql = "
			select 
				u.usage_id,
				u.room_id,
				u.old_usage,
				u.new_usage,
				u.usage_amount,
				u.date, 
				t.type_name,
				r.name room_name 
			from `usage` u 
			inner join `type` t on t.type_id = u.type_id
			inner join room r on r.room_id = u.room_id
			where u.status = 0
		";
		$page_data['entry']    = $this->db->query($sql)->result_array();
		$page_data['sub_folder']  = 'accounting/';
        $page_data['page_name']  = 'entry';
        $page_data['page_title'] = get_phrase('entry_management');
        $this->load->view('backend/index', $page_data);
	}
	 
	
	/*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        
        if ($param1 == 'do_update') {
			 
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh'); 
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
      
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
    
    
	
	/***** UPDATE PRODUCT *****/
	
	function update( $task = '', $purchase_code = '' ) {
        
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
            
        // Create update directory.
        $dir    = 'update';
        if ( !is_dir($dir) )
            mkdir($dir, 0777, true);
        
        $zipped_file_name   = $_FILES["file_name"]["name"];
        $path               = 'update/' . $zipped_file_name;
        
        move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);
        
        // Unzip uploaded update file and remove zip file.
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }
        
        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        $str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json               = json_decode($str, true);
        

			
		// Run php modifications
		require './update/' . $unzipped_file_name . '/update_script.php';
        
        // Create new directories.
        if(!empty($json['directory'])) {
            foreach($json['directory'] as $directory) {
                if ( !is_dir( $directory['name']) )
                    mkdir( $directory['name'], 0777, true );
            }
        }
        
        // Create/Replace new files.
        if(!empty($json['files'])) {
            foreach($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }
        
        $this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
        redirect(base_url() . 'index.php?admin/system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);	
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	/////////////////////////
    function auditrial(){
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
		}
		
		 $sql ="
             select 
				tr.CONTEXT,
				tr.DESCRIPTION,
				DATE_ADD(tr.AUDIT_DATE,INTERVAL 7 hour) AUDIT_DATE,
				tr.HOSTNAME,
				tr.IP_ADDRESS,
				 
				login_name FULL_NAME
				
				from audit_trial tr  
				order by tr.AUDIT_ID desc	
        ";
        $page_data['audit_trial']   = $this->db->query($sql)->result_array();  
		
        $page_data['page_name']  = 'auditrial';
        $page_data['page_title'] = get_phrase('auditrial');
        $this->load->view('backend/index', $page_data);
    } 
    
}
