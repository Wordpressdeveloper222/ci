<?php 
   class Stud_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 

     public function insert_user($data1){ 
 		$this->db->select('*');
 		$this->db->from('users');
 		$this->db->where('username',$data1['username']);
 		$this->db->or_where('email',$data1['email']);
 		 $query = $this->db->get();

 		if ($query->num_rows() == 0) {
 			$this->db->insert('users', $data1); 
				if ($this->db->affected_rows() > 0) {
				return true;
			}
		}
     	else{
     		return false;
     	}
     }

     public function login_user($user_name,$user_password){
     	$this->db->select('*');
     	$this->db->from('users');
     	$this->db->where('username',$user_name);
     	$this->db->where('password',$user_password); $a=$this->db->last_query(); 
     	$query=$this->db->get(); 
     	/* echo query 
     	echo $a=$this->db->last_query();*/ 
     	if($query->num_rows() == 1	){
     		return $query->row_array();
     	}
     	else{
     		return false;
     	}
     }
   
	  public function insert($data)
	  {
		  if($this->db->insert('stud',$data))
		  {
			  return true;
		  }
	  }
	  
	  public function update($data,$old_roll_no)
	  {
		  $this->db->set($data);
		  $this->db->where('roll_no',$old_roll_no);
		  $this->db->update("stud",$data);
	  }
	  
	  public function delete($roll_no)
	  {
		  if ($this->db->delete("stud", "roll_no = ".$roll_no)) { 
            return true; 
         } 
	  }
	  
Public function get_region()
{
	$query = $this->db->get('country');
	$result = $query->result();
    return $result;
}
   }
   
     
?> 