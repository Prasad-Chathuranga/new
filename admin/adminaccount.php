<?php  
        session_start();
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        $id=$_SESSION["id"];
        include("include/head.php");
        $query="SELECT * FROM `admin`
                WHERE id='$id'";
        $run = mysqli_query($conn,$query);
        $row= mysqli_fetch_array($run);

        //////////////////////// change account  //////////////////////////////////
        if (isset($_POST["changeaccount"]))
        {
                $name=mysqli_real_escape_string($conn,$_POST["name"]);
                $email=mysqli_real_escape_string($conn,$_POST["email"]);
                
                $longPath="../accountant/uploadedImages/";
                $upload_directory = "uploadedImages/";     // define path  
                $filename = $_FILES["nimage"]["name"];
                if ($filename!=null) {
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
                                }
                                else{
                                        echo "<script> alert('Error. move upload')</script>";
                                }
                        }
                        else {
                                echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";
                        }
                        $sql = "UPDATE `admin` SET `name`='$name', `email`='$email',`photo`='$upload_directory' WHERE id='$id'";
                }
                else {
                        $sql = "UPDATE `admin` SET `name`='$name', `email`='$email' WHERE id='$id'";
                }
                if (mysqli_query($conn,$sql)) {
                        echo "<script> 
                                alert('Data have Been Saved.');
                        </script>";
                        echo "<meta http-equiv='refresh' content='0;adminaccount.php'>" ;
                }
                else {
                        echo "<script> alert('Error. Data not Saved')</script>";
                        // echo "error :".$sql. "<br>". $conn->error;
                }
        }

        /////////////////////// chnage password///////////
        if (isset($_POST["changepass"])) {
                $crpass=mysqli_real_escape_string($conn,$_POST["crpass"]);
                $npass=mysqli_real_escape_string($conn,$_POST["npass"]);
                $cfpass=mysqli_real_escape_string($conn,$_POST["cfpass"]);

                include ('include/encryptor-master/EncryptorClass.php');
                $objDecryptor = new Decryptor($crpass, $row['pwd_salt']);
                if($objDecryptor->result==$row['pwd_hash'])
                {
                        if ($npass==$cfpass) {
                                $objEncryptor = new Encryptor($npass);
                                $strHash = $objEncryptor->hash;
                                $strSalt = $objEncryptor->salt;
                                $update_query = "UPDATE admin SET `pwd_hash`='$strHash', `pwd_salt`='$strSalt' WHERE id='$id'";
                                if (mysqli_query($conn,$update_query)) {
                                        echo "<script> alert('Password have been Modify')</script>";
                                        echo "<meta http-equiv='refresh' content='0;adminaccount.php'>" ;
                                }
                                else {
                                        echo "<script> alert('Error. Passowrd not Modify')</script>";
                                        // echo "error :".$sql. "<br>". $conn->error;
                                }
                        }
                }
                else {
                        echo "<script> alert('Error. Current password not matched.')</script>";
                }


                /*if ($row['password'] == $crpass) {
                        if ($npass==$cfpass) {
                                $update_query = "UPDATE admin SET `password`='$npass' WHERE id='$id'";
                                if (mysqli_query($conn,$update_query)) {
                                        echo "<script> alert('Password have been Modify')</script>";
                                        echo "<meta http-equiv='refresh' content='0;adminaccount.php'>" ;
                                }
                                else {
                                        echo "<script> alert('Error. Passowrd not Modify')</script>";
                                        // echo "error :".$sql. "<br>". $conn->error;
                                }
                        }
                        else {
                                echo "<script> alert('Error. New password not equal to confirm password.')</script>";
                        }
                }
                else{
                        echo "<script> alert('Error. Current password not matched.')</script>";
                }*/
        }
?>
  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
        
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">Admin Account <span style="margin-left: 700px;font-weight:none;">Account Type: <?php echo $row["type"];?></span>
          </h1> 
        </div> 
        <div class="mainTable mt-4">
           <div class="row">
            
            <div class="col-lg-4">
            <form action="" method="post" enctype="multipart/form-data">
                  
                  <center><h3> Change Profile</h3></center><br>
                  
                  <div class="form-group">
                      <label for="name">Admin Name:</label>
                      <input name="name" type="text" class="form-control" value="<?php echo $row['name'];?>">
                    </div>
                    <div class="form-group">
                      <label for="contact">Admin Email:</label>
                      <input name="email" type="email" class="form-control" value="<?php echo $row['email'];?>">
                    </div>
              
                    <div class="form-group">
                      <label for="contact">Change Image:</label>
                      <input name="nimage" type="file" class="form-control">
                    </div>
                  <br>
                  <div>
                     <center>
                         <button class="btn modifyBtn btn-success" type="submit" name="changeaccount">
                             Save Change
                         </button>
                     </center>
                 </div>
                 
                 </form>
            </div>
            <div class="col-lg-4">
            <center><h3> Profile Image</h3></center><br>

            <img src="../accountant/<?php echo $row["photo"];?>" class="img-fluid " 
            style=" height: 300px; width: 80%; margin-top:30px; border-radius:16px;" alt="img">

            </div>
            <div class="col-lg-4">
                 <form action="" method="post" enctype="multipart/form-data">
                  
                 <center><h3> Change Password</h3></center><br>
                 
                 <div>
                     <label for="">Current Password</label>
                   <input type="password" class="form-control" name="crpass" required maxlength="35" />
                 </div>
                 <div>
                     <label for="">New Pasword</label><small id="pwdmsg" style="display: none; color:#ca2127">8 Characters, upper and lower case alphabets, digits and special characters</small>
                   <input type="password" class="form-control" name="npass" id="npass" required maxlength="35" />
                 </div>
                 <div>
                     <label for="">Confirm Password</label>
                   <input type="password" class="form-control"  name="cfpass" required maxlength="35" />
                 </div>
                 <br>
                 <div>
                    <center>
                        <button class="btn modifyBtn btn-success" type="submit" name="changepass">
                            Save Change
                        </button>
                    </center>
                </div>
                
                </form>
            </div>
                
           </div>
        </div>
      </div>
    </div>
     <?php include("include/footer.php"); ?>
    <script>
        $('#npass').blur(function(e){
        e.preventDefault();
        var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$");
        var password = $(this).val();
        if (regex.test(password)) {
            //return true;
            $('#pwdmsg').css("display", "none");
        }
        else
        {
            $(this).val("");
            $('#pwdmsg').css("display", "block");
            //alert('Password must be 8 characters long and include at least one upper case letter, one lower case letter, one integer and special character');
            $(this).focus();
        }
    });
    </script>
  </body>
</html>
