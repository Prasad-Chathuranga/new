<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php");  
	 $adid=$_SESSION["id"];
    //  include("function/jobFun.php");  
      //   //////////////////////// Approve the Job  //////////////////////////////////
 if (isset($_POST["editjob"])) {

  $id=mysqli_real_escape_string($conn,$_POST["id"]);
  $name=mysqli_real_escape_string($conn,$_POST["name"]);  
  $salary=mysqli_real_escape_string($conn,$_POST["salary"]);
  $city=mysqli_real_escape_string($conn,$_POST["city"]);

  $credit=mysqli_real_escape_string($conn,$_POST["credit"]);
  $sdate=mysqli_real_escape_string($conn,$_POST["sdate"]);
  $ldate=mysqli_real_escape_string($conn,$_POST["ldate"]);
  $descBef=mysqli_real_escape_string($conn,$_POST["descBef"]);
  $descAft=mysqli_real_escape_string($conn,$_POST["descAft"]);
  $company=mysqli_real_escape_string($conn,$_POST["cname"]);
  $email=mysqli_real_escape_string($conn,$_POST["email"]);

  $web=mysqli_real_escape_string($conn,$_POST["web"]);
  $checkbox1=$_POST['typeofbusiness'];
  $flexRadioDefault = $_POST['flexRadioDefault'];
  $gender = $_POST['gender'];
   $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
	 $street = $_POST['street'];
	  $postal = $_POST['postal'];
	   $phone = $_POST['phone'];
  $chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   } 
  // echo "<script> alert('$name/$email/$contact/$address/$desc/$company')</script>";

              $sql ="UPDATE `job` SET 
               `Jtitle`='$name', `Jsalary`='$salary',
              `JdesBef`='$descBef',`jdesAft`='$descAft',`city`='$city',
              `Jcredits`='$credit',`startDate`='$sdate',
              `endDate`='$ldate',`company`='$company',`email`='$email',
             `website`='$web', `business_form` ='$flexRadioDefault',`type of work` = '$chk', `gender` = '$gender',`firstname` = '$firstname',`lastname` = '$lastname',
			  `street` = '$street', `postal` = '$postal', `phone` = '$phone' 
			 WHERE Jid='$id'";
             
                if (mysqli_query($conn,$sql)) {
                      echo "<script> 
                      alert('Job has been Updated.');
                        </script>";
                echo "<meta http-equiv='refresh' content='0;job.php'>" ;
                }else {
                  echo "<script> alert('Error. Data not Saved')</script>";
                  
                  // echo "error :".$sql. "<br>". $conn->error;
                }
}
?>
<?php  if (isset($_POST["approve"])) {
     
  $id=mysqli_real_escape_string($conn,$_POST["id"]);
 
  $descAft=mysqli_real_escape_string($conn,$_POST["descAft"]);
    $credit=mysqli_real_escape_string($conn,$_POST["credit"]);
  $sql ="UPDATE `job` SET 
               `Jcredits`='$credit',`jdesAft`='$descAft',`JSts`=1,`admId`='$adid' WHERE Jid='$id'";
             
                if (mysqli_query($conn,$sql)) {
                      echo "<script> 
                      alert('Job Approved Successfully.');
                        </script>";
                echo "<meta http-equiv='refresh' content='0;job.php'>" ;
                }else {
                  echo "<script> alert('Error. Data not Saved')</script>";
                  
                  // echo "error :".$sql. "<br>". $conn->error;
                }
  
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
          <h1 class="mainHeading mr-5">Change Job Details.</h1>

        </div> 
        <div class="mainTable mt-4">
          <?php
include 'include/connection.php';  
$id=$_GET['jded'];
$sql = "SELECT * FROM `job` WHERE Jid='".$id."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       
   $worktype=$row["type of work"];
   $work = explode(",",$worktype);
  
	
                                    ?>
        <form action="" method="post" enctype="multipart/form-data">
		 <div class="row mb-5">
          <div class="col-md-4">
		  
		      <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="Particulier"
                        id="flexRadioDefault1"
						<?php if($row['business_form']=="Particulier"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault1"
                      >
                        Particulier
                      </label>
                    </div>
					
					   <div class="form-check formCheck">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="ZZP/Eenmanszaak"
                        id="flexRadioDefault2"
						<?php if($row['business_form']=="ZZP/Eenmanszaak"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault2"
                      >
                        ZZP/Eenmanszaak
                      </label>
                    </div>
					 </div>
					  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="V.O.F"
                        id="flexRadioDefault3"
						<?php if($row['business_form']=="V.O.F"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault3"
                      >
                        V.O.F.
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="B.V"
                        id="flexRadioDefault4"
						<?php if($row['business_form']=="B.V"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault4"
                      >
                        B.V.
                      </label>
                    </div>
                 </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="Stichting/Vereniging"
                        id="flexRadioDefault5"
						<?php if($row['business_form']=="Stichting/Vereniging"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault5"
                      >
                        Stichting/Vereniging
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="Maatschap"
                        id="flexRadioDefault6"
							<?php if($row['business_form']=="Maatschap"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault6"
                      >
                        Maatschap
                      </label>
                    </div>
                  
                </div>
				</div>
				  <div class="row mb-5">
                  <div class="col-12">
                    <h6>Type werkzaamheden *</h6>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input 
					
					 
                        class="checkboxInput form-check-input"
                        type="checkbox"
						name="typeofbusiness[]"
                        value="Aangifte inkomstenbelasting"
                        id="flexCheckDefault1"
						  <?php if(in_array("Aangifte inkomstenbelasting",$work))
					  {
						  echo "checked";
					  } ?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault1"
                      >
                        Aangifte inkomstenbelasting
                      </label>
                    </div>
                    <div class="form-check formCheck mb">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                       	name="typeofbusiness[]"
                        value="Aangifte omzetbelasting btw"
                        id="flexCheckDefault2"
						  <?php if(in_array("Aangifte omzetbelasting btw",$work))
					  {
						  echo "checked";
					  } ?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault2"
                      >
                        Aangifte omzetbelasting (btw)
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
					    <?php if(in_array("Aangifte",$work))
					  {
						  echo "checked";
					  } ?>
                        class="checkboxInput form-check-input"
                        type="checkbox"
                         name="typeofbusiness[]"
                        value="Aangifte"
                        id="flexCheckDefault2"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault2"
                      >
                        Aangifte
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
					      <?php if(in_array("Volledige boekhouding",$work))
					  {
						  echo "checked";
					  } ?>
                        class="checkboxInput form-check-input"
                        type="checkbox"
                          name="typeofbusiness[]"
                        value="Volledige boekhouding"
                        id="flexCheckDefault3"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault3"
                      >
                        Volledige boekhouding
                      </label>
                    </div>
                    <div class="form-check formCheck mb">
                      <input
					       <?php if(in_array("Toezicht op de boekhouding",$work))
					  {
						  echo "checked";
					  } ?>
                        class="checkboxInput form-check-input"
                        type="checkbox"
                           name="typeofbusiness[]"
                        value="Toezicht op de boekhouding"
                        id="flexCheckDefault4"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault4"
                      >
                        Toezicht op de boekhouding
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input       <?php if(in_array("Jaarrekening",$work))
					  {
						  echo "checked";
					  } ?>
					  
                        class="checkboxInput form-check-input"
                        type="checkbox"
                          name="typeofbusiness[]"
                        value="Jaarrekening"
                        id="flexCheckDefault4"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault4"
                      >
                        Jaarrekening
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input      <?php if(in_array("Accountantsverklaring",$work))
					  {
						  echo "checked";
					  } ?>
                        class="checkboxInput form-check-input"
                        type="checkbox"
                            name="typeofbusiness[]"
                        value="Accountantsverklaring"
                        id="flexCheckDefault5"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault5"
                      >
                        Accountantsverklaring
                      </label>
                    </div>
                    <div class="form-check formCheck mb">
                      <input      <?php if(in_array("Salarisadministratie",$work))
					  {
						  echo "checked";
					  } ?>
                        class="checkboxInput form-check-input"
                        type="checkbox"
                           name="typeofbusiness[]"
                        value="Salarisadministratie"
                        id="flexCheckDefault6"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault6"
                      >
                        Salarisadministratie
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input  
					   <?php if(in_array("Anders Toelichten bij opdrachtbeschrijving",$work))
					  {
						  echo "checked";
					  } ?>
                        class="formCheckInput checkboxInput form-check-input"
                        type="checkbox"
                          name="typeofbusiness[]"
                        value="Anders Toelichten bij opdrachtbeschrijving"
                        id="flexCheckDefault6"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault6"
                      >
                        Anders (Toelichten bij opdrachtbeschrijving)
                      </label>
                    </div>
                  </div>
                </div>
          <div class="form-group">
            <label for="">JOb Title</label>
            <input name="name" type="text" class="form-control" placeholder="Enter JOb Title" value="<?php echo $row["Jtitle"]; ?>"   required>
          </div>
          <div class="d-flex">
                <div class="form-group w-50">
                    <input type="hidden" name="id" value="<?php echo $row["Jid"]; ?>">
                    <label for=""> change Job Salary</label>
                     <select name="salary" class="form-control" required>               
                        <option  disabled> Select Job Salary</option> 
                        <option value="Unknown" <?php if("Unknown"==$row['Jsalary']){ echo "SELECTED"; } ?>>Unknown</option>
                        <option value="€0.00-€50.000" <?php if("€0.00-€50.000"==$row['Jsalary']){ echo "SELECTED"; } ?>>€0.00-€50.000</option>
                        <option value="€50.000-€100.000" <?php if("€50.000-€100.000"==$row['Jsalary']){ echo "SELECTED"; } ?>>€50.000-€100.000</option>
                        <option value="€100.00-€250.000" <?php if("€100.00-€250.000"==$row['Jsalary']){ echo "SELECTED"; } ?>>€100.00-€250.000</option>
                        <option value="€250.00-€500.000" <?php if("€250.00-€500.000"==$row['Jsalary']){ echo "SELECTED"; } ?>>€250.00-€500.000</option>
                        <option value="500.000+" <?php if("500.000+"==$row['Jsalary']){ echo "SELECTED"; } ?>>500.000+</option>
    
                     </select>
                </div>
                <div class="form-group w-50">
                   <label for="">Job City</label>
                    <input name="city" type="text" class="form-control" value="<?php echo $row["city"]; ?>" placeholder="Enter Job City"  required>
                </div>
          </div>
          <div class="d-flex">
               
                <div class="form-group w-50">
                    <label for="">Job Credits</label>
                    <input name="credit" type="text" class="form-control" value="<?php echo $row["Jcredits"]; ?>" placeholder="Enter Job Credits" required>
                </div>
         </div>
          <div class="d-flex">
                <div class="form-group w-50">
                    <label for="date">Start Date Of Job</label>
                    <input name="sdate" type="date" class="form-control" value="<?php echo $row["startDate"]; ?>" required>
                </div>
                <div class="form-group w-50">
                    <label for="date">End Date Of Job</label>
                    <input name="ldate" type="date" class="form-control" value="<?php echo $row["endDate"]; ?>"  required>
                </div>
          </div>
          <div class="form-group">
            <label for=""> Job Description Before Job bought. </label>
                    <textarea  name="descBef" required
                      class="form-control" style="height:100px;"><?php echo $row["JdesBef"]; ?></textarea>
          </div>

          <div class="form-group">
            <label for=""> Job Description After Job bought. </label>
                    <textarea  name="descAft" required
                      class="form-control" style="height:100px;"><?php echo $row["jdesAft"]; ?></textarea>
          </div>
		   <div class="col-md-4">
		  
		      <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="gender"
						value="Male"
                        id="flexRadioDefault1"
						<?php if($row['gender']=="Male"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault1"
                      >
                       Male
                      </label>
                    </div>
					
					   <div class="form-check formCheck">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="gender"
						value="Female"
                        id="flexRadioDefault2"
						<?php if($row['gender']=="Female"){ echo "checked";}?>
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault2"
                      >
                        Female
                      </label>
                    </div>
					 </div>
					    <div class="d-flex">
                <div class="form-group w-50">
                    <label for="">Firstname</label>
                    <input name="firstname" type="text" class="form-control" value="<?php echo $row["firstname"]; ?>" placeholder="Enter Job Distance" required>
                </div>
                <div class="form-group w-50">
                    <label for="">Lastname</label>
                    <input name="lastname" type="text" class="form-control" value="<?php echo $row["lastname"]; ?>" placeholder="Enter Job Credits" required>
                </div>
         </div>
		 	    <div class="d-flex">
                <div class="form-group w-50">
                    <label for="">Street</label>
                    <input name="street" type="text" class="form-control" value="<?php echo $row["street"]; ?>" placeholder="Enter Job Distance" required>
                </div>
                <div class="form-group w-50">
                    <label for="">Postal</label>
                    <input name="postal" type="text" class="form-control" value="<?php echo $row["postal"]; ?>" placeholder="Enter Job Credits" required>
                </div>
			
         </div>
          <div class="d-flex">
                <div class="form-group w-50">
                    <label for="">Company</label>
                    <input name="cname" type="text" class="form-control" value="<?php echo $row["company"]; ?>" placeholder="Enter Job Distance" required>
                </div>
                <div class="form-group w-50">
                    <label for="">Email</label>
                    <input name="email" type="email" class="form-control" value="<?php echo $row["email"]; ?>" placeholder="Enter Job Credits" required>
                </div>
         </div>
         <div class="d-flex">
                <div class="form-group w-50">
                    <label for="">Phone</label>
                    <input name="phone" type="text" class="form-control" value="<?php echo $row["phone"]; ?>" placeholder="Enter Job Distance" required>
                </div>
                <div class="form-group w-50">
                    <label for="">Website</label>
                    <input name="web" type="text" class="form-control" value="<?php echo $row["website"]; ?>" placeholder="Enter Website" required>
                </div>
         </div>
          <button type="submit" name="editjob" class="btn btn-primary mt-3">Save Change</button>   <button type="submit" name="approve" class="btn btn-primary mt-3">Approve </button>
        </form>
        <?php  
}
}

        ?>
        </div>
      </div>
    </div>
     <?php include("include/footer.php"); ?>
  

  </body>
</html>
