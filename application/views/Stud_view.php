<?php $this->load->view('page_header'); ?>


      <title>Students Example</title> 
	
 <div id="addview">
		<a href ="<?php echo base_url();?>stud/add_view">Add</a>		  
</div>
  <!-- Modal -->

  <h3 id="example_title">Example 1</h3>
  <div class="tableview">
	<table border="1">
		<?php
			$i=1;
			echo "<tr>";
			echo "<th>Sr#</th>";
			echo "<th>Roll No</th>";
			echo "<th>Name</th>";
			echo "<th>Edit</th>";
			echo "<th>Delete</th>";
			echo "</tr>";
			
		
			foreach($records as $r)
			{
				echo "<tr>";
				echo "<td>".$i++."</td>";
				echo "<td>".$r->roll_no."</td>";
				echo "<td>".$r->name."</td>";
				echo "<td><a href= '".base_url()."stud/edit/".$r->roll_no."' id='edit_student'>Edit</a></td>";
				echo "<td><a href= '".base_url()."stud/delete/".$r->roll_no."' id='delete_student'>Delete</a></td>";
				echo "</tr>";				
			}

		?>
    </table> 
</div>
 <h3 id="example_title">Example 2</h3>
 <button type="button" class="" data-toggle="modal" data-target="#myModal">Open Modal</button>
 <div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body addform">
		<?php
			echo form_open_multipart('Stud_controller/add_student');
			echo form_label('Roll No.');
			echo form_input(array('id'=>'roll_no1','name'=>'roll_no1')); echo "</br>";
			echo form_label('Name'); 
			echo form_input(array('id'=>'name1','name'=>'name1')); echo '</br>'; 
			echo form_label('Hobby'); 
			echo form_checkbox('hobby1[]', 'type 1'); echo 'Type 1';
			echo form_checkbox('hobby1[]', 'type 2'); echo 'Type 2'; echo '</br>';
			echo form_label('Gender'); 
		    echo form_radio(array('name'=>'gender1','value'=>'female','checked'=>TRUE)); echo 'female';
			echo form_radio(array('name'=>'gender1','value=>female'));echo 'male';echo '</br>';
			echo form_label('Image'); 
			echo form_upload(array('type'=>'file','name'=>'filename1' ,'id'=>'filename1')); echo '</br>';
			echo form_label('Country'); 
			echo '<select name="country1">';
				foreach($category as $cat){
					      echo '<option name="'.$cat->cname.'"   value="'.$cat->cname.'" >'.$cat->cname.'</option>';
				}
			echo '</select><br/>';
			?>
        <input type="button" name="save_jquery" value="Add" onclick="adddata()"/>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>     
    </div>
 </div>
 <div class="tableview">
 </div>
<?php $this->load->view('page_footer.php');
	

