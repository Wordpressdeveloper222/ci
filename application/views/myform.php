<html>
<head>
<style type="text/css">
.error{
 color:red;
 margin:10px;
}
Table.GridOne {
 padding: 3px;
 margin:10px;
 background: lightyellow;
 border-collapse: collapse; 
 width:20%;
}
Table.GridOne Td { 
 padding:3px;
 margin:3px;
 border: 2px solid orange;
 border-collapse: collapse;


</style>
</head>
 <body>
  <?php echo validation_errors(); ?>
  <form name="userForm" method="post" action="home">
  <table class="GridOne">
   <tr>
    <td>User Name</td>
    <td><input type="text" name="userName" id="userName" value=""></td>
   </tr>
   <tr>
    <td>Password</td>
    <td><input type="password" name="userPassword" id="userPassword" value=""></td>
   </tr>
   <tr>
    <td colspan="2"><input type="submit" value="Submit"></td>
   </tr>
  </table>
  </form>
 </body>
</html>

 
