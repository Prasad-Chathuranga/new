<?php  
     include("../connection.php");
     include("function/acctFun.php");  

     
     ///////////////////// select job    ///////////////////////////////
function jobFun($conn){
    $query="SELECT job.*,city.name as city_nm FROM `job` LEFT JOIN city ON city.id = job.Jcity ORDER BY job.Jid DESC";
    $run = mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0) {
        return $run;
    }else{
       die();
   }  
 }
 
 ///////////////////// select from buy job table   ///////////////////////////////
 function buyFun($conn,$sts){
    $query="SELECT * FROM `buy`
    JOIN accountant ON buy.Aid=accountant.Aid
    JOIN job ON buy.Jid=job.Jid WHERE bSts='$sts'";
    $run = mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0) {
        return $run;
    }else{
       die();
   }  
 }
   ////////////////////////// Delete jobs   ///////////////////////////////
  
   if (isset($_GET["Jid"])) {
    $del_id = $_GET["Jid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM job WHERE Jid='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {  
      
    echo "<script>alert('Data have been Deleted.');</script>";

    echo "<meta http-equiv='refresh' content='0;job.php'>" ;

  }
  }

   ////////////////////////// Delete buy jobs   ///////////////////////////////
  
   if (isset($_GET["byid"])) {
    $del_id = $_GET["byid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM buy WHERE bid='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {  
      
    echo "<script>alert('Data have been Deleted.');</script>";

  }

  }

 //   //////////////////////// Approve the Job  //////////////////////////////////
 if (isset($_POST["editjob"])) {
   
    $id=mysqli_real_escape_string($conn,$_POST["id"]);
    $credit=mysqli_real_escape_string($conn,$_POST["credit"]);
    $jdesAft=mysqli_real_escape_string($conn,$_POST["jdesAft"]);
        $adid=$_SESSION["id"];
// echo "<script> alert('$name/$email/$contact/$address/$desc/$company')</script>";

                $sql ="UPDATE `job` SET `JSts`=1,`Jcredits`='$credit', `jdesAft`='$jdesAft'
                ,`admId`='$adid' WHERE Jid='$id'";
               
                  if (mysqli_query($conn,$sql)) {

                        echo "<script> 
                        alert('Job has been Approved.');
                          </script>";
                  echo "<meta http-equiv='refresh' content='0;job.php'>" ;
                  }else {
                    echo "<script> alert('Error. Data not Saved')</script>";
                    
                    // echo "error :".$sql. "<br>". $conn->error;
                  }
 }

 //  ///////////////////// Approve the job bought .update query   ///////////////////////////////
if (isset($_POST["approved"])) {
    $id=mysqli_real_escape_string($conn,$_POST["id"]);
    $sql = "UPDATE buy SET `bSts`=1 WHERE bid='$id'";
  
    if (mysqli_query($conn,$sql)) {
        echo "<script>alert('the Accountant profile has been approved.');</script>";
        echo "<meta http-equiv='refresh' content='0;jobrequest.php'>" ;
  
    }
  
  }
?>
