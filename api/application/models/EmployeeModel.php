<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class EmployeeModel extends CI_Model
    {

        public function login($email)
        {
            $this->db->where('email like binary',$email);
            $query = $this->db->get('employees');
            return $query->result_array();
        }
        
        public function joinTable($table1, $table2, $on, $where=array()){
	        $this->db->select('*');
	        $this->db->from($table1);
	        $this->db->join($table2, $on, 'inner');
	        $this->db->where($where);
	        $query = $this->db->get();
	        return $query->result_array();
        }
        
        public function select($table,$condition=array()){
	        $query = $this->db->get($table);
	        if(!empty($condition)){
	            $query = $this->db->get_where($table,$condition);
	        }
	        $result = $query->result_array();
	        return $result;
        }
        
        public function insert($table,$data){
	        $this->db->insert($table,$data);
	        $insert_id = $this->db->insert_id();
	        return  $insert_id;
        }
        
        public function update($table,$where,$data){
	        $update = $this->db->update($table,$data,$where);
	        return $update;
        }
		
		public function delete($table,$where){
	        $delete = $this->db->delete($table,$where);
	        return $delete;
	    }
        
    }   
?>
