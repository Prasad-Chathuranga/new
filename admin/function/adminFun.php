<?php
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        ///////////////////// select admin   ///////////////////////////////
        function ctFun($conn){
                $query="SELECT * FROM `admin` WHERE type='admin'";
                $run = mysqli_query($conn,$query);
                if (mysqli_num_rows($run) > 0) {
                        return $run;
                }
                else{
                        die();
                }
        }

        //////////////////////// insert company type  //////////////////////
        if (isset($_POST["savead"])) {
                $name=mysqli_real_escape_string($conn,$_POST["name"]);
                $email=mysqli_real_escape_string($conn,$_POST["email"]);
                $pass=mysqli_real_escape_string($conn,$_POST["password"]);
                //require_once '../include/encryptor-master/EncryptorClass.php';
                include ('include/encryptor-master/EncryptorClass.php');
                $objEncryptor = new Encryptor($pass);
                $strHash = $objEncryptor->hash;
                $strSalt = $objEncryptor->salt;

                $role=mysqli_real_escape_string($conn,$_POST["role"]);
                $longPath="../accountant/uploadedImages/";
                $upload_directory    = "uploadedImages/";     // define path  
                $filename            = $_FILES["nimage"]["name"];
                $upload_directory   .= $filename;
                $longPath           .= $filename;
                $tmp_dir             = $_FILES["nimage"]["tmp_name"];
                $size                = $_FILES["nimage"]["size"];
                $ext                 = pathinfo($filename,PATHINFO_EXTENSION);
                // echo " <script>alert('$price/$credit/$upload_directory')</script>";

                if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
                {
                        if (move_uploaded_file($tmp_dir,$longPath))
                        {
                                $sql = ("INSERT INTO `admin`(`name`, `email`,`type`,`photo`, `pwd_hash`, `pwd_salt`) 
                                        VALUES ('$name','$email','$role','$upload_directory', '$strHash', '$strSalt')");
                                
                                if (mysqli_query($conn,$sql)) {
                                        echo "<script> 
                                                alert('Data have Been Saved.');
                                        </script>";
                                        echo "<meta http-equiv='refresh' content='0;admins.php'>" ;
                                }
                                else {
                                        echo "<script> alert('Error. Data not Saved')</script>";
                                        // echo "error :".$sql. "<br>". $conn->error;
                                }
                        }
                        else{
                                echo "<script> alert('Error. move upload')</script>";
                        }
                }
                else {
                        echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";
                }
        }

    ////////////////////////// Delete admin   ///////////////////////////////
  
   if (isset($_GET["hhhid"])) {
    $del_id = $_GET["hhhid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM `admin` WHERE id='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {  
      
    echo "<script>alert('Data have been Deleted.');</script>";

    echo "<meta http-equiv='refresh' content='0;admins.php'>" ;

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

    

?>