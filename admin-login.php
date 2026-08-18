<?php require_once "lib/call.php";
 $admin = viewdata("admin/admin.xlsx","Sheet1");
if(isset($_POST['username']) and isset($admin[$_POST['username']])){
 if(isset($admin[$_POST['username']]['password'])){
  if(isset($_POST['password'])){
   if($_POST['password'] == $admin[$_POST['username']]['password']){
    $_SESSION['nimda']="ko";
    ?><script>window.location.reload();</script><?php
   }else{
  echo "Wrong Username or Password";   
   }
  }else{
  echo "Invalid Username and Password"; 
  }
 }else{
  echo "Please Contact Web Admin";
 }
}else{
 echo "Invalid Username and Password";
}
?>