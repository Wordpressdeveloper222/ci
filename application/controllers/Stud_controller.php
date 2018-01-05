<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stud_controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('session');
		$this->load->library('form_validation'); // Including Validation Library.
		$this->load->model('Stud_Model');
	}

	public function index()
	{
		$this->load->helper('form');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
		$this->form_validation->set_rules('name1', 'Name', 'required'); // Validation for Name Field
		$query = $this->db->get("stud");
		$data["records"]=$query->result();
		$data['category']=$this->Stud_Model->get_region();
		$this->load->view('Stud_view', $data);
	}

	public function login_view()
	{
		$this->load->helper('form');
		$query = $this->db->get("users");
		$this->load->view('login');
	}

	public function login(){
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>'); 
		$this->form_validation->set_rules('uname','Username','required');
		$this->form_validation->set_rules('pwd','password','required');
		if($this->form_validation->run()==FALSE){
		if(isset($this->session->userdata['logged_in'])){
			redirect('admin_page');
			}else{ 
			$this->load->view('login');
			}
		}
		else{	
		$user_login=array(
  			'user_name'=>$this->input->post('uname'),
  			'user_password'=>$this->input->post('pwd')
    	);
    	$data=$this->Stud_Model->login_user($user_login['user_name'],$user_login['user_password']);
    	if($data){
    		$session_data = array(
				'username' => $data['username'],
				'email' => $data['email'],
			);
    		$this->session->set_userdata('logged_in',$session_data);
    		redirect('admin_page');

    	}
    	else {
		$this->session->set_flashdata('error_msg', 'Error occured,Try again.');
        $this->load->view("login");
		}
	}
	}

	public function adminpageview(){
		   $this->load->view('admin_page');
	}

	public function user_logout(){
		$this->session->sess_destroy();
  		redirect('login');
	}
	public function add_registration_view()
	{
		$this->load->helper('form');
		//$this->load->model('Stud_Model');
		$this->load->helper('url');
		$this->load->view('form-registration');
	}

	public function registration()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
		//$this->form_validation->set_rules('name', 'Name', 'required'); // Validation for Name Field
		$query = $this->db->get("users");
		$data1=array('name'=>$this->input->post('name'),'username'=>$this->input->post('username'),'email'=>$this->input->post('email_value'),'password'=>$this->input->post('password'));
		 $result=$this->Stud_Model->insert_user($data1);
		if($result == TRUE){
			//$this->load->view('login',$data1);
			 $this->session->set_flashdata('message_display', 'Registered successfully.Now login to your account.');
			 redirect('login');
			 //$data1['message_display']='User inserted Successfully,Please Login.';
		}
		else{
			$data1['message_display'] = 'Username/Email already exist!';	
			$this->load->view('form-registration',$data1);

		}

	}

	public function add_student_view()
	{
		$this->load->helper('form');
		//$this->load->model('Stud_Model');
		$this->load->helper('url');
		$data['category'] = $this->Stud_Model->get_region();
		$this->load->view('Stud_add',$data);
	}

	public function add_student()
	{
		//$this->load->model('Stud_Model');
		$this->load->library('form_validation');
		//$this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
		$this->form_validation->set_rules('name', 'Name', 'required'); // Validation for Name Field
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$query = $this->db->get("stud");
		$config['upload_path'] ='./uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['overwrite']     = TRUE;
        $config['file_name'] = $_FILES['filename']['name'];
		$files = $_FILES['filename']['name'];
		$this->load->library('upload', $config);
		if($this->upload->do_upload('filename')){
            $uploadData = $this->upload->data();
			 $picture=$uploadData['file_name'];
		}
		else
		{
                $picture = '';
				$upload_error = array('error' => $this->upload->display_errors());
        }
		$p = base_url().'uploads/';
		$uploadedpath = $p.$picture;
		$hobby = $this->input->post('hobby');
		$data['category'] = $this->Stud_Model->get_region();
		if ($this->form_validation->run() == FALSE){
			$this->load->view('Stud_add',$data);
		 }
		 else{
		$data=array('roll_no'=>$this->input->post('roll_no'),'name'=>$this->input->post('name'),'hobbies'=>implode(",", $hobby),'gender'=>$this->input->post('gender'),'file'=>$uploadedpath,'country'=>$this->input->post('country'));
		$this->Stud_Model->insert($data);
		$query=$this->db->get("stud");
		$data['records']=$query->result();
			 $this->load->view('Stud_view',$data);
		  }
	}

    public function update_student_view() {
         $this->load->helper('form');
         $roll_no = $this->uri->segment('3');
         $query = $this->db->get_where("stud",array("roll_no"=>$roll_no));
         $data['records'] = $query->result();
         $data['old_roll_no'] = $roll_no;
         $this->load->view('Stud_edit',$data);
      }

	public function update_student(){
		//$this->load->model('Stud_Model');
		$data=array('roll_no'=>$this->input->post('roll_no'),'name'=>$this->input->post('name'));
		$old_roll_no = $this->input->post('old_roll_no');
		$this->Stud_Model->update($data,$old_roll_no);
	//	$query=$this->db->get("stud",$data);
		$query=$this->db->get("stud");
		$data['records']=$query->result();
		$this->load->view('Stud_view',$data);
	}

	public function delete_student(){
		//$this->load->model('Stud_Model');
		$roll_no=$this->uri->segment('3');
		$this->Stud_Model->delete($roll_no);
		$query = $this->db->get("stud");
		$data['records']=$query->result();
		$this->load->view('Stud_view',$data);
	}
}
