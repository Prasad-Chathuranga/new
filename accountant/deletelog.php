<?php   
include("include/connection.php");
$del_id=$_GET['delid'];
$query="DELETE FROM log WHERE id='$del_id'";
$run = mysqli_query($conn,$query);
  if ($run) {

  echo "<script>alert('log have been Deleted.');</script>";
  echo "<meta http-equiv='refresh' content='0;../accountant/my leads1.php'>" ;
  }else{
    echo "<script>alert('log Not Deleted.');</script>";
    
  }

 


?>