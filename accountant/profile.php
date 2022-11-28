<?php 
  session_start();
  if (!isset($_SESSION["id"])) {
   echo "<script>window.location.href='login.php'</script>";
 }
require_once("include/head.php") ?>
  <body>
    <!-- Header navbar-->
     <?php
       require_once("include/navbar.php");
       $id = $_SESSION["id"];
      // echo "<script>alert('$id')</script>";
       $tid='';
    //  $name='';
    //  $email='';
    //  $address='';
    //  $desc='';
    //  $web ='';
      $query="SELECT * FROM `accountant`
      WHERE Aid='$id'";
      $run = mysqli_query($conn,$query);
       
      $row= mysqli_fetch_array($run);
      if(!empty($row['tid'])){
        $tid=$row['tid'];
        // $name=$row['cname'];
        // $email=$row['cemail'];
        // $address=$row['caddress'];
        // $desc=$row['cdesc'];
        // $web=$row['cwebsite'];
        // $cid=$row['cid'];
      }
       
       if (isset($_POST["save"])) {
        
        $name=mysqli_real_escape_string($conn,$_POST["name"]);
        $number=mysqli_real_escape_string($conn,$_POST["number"]);
        $address=mysqli_real_escape_string($conn,$_POST["address"]);
        $kvk=mysqli_real_escape_string($conn,$_POST["kvk"]);
        $upload_directory='';

           if (isset($_POST["upimg"])) {
            $upload_directory = $_POST["upimg"];
           } else {
                 $upload_directory    = "uploadedImages/";     // define path  
        $filename            = $_FILES["nimage"]["name"];

       
        $upload_directory   .= $filename;
        $tmp_dir             = $_FILES["nimage"]["tmp_name"];
        $size                = $_FILES["nimage"]["size"];
        $ext                 = pathinfo($filename,PATHINFO_EXTENSION);
      // echo " <script>alert('$price/$credit/$upload_directory')</script>";

        if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
        {
              if (move_uploaded_file($tmp_dir,$upload_directory)) 
            {  

        

        }else{
          echo "<script> alert('Error. move upload')</script>";

        }
    }else {
      echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";

    }
           }       

        
        // $company=$_POST["company"];
       

    $update_query = "UPDATE accountant SET `Aname`='$name', `Aphone`='$number', `Aaddress`='$address', 
        `kvknumber`='$kvk', `Ai_mg`='$upload_directory' 
                            WHERE Aid='$id'";
          
          if (mysqli_query($conn,$update_query)) {
            echo "<script> alert('Data have been Modify')</script>";

          echo "<meta http-equiv='refresh' content='0;profile.php'>" ;
          }else {
            echo "<script> alert('Error. Data not Saved')</script>";
            
            // echo "error :".$sql. "<br>". $conn->error;
          }
       }

       // change password
       if (isset($_POST["changepass"])) {

        $crpass=mysqli_real_escape_string($conn,$_POST["crpass"]);
        $npass=mysqli_real_escape_string($conn,$_POST["npass"]);
        $cfpass=mysqli_real_escape_string($conn,$_POST["cfpass"]);
       
        if ($row['Apassword'] == $crpass) {
          if ($npass==$cfpass) {
               $update_query = "UPDATE accountant SET `Apassword`='$npass' WHERE Aid='$id'";
              
              if (mysqli_query($conn,$update_query)) {
                echo "<script> alert('Password have been Modify')</script>";

              echo "<meta http-equiv='refresh' content='0;profile.php'>" ;
              }else {
                echo "<script> alert('Error. Passowrd not Modify')</script>";
                
                // echo "error :".$sql. "<br>". $conn->error;
              }
          }else {
            echo "<script> alert('Error. New password not equal to confirm password.')</script>";

          }
        }else{
          echo "<script> alert('Error. Current password not matched.')</script>";

        }
        
       

       }
     ?>
    <!-- main -->
    <main>
      <div class="container">
        <div class="row">
          <div class="col-lg-2 order-lg-0 order-2">
            <div class="card">
              <div class="cardTextTop">
                You have <span>
                <?php  
                      $querytc="SELECT * FROM `total_credits`
                      WHERE Aid= '$id'";
                      $runtc = mysqli_query($conn,$querytc);
                      $rowtc = mysqli_fetch_array($runtc);
                         if (empty($rowtc["tcr_amount"])) {
                           echo "No";
                         } else {
                            echo $rowtc["tcr_amount"];
                         }
                            
                     
                    ?>  
                credits</span> available for use
              </div>
              <div>

                <a href="buycredit.php" class="btn creditsBtn">
                  Buy Credits</a>
              </div>
              <hr />
              <div class="contact">
                <div class="contactText">Your contact</div>
                  <?php 
                      
                      $sq="SELECT * FROM `accountant` WHERE Aid='$id'";
                      $runn=mysqli_query($conn,$sq);
                      $roww=mysqli_fetch_array($runn);
                      $to=$roww['admId'];
                     
                      $sq3="SELECT * FROM `admin` WHERE id='$to'";
                      $runn3=mysqli_query($conn,$sq3);
                      $roww3=mysqli_fetch_array($runn3); 
                       ?>
                <div class="contactPerson">
                  <div>
                  <img src="./<?php echo $roww3['photo']; ?>" alt="sdsad" class="img-fluid" style="border-radius: 5px;"/>
                  </div>
                  <div>
                  <div class="fontSmall">
                        
                     <p><?php echo $roww3['name']; ?></p>
                    </div>
                    <div class="fontSmall textColor"> <?php echo $roww3['mobileNo']; ?></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card p0">
                 <?php 
                $sql9 = "SELECT * FROM `advertisement` WHERE status = 1 ORDER BY RAND() LIMIT 1";
                $run9 = mysqli_query($conn,$sql9);
                
                if(mysqli_num_rows($run9)>0)
                {
                        $row9= mysqli_fetch_array($run9);
                        ?>
                        <div class="card p0">
                
              <img src="./<?php echo $row9['image'] ?>" class="img-fluid" alt="" />
              <div class="paddingAll">
                <div class="cardText">
                 <?php echo $row9['description'] ?>
                </div>
               
              </div>
            </div>
                        <?php
                }
                else{
                        ?>
                        <div class="card p0">
                
              <div class="paddingAll">
                <div class="cardText">
                 No Ad set
                </div>
               
              </div>
            </div>
                        <?php
                }
                
                
                ?>
            </div>
          </div>
          <div class="col-lg-10 order-lg-0 order-1">
            <div class="company">
              <div class="companyHeading">
                <h2>My Profile</h2>
              </div>
              <div class="row g-4">
                <div class="col-lg-8">
                 <form action="" method="post" enctype="multipart/form-data">
                  <div>
                  <label for="">Email Address</label>
                    <input
                      type="text"
                      class="form-control"
                      value="<?php echo $row['Aemail']; ?>"
                      disabled
                    />
                  </div>
                  <div>
                      <label for=""> Name</label>
                    <input
                      type="text" name="name" required
                      class="form-control" maxlength="40"
                      value="<?php echo $row['Aname']; ?>"
                    />
                  </div>
                  
                  <div>
                      <label for="">Contact Number</label>
                    <input
                      type="text" name="number" required
                      class="form-control" maxlength="15"
                      value="<?php echo $row['Aphone']; ?>"
                    />
                  </div>
                  <div>
                      <label for="">Address</label>
                    <input
                      type="text" name="address" required
                      class="form-control" maxlength="150"
                      value="<?php echo $row['Aaddress']; ?>"
                    />
                  </div>
                  <div>
                      <label for="">KVK Number</label>
                    <input
                      type="text" name="kvk" required
                      class="form-control" maxlength="20"
                      value="<?php echo $row['kvknumber']; ?>"
                    />
                  </div>
                  
                  <?php 
                      if (empty($row['Ai_mg']) ) {
                      ?>
                       <div>
                        <label for="">Upload image it will be not changable.</label>
                                              <input type="file" class="form-control" name="nimage" id="pwd">
                                         
                                          </div>
                   <?php
                      }else{
                        echo "<input type='text' value='".$row['Ai_mg']."' name='upimg' hidden> ";
                      }
                   ?>
                     
                  <!-- <div>
                      <label for="">Company Type</label>
                      <select name="company" class="form-control" id="dept">              
                        <option value="" disabled> Select Company</option> 
                        <option value="" > Null</option>   
  
                            <?php 

                            //    $query_com="SELECT * FROM `companytype`";
                            //    $run_com = mysqli_query($conn,$query_com);
                            //     while ($row_com = mysqli_fetch_array($run_com)) {

                            ?>
                                <option value="<?php 
                                // echo $row_com['tid']; 
                                ?>" <?php 
                                // if($row_com['tid']==$tid){ echo "SELECTED"; } 
                                 ?> ><?php 
                                //  echo $row_com['ctype']; 
                                 ?></option>
                            <?php 
                            //   } 
                              ?>
                        </select>
                  </div> -->
                  <br>
                  <div >
                        <button class="btn modifyBtn btn-success" type="submit" name="save">
                        <span>
                            <i class="fa-solid fa-pen"></i>
                        </span>
                        Modify
                        </button>
                 </div>
                </div>
                </form>
                <div class="col-lg-1"></div>
                <!--<div class="col-lg-3" style="margin-top:20px;">-->
                <!--  <form action="" method="post">-->
                <!--  <center><h5> Change Password</h5></center><br>-->
                 
                <!--  <div>-->
                <!--      <label for="">Current Password</label>-->
                <!--    <input type="password" class="form-control" name="crpass" required maxlength="35" />-->
                <!--  </div>-->
                <!--  <div>-->
                <!--      <label for="">New Pasword</label>-->
                <!--    <input type="password" class="form-control" name="npass" required maxlength="35" />-->
                <!--  </div>-->
                <!--  <div>-->
                <!--      <label for="">Confirm Password</label>-->
                <!--    <input type="password" class="form-control"  name="cfpass" required maxlength="35" />-->
                <!--  </div>-->
                <!--  <br>-->
                <!--  <div>-->
                <!--    <button class="btn modifyBtn btn-success" type="submit" name="changepass">-->
                <!--    <span>-->
                <!--        <i class="fa-solid fa-pen"></i>-->
                <!--    </span>-->
                <!--     Modify Password-->
                <!--    </button>-->
                <!--</div>-->
                <!--</form>-->
                <!--</div>-->
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
