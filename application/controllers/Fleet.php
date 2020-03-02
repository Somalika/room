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

class Fleet extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');

        $this->session->set_userdata('login_type', 'fleet');
		
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
            redirect(base_url() . 'index.php?fleet/dashboard', 'refresh');
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

        $page_data['sub_folder']  = '';
        $page_data['page_name']  = 'dashboard';
        $page_data['filter_data']  = '';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);

    }
    /***vehicle***/
    function vehicle()
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
        }

        $page_data['room_avaiable']  = $this->staying_model->reserve_room_count();
        //$page_data['reserver_ticket']  = $this->meeting_model->reserveTicketCount();
        //$page_data['reserver_leave']  = $this->meeting_model->reserveLeaveCount();

        $page_data['sub_folder']  = '';
        $page_data['page_name']  = 'dashboard';
        $page_data['filter_data']  = '';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);

    }
    /***contacting***/
    function contacting()
    {
        if ($this->session->userdata('is_login') != 1){
            redirect(base_url(), 'refresh');
        }

        $page_data['room_avaiable']  = $this->staying_model->reserve_room_count();
        //$page_data['reserver_ticket']  = $this->meeting_model->reserveTicketCount();
        //$page_data['reserver_leave']  = $this->meeting_model->reserveLeaveCount();

        $page_data['sub_folder']  = '';
        $page_data['page_name']  = 'dashboard';
        $page_data['filter_data']  = '';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);

    }

}
