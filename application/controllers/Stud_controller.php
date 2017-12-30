<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stud_controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
	}

	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation'); // Including Validation Library.
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
		$this->form_validation->set_rules('name1', 'Name', 'required'); // Validation for Name Field
		$query = $this->db->get("stud");
		$data["records"]=$query->result();
		$this->load->model('Stud_Model');
		$data['category']=$this->Stud_Model->get_region();
		$this->load->helper('url');
		//$this->load->view('Stud_view', $data);
		$this->load->view('login');
	}

	public function add_student_view()
	{
		$this->load->helper('form');
		$this->load->model('Stud_Model');
		$this->load->helper('url');
		$data['category'] = $this->Stud_Model->get_region();
		$this->load->view('Stud_add',$data);
	}

	public function add_student()
	{
		$this->load->model('Stud_Model');
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
		$this->load->model('Stud_Model');
		$data=array('roll_no'=>$this->input->post('roll_no'),'name'=>$this->input->post('name'));
		$old_roll_no = $this->input->post('old_roll_no');
		$this->Stud_Model->update($data,$old_roll_no);
	//	$query=$this->db->get("stud",$data);
		$query=$this->db->get("stud");
		$data['records']=$query->result();
		$this->load->view('Stud_view',$data);
	}

	public function delete_student(){
		$this->load->model('Stud_Model');
		$roll_no=$this->uri->segment('3');
		$this->Stud_Model->delete($roll_no);
		$query = $this->db->get("stud");
		$data['records']=$query->result();
		$this->load->view('Stud_view',$data);
	}
}
