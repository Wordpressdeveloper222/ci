<?php
if (isset($this->session->userdata['logged_in'])) {
header("location: admin_page");
}
?>
<?php $this->load->view('page_header'); ?>
<?php
echo "<div class='error_msg'>";
echo validation_errors();
echo "</div>";
?>
<div id="login">
<h2 id="login_heading">LOGIN</h2>
<?php
$error_msg=$this->session->flashdata('error_msg');
if($error_msg){
	echo '<div class="alert alert-danger">'.$error_msg.'</div>';
}
?>
<?php 
    echo form_open('Stud_controller/login',array('id'=>'form_login'));
    echo form_label('Username');
    echo form_input(array('name'=>'uname','id'=>'uname')); echo '<br/>';
    echo form_label('Password');
    echo form_password(array('name'=>'pwd','id'=>'pwd')); echo '<br/>';
    echo form_submit(array('id'=>'submit','value'=>'Login','id'=>'submit_login')); echo '<br/>';
    echo "<a href='".base_url()."registration_view/' id='sign_up'>To SignUp Click Here</a>";
    echo form_close();
?>			  

</div>