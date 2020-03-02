<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	protected $user;
	protected $timestamp;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library("Aauth");
		$this->user = $this->aauth->get_user_id();
		$this->timestamp = date('Y-m-d H:i:s');
		$this->aauth->is_loggedin() ? '' : redirect('login','refresh');
	}
}
