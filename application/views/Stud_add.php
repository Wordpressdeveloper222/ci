<!DOCTYPE html> 
<html lang = "en">
 
   <head> 
      <meta charset = "utf-8"> 
      <title>Students Example</title> 
   </head> 
   <body> 
  <?php echo validation_errors(); ?>
         <?php 
			echo form_open_multipart('Stud_controller/add_student');
			echo form_label('Roll No.');
			echo form_input(array('id'=>'roll_no','name'=>'roll_no')); echo "</br>";
			echo form_label('Name'); 
			echo form_input(array('id'=>'name','name'=>'name')); echo '</br>'; 
			echo form_checkbox('hobby[]', 'type 1'); echo 'Type 1';
			echo form_checkbox('hobby[]', 'type 2'); echo 'Type 2'; echo '</br>';
		    echo form_radio(array('name'=>'gender','value'=>'female','checked'=>TRUE)); echo 'female';
			echo form_radio(array('name'=>'gender','value=>female'));echo 'male';echo '</br>';
			echo form_upload(array('type'=>'file','name'=>'filename')); echo '</br>';
			echo '<select name="country">';
				foreach($category as $cat) {
	              echo '<option name="'.$cat->cname.'"   value="'.$cat->cname.'" >'.$cat->cname.'</option>';
			}
			echo '</select><br/>';  
			echo form_submit(array('id'=>'submit','value'=>'Add'));
			echo form_close();
         ?> 
		 
   </body>
</html>