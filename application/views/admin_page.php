<?php
if(isset($this->session->userdata['logged_in'])){
	$username=$this->session->userdata['logged_in']['username'];
	$email=$this->session->userdata['logged_in']['email'];
}
else{
	header('location:login');
}
?>
<?php $this->load->view('header');?>
<div id="profile">
<?php
echo "Hello <b id='welcome'><i>" . $username . "</i> !</b>";
echo "<br/>";
echo "<br/>";
echo "Welcome to Admin Page";
echo "<br/>";
echo "<br/>";
echo "Your Username is " . $username;
echo "<br/>";
echo "Your Email is " . $email;
echo "<br/>";
?>
<b id="logout"><a href="logout">Logout</a></b>
<b id="View"><a href="stud">View</a></b>

</div>