<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Joyonto Roy
 * 	30th July, 2014
 * 	Creative Item
 * 	www.freephpsoftwares.com
 * 	http://codecanyon.net/user/joyontaroy
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('is_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh'); 
			
        $this->load->view('backend/login');
    }

    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $username = $_POST["username"];
        $password = $_POST["password"]; 
        $response['submitted_data'] = $_POST;
		$login_type = '';
        //Validating login
        $login_status = $this->validate_login($username, $password,$login_type);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = $this->session->userdata('last_page');
        }

        //Replying ajax request with validation response
        echo json_encode($response);

    }

    //Validating login from ajax request
    function validate_login($username = '', $password = '', $login_type = '') {
        $credential = array('user_name' => $username, 'password' => $password);
		 

        // Checking login credential for admin
        $query = $this->db->get_where('user', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			
			$new = $this->getUserInfo($username, $password, $login_type);

            $this->session->set_userdata('is_login', '1');
            $this->session->set_userdata('user_id', $row->USER_ID); 

			$this->session->set_userdata('group_name', $new['group_name']);
			
			$this->session->set_userdata('FULL_NAME_KH', $row->FULL_NAME_KH); 
			$this->session->set_userdata('FULL_NAME', $row->FULL_NAME); 
            $this->session->set_userdata('login_type', 'admin');



            return 'success';
        }
 
        return 'invalid'; 
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
         
        // send new password to user email  
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }
	
	function getUserInfo($param1 = '',$param2 = '',$param3 = ''){ 
		$sql = "
			select 
				u.USER_ID,
				u.BRAND_ID,
				u.USER_NAME,
				u.FULL_NAME_KH,
				u.FULL_NAME,
				uh.GROUP_NAME,
				'' as prefix
				
			from user u
			inner join user_group_d ud on ud.USER_ID = u.USER_ID
			inner join user_group_h uh on uh.GROUP_ID = ud.GROUP_ID 
			where USER_NAME=?
			and PASSWORD = ? 
		"; 
		
		
        $record = $this->db->query($sql,array($param1,$param2))->result_array();
		 
		 
		foreach($record as $row){
			$user["user_id"] 	= $row["USER_ID"];
			$user["branch_id"] 	= $row["BRAND_ID"];
			$user["user_name"] 	= $row["USER_NAME"];
			$user["full_name_kh"] = $row["FULL_NAME_KH"];
			$user["full_name"] = $row["FULL_NAME"];
			$user["group_name"] 	= $row["GROUP_NAME"];
			$user["prefix"] = $row["prefix"]; 
		}
		  
		return $user;
		
	} 
	
	 
}
