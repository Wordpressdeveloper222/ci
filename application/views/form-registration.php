<?php $this->load->view('page_header'); ?>
<?php
echo "<div class='error_msg'>";
echo validation_errors();
echo "</div>";
if (isset($message_display)) {
echo $message_display;
}
echo "<div class='container registration'>";
echo form_open('Stud_controller/registration',array('id'=>'form_reg'));
echo '<h2 id="reg_heading">Create an account</h2>';
echo form_label('Name : ');
echo"<br/>";
echo form_input('name');echo"<br/>";echo"<br/>";
echo form_label('Username : ');
echo"<br/>";
echo form_input('username');
echo "<div class='error_msg'>";
echo "</div>";
echo"<br/>";
echo form_label('Email : ');
echo"<br/>";
$data = array(
'name' => 'email_value'
);
echo form_input($data);
echo"<br/>";
echo"<br/>";
echo form_label('Password : ');
echo"<br/>";
echo form_password('password');
echo"<br/>";
echo"<br/>";
echo form_submit(array('value'=>'Submit','id'=>'submit_reg'));
echo "</div>"; 
echo form_close();
?>