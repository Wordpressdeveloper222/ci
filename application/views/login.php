<?php $this->load->view('page_header'); ?>
<div id="login">
<h2 id="login_heading">LOGIN</h2>
<?php 
    echo form_open('Stud_controller/add_student',array('id'=>'form_login'));
    echo form_label('Username');
    echo form_input(array('name'=>'uname','id'=>'uname')); echo '<br/>';
    echo form_label('Password');
    echo form_input(array('name'=>'pwd','id'=>'pwd')); echo '<br/>';
    echo form_submit(array('id'=>'submit','value'=>'Login','id'=>'submit_login')); echo '<br/>';
    echo "<a href='".base_url()."user_authentication/user_registration_show' id='sign_up'>To SignUp Click Here</a>";
    echo form_close();
?>
</div>