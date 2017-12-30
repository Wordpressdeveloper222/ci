
<?php
class Home extends CI_Controller {

 

 public function index(){
           $this->load->helper(array('form'));
    $this->load->library('form_validation');
  $this->form_validation->set_rules('userName', 'Username', 'required');
  $this->form_validation->set_rules('userPassword', 'Password', 'required');
  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
  
  if ($this->form_validation->run() == FALSE){
   $this->load->view('myform');
  }else{
   $this->load->view('formsuccess');
  }
  
 }
}