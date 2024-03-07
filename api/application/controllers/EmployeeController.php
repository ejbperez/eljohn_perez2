<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller {

	public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Credentials");
       
        parent::__construct();
        $models = array('EmployeeModel');
        $this->load->model($models);

        $this->load->library('JSONResponse');
        $this->load->library('form_validation');
    } 
	
    public function login()
    {   
        $credentials = array(
            'email' => trim($this->input->post('email')),
            'password' => trim($this->input->post('password'))
        );
        
        $credsOutput = $this->EmployeeModel->login($credentials['email']);
        
        if($credsOutput) {
        
            $typed = $credentials['password'];
	        $hashed = $credsOutput[0]['password'];
	                
            if (password_verify($typed, $hashed)) {
            
                $session_data = array(
                    'id' => $credsOutput[0]['id'], 
                    'firstname' => $credsOutput[0]['firstname'], 
                    'email' => $credsOutput[0]['email'],
                    'access_level_id' =>  $credsOutput[0]['access_level_id'],
                );
                
                $this->session->set_userdata($session_data);
                $array_response = ['code'=>1,'sess_data'=>$session_data];
			}else{
				$array_response = ['code'=>0,'message'=>'Login failed'];
			}
            
        }else{
            $array_response = ['code'=>0,'message'=>'Failed'];
        }
        JSONResponse::output(JSONResponse::json_output($array_response));
    }
    
    public function getEmployees() {
        
        $_INPUT = json_decode(file_get_contents('php://input'), true);
        
        if(empty($_INPUT['access_level'])) {
            $employees = $this->EmployeeModel->joinTable("employees e","access_levels a","e.access_level_id = a.access_level_id");
        }else{
            $employees = $this->EmployeeModel->joinTable("employees e","access_levels a","e.access_level_id = a.access_level_id", array('e.access_level_id' => $_INPUT['access_level']));
        }
        
        if($employees) {
            
            $array_response = ['code'=>1,'data'=>$employees];
        }else{
            $array_response = ['code'=>0,'message'=>'Failed'];
        }
        
        JSONResponse::output(JSONResponse::json_output($array_response));
    }
    
    public function getAccessLevel() {
        
        $access_level = $this->EmployeeModel->select("access_levels");
        if($access_level) {
            $array_response = ['code'=>1,'data'=>$access_level];
        }else{
            $array_response = ['code'=>0,'message'=>'Failed'];
        }
        
        JSONResponse::output(JSONResponse::json_output($array_response));
    }
    
    public function addEmployee() {
    
		$_INPUT = $this->input->post();
        $arrayParams = array(
            'firstname' => $_INPUT['fname'],
            'lastname' => $_INPUT['lname'],
            'age' => $_INPUT['age'],
            'birth_date' => $_INPUT['birth_date'],
            'email' => $_INPUT['email'],
            'password' => password_hash($_INPUT['password'], PASSWORD_BCRYPT),
            'job_title' => $_INPUT['job_title'],
            'access_level_id' => $_INPUT['access_level_id'],
        );
            
        $insertEmployee = $this->EmployeeModel->insert("employees",$arrayParams);
            
        if($insertEmployee) {
            $array_response = ['code'=>1,'message'=>"Created Successfully"];
        }else{
            $array_response = ['code'=>0,'message'=>"Failed to create employee"];
        }
        
        JSONResponse::output(JSONResponse::json_output($array_response));
        
    }
    
    public function getEmployeeById() {
        
        $_INPUT = json_decode(file_get_contents('php://input'), true);
        $employee = $this->EmployeeModel->joinTable("employees e","access_levels a","e.access_level_id = a.access_level_id", array('id' => $_INPUT['id']));
        if($employee) {
            
            $array_response = ['code'=>1,'data'=>$employee];
        }else{
            $array_response = ['code'=>0,'message'=>'Failed'];
        }
        
        JSONResponse::output(JSONResponse::json_output($array_response));
    }
    
    
    public function updateEmployee() {
    
		$_INPUT = $this->input->post();
        $arrayParams = array(
            'id' => $_INPUT['id'],
            'firstname' => $_INPUT['fname'],
            'lastname' => $_INPUT['lname'],
            'email' => $_INPUT['email'],
            'job_title' => $_INPUT['job_title'],
            'date_modified' => date('y-m-d'),
        );
            
        $insertEmployee = $this->EmployeeModel->update("employees",array('id' => $_INPUT['id']), $arrayParams);
            
        if($insertEmployee) {
            $array_response = ['code'=>1,'message'=>"Updated Successfully"];
        }else{
            $array_response = ['code'=>0,'message'=>"Failed to update employee"];
        }
        
        JSONResponse::output(JSONResponse::json_output($array_response));
        
    }
    
    public function deleteEmployee() {
        $_INPUT = json_decode(file_get_contents('php://input'), true);
        $deleteEmployee = $this->EmployeeModel->delete("employees",array('id' => $_INPUT['id']));
        
        if($deleteEmployee) {
            $array_response = ['code'=>1,'message'=>"Deletesd Successfully"];
        }else{
            $array_response = ['code'=>0,'message'=>"Failed to dalete employee"];
        }
    }
    
}
