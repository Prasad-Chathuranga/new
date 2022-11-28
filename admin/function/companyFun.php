<?php

///////////////////// select company type   ///////////////////////////////
function ctFun($conn){
    $query="SELECT * FROM `companytype`";
    $run = mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0) {
        return $run;
    }else{
       die();
   }  
 }
///////////////////// select company    ///////////////////////////////
function comFun($conn){
    $query="SELECT * FROM `company`
    JOIN companytype ON company.tid=companytype.tid";
    $run = mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0) {
        return $run;
    }else{
       die();
   }  
 }
 

 //   //////////////////////// insert company type  //////////////////////////////////
 if (isset($_POST["savect"])) {
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $jt=mysqli_real_escape_string($conn,$_POST["jt"]);
    
         
                $sql = ("INSERT INTO `companytype`(`ctype`, `job_type`) VALUES ('$name','$jt')");
                  if (mysqli_query($conn,$sql)) {
                    echo "<script> 
                    alert('Data have Been Saved.');
                         </script>";
                  echo "<meta http-equiv='refresh' content='0;companytype.php'>" ;
                  }else {
                    echo "<script> alert('Error. Data not Saved')</script>";
                    
                    // echo "error :".$sql. "<br>". $conn->error;
                  }
           
    }

 //   //////////////////////// edit company type  //////////////////////////////////
 if (isset($_POST["editct"])) {
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $jt=mysqli_real_escape_string($conn,$_POST["jt"]);
    $id=mysqli_real_escape_string($conn,$_POST["id"]);
    
         
                $sql = "UPDATE `companytype` SET `ctype`='$name',`job_type`='$name' WHERE tid='$id'";
                  if (mysqli_query($conn,$sql)) {
                    echo "<script> 
                    alert('Data have Been updated.');
                         </script>";
                  echo "<meta http-equiv='refresh' content='0;companytype.php'>" ;
                  }else {
                    echo "<script> alert('Error. Data not Saved')</script>";
                    
                    // echo "error :".$sql. "<br>". $conn->error;
                  }
           
    }

    ////////////////////////// Delete company type   ///////////////////////////////
  
   if (isset($_GET["hhid"])) {
    $del_id = $_GET["hhid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM companytype WHERE tid='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {
    echo "<meta http-equiv='refresh' content='0;companytype.php'>" ;

  echo "<script>alert('Data have been Deleted.');</script>";

  }

  }

   ////////////////////////// Delete company   ///////////////////////////////
  
   if (isset($_GET["cid"])) {
    $del_id = $_GET["cid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM company WHERE cid='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {
    echo "<meta http-equiv='refresh' content='0;company.php'>" ;

  echo "<script>alert('Data have been Deleted.');</script>";

  }

  }
 
// insert query of company
if (isset($_POST["save"])) {
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $web=mysqli_real_escape_string($conn,$_POST["website"]);
    $address=mysqli_real_escape_string($conn,$_POST["address"]);
    $desc=mysqli_real_escape_string($conn,$_POST["desc"]);
    $company=mysqli_real_escape_string($conn,$_POST["company"]);
    
    // echo "<script> alert('$name/$email/$contact/$address/$desc/$company')</script>";

                $sql = ("INSERT INTO `company`(`cname`, `cemail`, `caddress`, `cwebsite`, `cdesc`, `tid`) VALUES 
                ('$name','$email','$address','$web','$desc','$company')");
                  if (mysqli_query($conn,$sql)) {
                    echo "<script> 
                    alert('Data have Been Saved.');
                         </script>";
                  echo "<meta http-equiv='refresh' content='0;company.php'>" ;
                  }else {
                    echo "<script> alert('Error. Data not Saved')</script>";
                    
                    // echo "error :".$sql. "<br>". $conn->error;
                  }
           
    }

// update query of company
if (isset($_POST["savechange"])) {
    $cid=mysqli_real_escape_string($conn,$_POST["cid"]);
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $web=mysqli_real_escape_string($conn,$_POST["website"]);
    $address=mysqli_real_escape_string($conn,$_POST["address"]);
    $desc=mysqli_real_escape_string($conn,$_POST["desc"]);
    $company=mysqli_real_escape_string($conn,$_POST["company"]);
    
    // echo "<script> alert('$name/$email/$contact/$address/$desc/$company')</script>";

                $sql = ("UPDATE `company` SET `cname`='$name',`cemail`='$email',
                          `caddress`='$address',`cwebsite`='$web',`cdesc`='$desc',`tid`='$company' WHERE cid='$cid'");
                  if (mysqli_query($conn,$sql)) {
                    echo "<script> 
                    alert('Data have Been Saved.');
                         </script>";
                  echo "<meta http-equiv='refresh' content='0;company.php'>" ;
                  }else {
                    echo "<script> alert('Error. Data not Saved')</script>";
                    
                    // echo "error :".$sql. "<br>". $conn->error;
                  }
           
    }


?>