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

class Check extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('usage_model');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

    }

    /****check*****/
    function check($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('is_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $data['description'] = $this->input->post('description');
        $data['price_list'] = $this->input->post('price_list');
        if ($param1 == 'create') {
            $this->db->insert('price_list', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?pricelist/pricelist/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $this->db->where('id', $param2);
            $this->db->update('price_list', $data);
            $this->session->set_flashdata('flash_message', get_phrase('data_updated'));
            redirect(base_url() . 'index.php?pricelist/pricelist/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('price_list', array('id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('price_list');
            $this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?pricelist/pricelist/', 'refresh');
        }
        $page_data['price_list'] = $this->db->get('price_list')->result_array();
        $page_data['sub_folder'] = 'price_list/';
        $page_data['page_name'] = 'price_list';
        $page_data['filter_data'] = '';
        $page_data['page_title'] = get_phrase('price_list');
        $this->load->view('backend/index', $page_data);
    }
}
