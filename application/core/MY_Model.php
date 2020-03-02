<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	
    public function insert($table, $data){
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
    
    public function update($table, $data, $field, $condition){
        $this->db->where($field, $condition);
        $this->db->update($table, $data);    
        return $this->db->affected_rows();
    }
    
    public function delete($table, $field, $condition){
        $this->db->where($field, $condition);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    
    public function select($table, $order_by = 'id', $type = 'asc'){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('status',1);
        $this->db->order_by($order_by, $type);
        $query = $this->db->get();
        return $query->result();
    }

    public function get($table, $field, $condition, $order_by = 'id', $type = 'asc'){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $condition);
        $this->db->order_by($order_by, $type);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($table, $id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function exist($table, $column, $conditin)
    {
        $this->db->where($column, $conditin);
        return (($this->db->get($table)->num_rows() > 0) ? true : false) ;
    }
}
