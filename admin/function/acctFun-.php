<?php  

///////////////////// select accountant   ///////////////////////////////
function accFun($conn,$sts){
    $query="SELECT * FROM `accountant`
    WHERE ASts='$sts'";
    $run = mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0) {
        return $run;
    }else{
    
       die();
   }  
 }

   ////////////////////////// Delete   ///////////////////////////////
  
   if (isset($_GET["hhid"])) {
    $del_id = $_GET["hhid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM accountant WHERE Aid='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {
  echo "<script>alert('Accountant have been Deleted.');</script>";

  }

  }

//  ///////////////////// Approve the accountant .update query   ///////////////////////////////
if (isset($_POST["approved"])) {
  $id=mysqli_real_escape_string($conn,$_POST["id"]);
  $adid=$_SESSION["id"];
  $sql = "UPDATE accountant SET `ASts`=1, admId='$adid' WHERE Aid='$id'";
  $qury2=mysqli_query($conn, "INSERT INTO total_credits(tcr_amount, tcr_creation, Aid) VALUES (0, now(),'$id')");
  $quryset=mysqli_query($conn, "INSERT INTO setting(Aid) VALUES ('$id')");
 
  if (mysqli_query($conn,$sql) AND $qury2 AND $quryset) {
      echo "<script>alert('the Accountant profile has been approved.');</script>";
      echo "<meta http-equiv='refresh' content='0;accountantRequest.php'>" ;

  }

}
 
 

//   //////////////////////// insert Staff  //////////////////////////////////
   if (isset($_POST["save"])) {
     include('../include/connection.php');
     $name=mysqli_real_escape_string($conn,$_POST["name"]);
     $surname=mysqli_real_escape_string($conn,$_POST["surname"]);
     $email=mysqli_real_escape_string($conn,$_POST["email"]);
     $contact=mysqli_real_escape_string($conn,$_POST["contact"]);
     $address=mysqli_real_escape_string($conn,$_POST["address"]);
     $kvk=mysqli_real_escape_string($conn,$_POST["kvk"]);
     $cid=rand();
     $password=mysqli_real_escape_string($conn,$_POST["password"]);
     $upload_directory= "uploadedImages/IMG_0040.JPG";
     $longPath="../../accountant/uploadedImages/";
     $upload_directory    = "uploadedImages/";     // define path  
         $filename            = $_FILES["simage"]["name"];
         $upload_directory   .= $filename;
         $longPath           .= $filename;
         $tmp_dir             = $_FILES["simage"]["tmp_name"];
         $size                = $_FILES["simage"]["size"];
         $ext                 = pathinfo($filename,PATHINFO_EXTENSION);

         if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
         {
                if (move_uploaded_file($tmp_dir,$longPath)) 
             {   
               ;
         
                 $sql = ("INSERT INTO `accountant`(`Aname`, `Aphone`,`surname`, `Aemail`, `Apassword`, `Aaddress`, `kvknumber`, 
                 `ASts`,`cid` ,`Ai_mg`) VALUES ('$name','$contact','$surname','$email','$password','$address','$kvk',1,'$cid','$upload_directory')");
                 $sql2 = ("INSERT INTO `company` (`cid`, `cname`, `cemail`, `caddress`, `cwebsite`, `cdesc`, `tid`) VALUES ('$cid', '', '', '', '', '', '1')");
                 $oo=mysqli_query($conn,$sql2);

                   if (mysqli_query($conn,$sql)) {
                     echo "<script> 
                     alert('Data have Been Saved.');
                          </script>";
                   echo "<meta http-equiv='refresh' content='0;../accountant.php'>" ;
                   }else {
                     echo "<script> alert('Error. Data not Saved')</script>";
                    
                     echo "error :".$sql. "<br>". $conn->error;
                   }
             }else{
               echo "<script> alert('Error. move upload')</script>";

             }
         }else {
           echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";

         }
// $to = $email; 
// $from = 'sender@example.com'; 
// $fromName = 'Ali Dhaku'; 
 
// $subject = "Your Accountant Setup"; 
 
// $htmlContent = ' 
//     <html> 
//     <head> 
//         <title>Test Email</title> 
//     </head> 
//     <body> 
//         <h1>Thanks you for joining with us!</h1> 
//         <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
//             <tr> 
//                 <th>Name:</th>'.$name.'<td></td> 
//             </tr> 
//             <tr style="background-color: #e0e0e0;"> 
//                 <th>Email:</th><td>'.$email.'</td> 
//             </tr> 
//             <tr> 
//                 <th>Password:</th><td><a>'.$password.'</a></td> 
//             </tr> 
//             <tr> 
//                 <th>Password:</th><td><a>'.$password.'</a></td> 
//             </tr> 
//         </table> 
//     </body> 
//     </html>'; 
 
// // Set content-type header for sending HTML email 
// $headers = "MIME-Version: 1.0" . "\r\n"; 
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// // Additional headers 
// $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
// // Send email 
// if(mail($to, $subject, $htmlContent, $headers)){ 
//     echo "<script> alert('Sending mail on Your Email')</script>"; 
// }else{ 
//    echo "<script> alert('Error.No Sending mail on Your Email')</script>"; 
// }
     }

    //////////////////////// update accountant  //////////////////////////////////
  if (isset($_POST["editstaff"])) {

    $id=mysqli_real_escape_string($conn,$_POST["id"]);
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $contact=mysqli_real_escape_string($conn,$_POST["contact"]);
    $address=mysqli_real_escape_string($conn,$_POST["address"]);
    $kvk=mysqli_real_escape_string($conn,$_POST["kvk"]);
    // $$upload_directory= "uploadedImages/IMG_0040.JPG";
    // $longPath="../accountant/uploadedImages/"; 
    // $upload_directory    = "uploadedImages/";     // define path  
    //     $filename            = $_FILES["simage"]["name"];

    //     if ($filename!=null) {
          
        
    //     $upload_directory   .= $filename;
    //     $longPath           .= $filename;

    //     $tmp_dir             = $_FILES["simage"]["tmp_name"];
    //     $size                = $_FILES["simage"]["size"];
    //     $ext                 = pathinfo($filename,PATHINFO_EXTENSION);

        // if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
        // {
        //        if (move_uploaded_file($tmp_dir,$longPath)) 
        //     {   
        //     //   echo "<script> alert('$dname,$ddesc,$upload_directory')</script>";
         
        //     }else{
        //       echo "<script> alert('Error. move upload')</script>";

        //     }
        // }else {
        //   echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";

        // }
        $sql = "UPDATE accountant SET `Aname`='$name',`Aemail`='$email', `Aphone`='$contact', `Aaddress`='$address', 
        `kvknumber`='$kvk', `Ai_mg`='null' WHERE Aid='$id'";
      

     
        if (mysqli_query($conn,$sql)) {
          echo "<script> 
          alert('Data have Been Changed.');
               </script>";
        echo "<meta http-equiv='refresh' content='0;accountant.php'>" ;
        }else {
        //   echo "<script> alert('Error. Data not Saved')</script>";
          
          echo "error :".$sql. "<br>". $conn->error;
        }
    }
   
   ?>