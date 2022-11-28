<?php 
  session_start();
  if (!isset($_SESSION["id"])) {
   echo "<script>window.location.href='login.php'</script>";
 }
require_once("include/head.php"); ?>
<style>
  .dispdata {
	margin-bottom: 0.4 rem;
	padding-top: 0.375rem;
	padding-right: 0.75rem;
	padding-bottom: 0.375rem;
    	padding-left: 0.75rem;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.5;
}
</style>
  <body>
    <!-- Header navbar-->
     <?php require_once("include/navbar.php"); 
     $id = $_SESSION["id"];
     $tid='';
     $name='';
     $email='';
     $address='';
     $desc='';
     $web ='';
      $query="SELECT * FROM `accountant`
      JOIN company ON accountant.cid=company.cid
      JOIN companytype ON company.tid=companytype.tid
      WHERE Aid='$id'";
      $run = mysqli_query($conn,$query);
       
      $row= mysqli_fetch_array($run);
      if(!empty($row['tid'])){
        $tid=$row['tid'];
        $name=$row['cname'];
        $email=$row['cemail'];
        $address=$row['caddress'];
        $desc=$row['cdesc'];
        $web=$row['cwebsite'];
        $cid=$row['cid'];
      }

      // insert data 

        if (isset($_POST["save"])) {
          // $tid=mysqli_real_escape_string($conn,$_POST["name"]);
          $name=mysqli_real_escape_string($conn,$_POST["name"]);
          $email=mysqli_real_escape_string($conn,$_POST["email"]);
          $address=mysqli_real_escape_string($conn,$_POST["address"]);
          //$desc=mysqli_real_escape_string($conn,$_POST["desc"]);
          $web=mysqli_real_escape_string($conn,$_POST["web"]);
          $ctype=mysqli_real_escape_string($conn,$_POST["ctype"]);
          //$comt=mysqli_real_escape_string($conn,$_POST["company"]);
           $imageUrl=$_FILES["aimg"]["name"];
           $folder = "uploadedImages/".$imageUrl;
           move_uploaded_file($_FILES['aimg']['tmp_name'],$folder);
          $insert_query = "INSERT INTO `company`(`cname`, `cemail`, `caddress`, `cwebsite`,`cLogo`,`ctype`) VALUES 
          ('$name','$email','$address','$web','$folder','$ctype')";
          $data=$conn->query($insert_query);
             
             $last_id = $conn->insert_id;

          $update_query = "UPDATE accountant SET cid='$last_id', cstatus='yes' WHERE Aid='$id'";
          $data=$conn->query($update_query);
          if ($data === TRUE) {
          echo " <script>alert('data Save Succesfully.')</script>";
          echo "<meta http-equiv='refresh' content='0;business.php'>";


          }else{
            echo " <script>alert('data not saved.')</script>";

          }
        }

         // update data 

         if (isset($_POST["update"])) {
          // $tid=mysqli_real_escape_string($conn,$_POST["name"]);
          $name=mysqli_real_escape_string($conn,$_POST["name"]);
          $email=mysqli_real_escape_string($conn,$_POST["email"]);
          $address=mysqli_real_escape_string($conn,$_POST["address"]);
          $desc=mysqli_real_escape_string($conn,$_POST["desc"]);
          $web=mysqli_real_escape_string($conn,$_POST["web"]);
          $vat=mysqli_real_escape_string($conn,$_POST["vat"]);
          $ctype=mysqli_real_escape_string($conn,$_POST["ctype"]);
          $imageUrl=$_FILES["aimg"]["name"];
          //$comt=mysqli_real_escape_string($conn,$_POST["company"]);
          $queryo="SELECT * FROM `accountant`
      WHERE Aid='$id'";
      $runo = mysqli_query($conn,$queryo);
       
      $rowo= mysqli_fetch_array($runo);
      
       
        $cid=$rowo['cid'];
        if ($imageUrl=='') {
          $insert_query = "UPDATE `company` SET `cname` = '$name', `cemail` = '$email', `caddress` = '$address', `cwebsite` = '$web', `cdesc` = 'hello',`ctype` = '$ctype',`vat` = '$vat' WHERE `company`.`cid` = $cid";
             
          
          if (mysqli_query($conn,$insert_query)) {
          echo " <script>alert('data have been Modify.')</script>";
          echo "<meta http-equiv='refresh' content='0;business.php'>";

          }else{
            echo " <script>alert('data not Modify.')</script>";

          }
         
        }else{
          $folder = "uploadedImages/".$imageUrl;
    move_uploaded_file($_FILES['aimg']['tmp_name'],$folder); 
          $insert_query = "UPDATE `company` SET `cname` = '$name', `cemail` = '$email', `caddress` = '$address', `cwebsite` = '$web', `cdesc` = 'hello',`cLogo`='$folder',`ctype` = '$ctype',`vat` = '$vat' WHERE `company`.`cid` = $cid";
             
          
          if (mysqli_query($conn,$insert_query)) {
          echo " <script>alert('data have been Modify.')</script>";
          echo "<meta http-equiv='refresh' content='0;business.php'>";

          }else{
            echo " <script>alert('data not Modify.')</script>";

          }
          
        }
        }
     ?>
    <!-- main -->
    <main>
      <script></script>
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-2 order-lg-0 order-2">
            <!-- <div class="card p0" style="visibility:hidden">
              <div class="cardTopBg">
                <span>Business</span>
              </div>
              <div class="cardLink">
                <ul>
                  <li>
                    <a href="">Overview</a>
                  </li>
                  <li>
                    <a href="">Contact</a>
                  </li>
                  <li>
                    <a href="">Subsidiaries</a>
                  </li>
                </ul>
              </div>
            </div> -->
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

                      $admId=$_SESSION['admId'];
                     
                      $sq3="SELECT * FROM `admin` WHERE id='$admId'";
                      $runn3=mysqli_query($conn,$sq3);
                      if(mysqli_num_rows($runn3)>0)
                      {
                        $roww3=mysqli_fetch_array($runn3); 
                        ?>
                        <div class="contactPerson">
                                <div>
                                        <?php
                                                if(trim($roww3['photo'])!="")
                                                {
                                                        ?>
                                                        <img src="./<?php echo $roww3['photo']; ?>" alt="sdsad" class="img-fluid" style="border-radius: 5px;"/>
                                                        <?php
                                                }
                                        ?>
                                </div>
                                <div>
                                        <div class="fontSmall">
                                                <p>
                                                        <?php
                                                                if(isset($roww3['name']) && trim($roww3['name'])!="")
                                                                {
                                                                        echo $roww3['name'];
                                                                }
                                                        ?>
                                                </p>
                                        </div>
                                        <div class="fontSmall textColor">
                                                <?php
                                                        if(isset($roww3['mobileNo']) && trim($roww3['mobileNo'])!="")
                                                        {
                                                                echo $roww3['mobileNo'];
                                                        }
                                                ?>
                                        </div>
                                </div>
                        </div>
                        <?php
                      }
                      
                       ?>
              </div>
            </div>
          
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
          <div class="col-lg-10 order-lg-0 order-1">
            <div class="company">
              <div class="companyHeading">
                <h2>My company</h2>
              </div>
              <form method="post" action="" enctype="multipart/form-data">
              <?php 
              $query34="SELECT accountant.*,company.cname,company.cemail,company.caddress,company.cwebsite,company.cLogo,company.ctype,company.vat,company.cdesc,company.place,company.postal_code,company.street,company.house_number,company.kvk_accountant FROM accountant
                    left JOIN company ON accountant.cid=company.cid
                    left JOIN companytype ON company.tid=companytype.tid
                    WHERE Aid='$id'";
              $ru = mysqli_query($conn,$query34);
              $ro= mysqli_fetch_array($ru); 
              //print_r($ro);
              ?>
              <div class="row g-4">
                <div class="col-lg-6">
                  <div class="row g-0 borderBottom">
                    <div class="col-6">
                      <div class="fontSize">Company Name</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" name="name" class="form-control" placeholder="Company Name" value="<?php echo $ro['cname'] ?>">*/ ?>
                      <?php echo $ro['cname']; ?>
                    </div>
                  </div>
                  <div class="row g-0 borderBottom">
                    <div class="col-6 dispdata">
                      <div class="fontSize">Email</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo $ro['cemail'] ?>">*/?>
                      <?php echo $ro['cemail']; ?>
                    </div>
                    
                  </div>
                  <div class="row g-0 borderBottom">
                    <div class="col-6 dispdata">
                      <div class="fontSize">Phone</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="number" class="form-control" placeholder="Phone" value="<?php echo $ro['Aphone'] ?>" name="phone">*/ ?>
                      <?php echo $ro['Aphone']; ?>
                    </div>
                  </div>
             
                  <div class="row g-0 borderBottom">
                    <div class="col-6 dispdata">
                      <div class="fontSize">Website</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="url" class="form-control" name="web" placeholder="Website" value="<?php echo $ro['cwebsite'] ?>">*/?>
                      <?php echo $ro['cwebsite']; ?>
                    </div>
                  </div>
				   <div class="row g-0 borderBottom">
                    <div class="col-6 dispdata">
                      <div class="fontSize">VAT</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" class="form-control" name="vat" placeholder="VAT" value="<?php echo $ro['vat'] ?>">*/ ?>
                      <?php echo $ro['vat']; ?>
                    </div>
            </div>
            <div class="row g-0 borderBottom">
                    <div class="col-6 dispdata">
                      <div class="fontSize">KVK No</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" class="form-control" name="kvk" value="<?php echo $ro["kvk_accountant"]; ?>">*/ ?>
                      <?php echo $ro["kvk_accountant"]; ?>
                    </div>
                  </div>
				  
                  <div class="row g-0">
                    <div class="col-6 dispdata">
                      <?php /*<input type="file" class="form-control" placeholder="Logo" name="aimg" accept="image/*">*/?>
                    </div>
                    <div class="col-6">
                      <div class="mt-3">
                        <img src="./<?php echo $ro['cLogo'] ?>" class="img-fluid" alt="" />
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row g-0 borderBottom">
                    <div class="col-6">
                      <div class="fontSize">Business type</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" class="form-control" placeholder="Type" value="<?php echo $ro["ctype"] ?>">*/ ?>
                      <?php echo $ro["ctype"]; ?>
                    </div>
                  </div>
				    <div class="row g-0 borderBottom">
                    <div class="col-6">
                      <div class="fontSize">Place</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" class="form-control" placeholder="Place" value="<?php echo $ro["place"] ?>">*/ ?>
                      <?php echo $ro["place"]; ?>
                    </div>
                    
                  </div>
				      <div class="row g-0 borderBottom">
                    <div class="col-6">
                      <div class="fontSize">Postal code</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}" class="form-control" placeholder="Postal code" value="<?php echo $ro["postal_code"] ?>">*/ ?>
                      <?php echo $ro["postal_code"]; ?>
                    </div>
                    
                  </div>
				    <div class="row g-0 borderBottom">
                    <div class="col-6">
                      <div class="fontSize">Street</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" class="form-control" placeholder="Street" value="<?php echo $ro["street"] ?>">*/ ?>
                      <?php echo $ro["street"]; ?>
                    </div>
                    
                    
                  </div>
				      <div class="row g-0 borderBottom">
                    <div class="col-6">
                      <div class="fontSize">House No</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="number" class="form-control" placeholder="Houseno" value="<?php echo $ro["house_number"]; ?>">*/ ?>
                      <?php echo $ro["house_number"]; ?>
                    </div>
                    
                  </div>
				    <div class="row g-0 borderBottom">
                    <div class="col-6">
                      <div class="fontSize">Description</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" class="form-control" placeholder="description" value="<?php echo $ro["cdesc"] ?>">*/ ?>
                      <?php echo $ro["cdesc"]; ?>
                    </div>
                    
                  </div>
                 
                  <div class="row g-0">
                    <div class="col-6">
                      <div class="fontSize">Accountant</div>
                    </div>
                    <div class="col-6 dispdata">
                      <?php /*<input type="text" class="form-control" placeholder="Sector" value="Accountant">*/ ?>
                      Accountant
                    </div>
                    
                  </div>
                 
                  
                </div>
				
              </div>
			     <div class="row g-0 borderBottom">
                    
                    
                  </div>
              <div class="my-4">
               
              </div>
              <div class="mb-4">
               
              </div>
              <div>
                <?php //if ($ro['cstatus']=='yes') { ?>
                
                  <span>
                         <!-- <input type="submit" name="update" value="Modify"> -->
                         <a class="btn btn-primary" href="<?php echo "business_edit.php?id=".$ro["Aid"].""; ?>"><i class="fa-solid fa-pen"></i>&nbsp;Modify</a>
                    </i>
                  </span>
                <?php /*}else{ ?>
 <span>
                    <i class="fa-solid fa-pen">
                         <input type="submit" name="save" value="Modify">
                    </i>
                  </span>
                <?php }*/ ?>
                
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
