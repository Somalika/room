<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		
		$this->smtp_host = 'mail.vital.com.kh';
		$this->smtp_user = 'vuthy.sin@vital.com.kh';
		$this->smtp_pass = 'vuthy';
		
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= $this->smtp_host;
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);
    }
	 
	function testmail(){
		
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= $this->smtp_host;
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);
		
		$this->email->from('vuthy.sin@vital.com.kh', 'vuthy');
		$this->email->from('vuthy.sin@vital.com.kh', 'vuthy');
		$this->email->to('vuthysin5284@hotmail.com');
		$this->email->subject('test');
		
		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://codecanyon.net/item/fps-school-management-system-pro/6087521?ref=joyontaroy\">&copy; 2013 FPS School Management System Pro</a></center>";
		$this->email->message($msg);
		
		$this->email->send();
		
		echo $this->email->print_debugger();
		
		die();
	}
	
	////////////////
	function ticket_email($obj){  
		
		$this->email->from($obj->from, $obj->name); 
		$this->email->to($obj->to);
		//$this->email->cc($from);
		//$this->email->bcc('vuthy.sin@vital.com.kh');
		
		
		$email_msg		=	"Open Ticket, <br /><br />";
		$email_msg		.=	"<p>Open Date: ".$obj->open_date."</p><br />"; 
		$email_msg		.=	"Ticket No #".$obj->ticket_number."  <br />";
		$email_msg		.=	"Subject : ".$obj->title."  <br />";
		$email_msg		.=	"Description : ".$obj->ticket_detail."<br />";
		
		$email_msg		.=	"Regarding,<br />";
		$email_msg		.=	$obj->name."<br />";
		   
		
		$this->email->subject("Ticket: ".$obj->title);
		$this->email->message($email_msg);
		$this->email->send();  
	}
	/*
		feed back email
	*/
	function done_email($obj){
		 
		$this->email->from($obj->from, $obj->name); 
		$this->email->to($obj->to);
		//$this->email->cc($from);
		//$this->email->bcc('vuthy.sin@vital.com.kh');
		
		 
		$email_msg		 =	"<p>Have been fixed, Please kindly checking.<br />"; 
		$email_msg		.=	"Open Date: ".$obj->open_date."</p>"; 
		$email_msg		.=	"Ticket No #".$obj->ticket_number."  <br />";
		$email_msg		.=	"Subject ".$obj->title."  <br />";
		$email_msg		.=	"Description :".$obj->ticket_detail."<br />";
		
		$email_msg		.=	"Regarding,<br />";
		$email_msg		.=	$obj->name."<br />";
		   
		
		$this->email->subject("Ticket: ".$obj->title);
		$this->email->message($email_msg);
		$this->email->send();  
	}
	 
	
	/*
		administrative email confirm booking room
	*/
	function admin_email($obj){ 
		
		//$obj->from_book
		$this->email->from($obj->from_book, $obj->name); 
		$this->email->to($obj->to_adm[0]);  
		$this->email->cc($obj->to_adm[1]);   
		
		 
		$email_msg		 =	"<p>Dear Mr. Hay Kamine,</p><br />"; 
		$email_msg		.=	"I would like to request a meeting room, the detail of the meeting as below:<br />"; 
		$email_msg		.=	"Date :".$obj->dates."  <br />";
		$email_msg		.=	"Time : ".$obj->s_time." - ".$obj->e_time."  <br />";
		$email_msg		.=	"Description :".$obj->descript."<br />";
		$email_msg		.=	"Room number :".$obj->room_number."<br />";
		$email_msg		.=	"Participants :".$obj->member."<br />";
		$email_msg		.=	"Requirement :".$obj->other_requirement."<br /><br /><br />";
		
		$email_msg		.=	"Regarding,<br />";
		$email_msg		.=	$obj->name."<br />";
		   
		
		$this->email->subject($obj->title);
		$this->email->message($email_msg); 
		$this->email->send(); 
				 
	} 
	 
	/* 
		delivery mail back to sender
	*/
	function feedback_email($obj){ 
	
		$this->email->from($obj->to_adm[0], 'Hay Kamine'); 
		$this->email->to($obj->from_book);  
		 
		 
		$email_msg		 =	"<p>Dear ".$obj->name.",</p><br />"; 
		$email_msg		.=	"System auto send mail from Hay Kamine to comfirm for your booking meeting room on:<br />"; 
		$email_msg		.=	"Date :".$obj->dates."  <br />";
		$email_msg		.=	"Time : ".$obj->s_time." - ".$obj->e_time."  <br />";
		$email_msg		.=	"Description :".$obj->descript."<br /><br /><br />";
		
		$email_msg		.=	"Regarding,<br />";
		$email_msg		.=	$obj->name."<br />"; 
		 
		
		$this->email->subject($obj->title);
		$this->email->message($email_msg); 
		$this->email->send();
	}
	
	// cancel room
	function email_admin_cancel_room($obj){
		 
		
		$this->email->from($obj->from_book, "Cancel"); 
		$this->email->to($obj->to_adm[0]);  
		 
		 
		$email_msg		 =	"<p>Dear admin,</p>"; 
		$email_msg		.=	"I would like to comfirm that this ".$obj->title.", i cannot join on that time.:<br />";  
		$email_msg		.=	"Description :".$obj->descript."<br /><br /><br />";
		
		$email_msg		.=	"Regarding,<br />";
		$email_msg		.=	$obj->name."<br />"; 
		 
		 
		$this->email->subject($obj->title);
		$this->email->message($email_msg); 
		$this->email->send();
		 
  		//echo $this->email->print_debugger();
		 
	}

	function account_opening_email($account_type = '' , $email = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		
		$email_msg		=	"Welcome to ".$system_name."<br />";
		$email_msg		.=	"Your account type : ".$account_type."<br />";
		$email_msg		.=	"Your login password : ".$this->db->get_where($account_type , array('email' => $email))->row()->password."<br />";
		$email_msg		.=	"Login Here : ".base_url()."<br />";
		
		$email_sub		=	"Account opening email";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}
	
	function password_reset_email($new_password = '' , $account_type = '' , $email = '')
	{
		$query			=	$this->db->get_where($account_type , array('email' => $email));
		if($query->num_rows() > 0)
		{
			
			$email_msg	=	"Your account type is : ".$account_type."<br />";
			$email_msg	.=	"Your password is : ".$new_password."<br />";
			
			$email_sub	=	"Password reset request";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	
	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= "localhost";
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		if($from == NULL)
			$from		=	$this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;
		
		$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);
		
		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://codecanyon.net/item/fps-school-management-system-pro/6087521?ref=joyontaroy\">&copy; 2013 FPS School Management System Pro</a></center>";
		$this->email->message($msg);
		
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}

