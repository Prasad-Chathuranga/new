<?php
       include("include/connection.php");

   ///////////////////// select from buy job table   ///////////////////////////////
 function credFun($conn,$sts){
    $query="SELECT * FROM `buy_credit` 
    JOIN accountant ON buy_credit.Aid=accountant.Aid WHERE crSts='$sts'";
    $run = mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0) {
        return $run;
    }else{
       die();
   }  
 }

  ////////////////////////// Delete buy credit   ///////////////////////////////
  
  if (isset($_GET["bcrid"])) {
    $del_id = $_GET["bcrid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM buy_credit WHERE bcr_id='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {
   
    echo "<script>alert('Credit Request have been Deleted.');</script>";
    echo "<meta http-equiv='refresh' content='0;creditsrequest.php'>" ;
   

  }

  }

 ////////////////////////// Delete buy credit   ///////////////////////////////
  
 if (isset($_GET["bchid"])) {
  $del_id = $_GET["bchid"];
  // $del_id2 = $_GET["cid"];

  $query="DELETE FROM buy_credit WHERE bcr_id='$del_id'";
  // $query2="DELETE FROM company WHERE cid='$del_id2'";

$run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
if ($run) {

  echo "<script>alert('Credit Request have been Deleted.');</script>";
  echo "<meta http-equiv='refresh' content='0;creditshistory.php'>" ;
 

}

}

  //  ///////////////////// Approve the credit bought .update query   ///////////////////////////////
if (isset($_POST["approved"])) {
    $id=mysqli_real_escape_string($conn,$_POST["id"]);
    $credit=mysqli_real_escape_string($conn,$_POST["credit"]);
    $aid=mysqli_real_escape_string($conn,$_POST["aid"]);
    $adid=$_SESSION["id"];

    $query="SELECT * FROM `total_credits` WHERE Aid='$aid'";
    $run = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($run); 

        $total= $row["tcr_amount"]+$credit;

      $sql = "UPDATE buy_credit SET `crSts`=1,admnId='$adid' WHERE bcr_id='$id'";

      $update_query="UPDATE `total_credits` SET `tcr_amount`='$total' WHERE Aid='$aid'";

    if (mysqli_query($conn,$sql) AND mysqli_query($conn,$update_query)) {
        echo "<script>alert('the credits have been approved.');</script>";
        echo "<meta http-equiv='refresh' content='0;creditsrequest.php'>" ;
  
    }
  
  }
?>