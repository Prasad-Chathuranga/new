<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php");  
     $sql="SELECT * FROM `advertisement`"; 
     $run=mysqli_query($conn,$sql);
     
     
     if (isset($_GET["hhid"])) {
    $del_id = $_GET["hhid"];
    // $del_id2 = $_GET["cid"];
  
    $query="DELETE FROM  `advertisement` WHERE id='$del_id'";
    // $query2="DELETE FROM company WHERE cid='$del_id2'";

  $run = mysqli_query($conn,$query);
//   $run2 = mysqli_query($conn,$query2);
  if ($run) {
  echo "<script>alert('Add have been Deleted.');</script>";
echo "<meta http-equiv='refresh' content='0;add.php'>" ;
  }

  }
      if (isset($_POST["save"])) {
     include('include/connection.php');
     $date= date('Y/m/d');
     $start=mysqli_real_escape_string($conn,$_POST["start"]);
     $end=mysqli_real_escape_string($conn,$_POST["end"]);
     $status=mysqli_real_escape_string($conn,$_POST["status"]);
     $description=mysqli_real_escape_string($conn,$_POST["description"]);
     $kvk=mysqli_real_escape_string($conn,$_POST["kvk"]);
     $filename            = $_FILES["simage"]["name"];
         $tmp_dir             = $_FILES["simage"]["tmp_name"];
         $size                = $_FILES["simage"]["size"];
         $ext                 = pathinfo($filename,PATHINFO_EXTENSION);
         
         $new_image= $filename.".".$ext;
         $upload_directory="../accountant/uploadedImages/".$new_image;
        
         
         if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
         {
                if (move_uploaded_file($tmp_dir,$upload_directory)) 
             {   
              
         
                 $sql2 = ("INSERT INTO `advertisement`( `image`,`description`, `date`, `status`, `endDate`, `approval`, `Aid`) VALUES ('$upload_directory','$description','$start',$status,'$end',$status,$kvk)");
                   if (mysqli_query($conn,$sql2)) {
                     echo "<script> 
                     alert('Data have Been Saved.');
                          </script>";
                   echo "<meta http-equiv='refresh' content='0;add.php'>" ;
                   }else {
                     echo "<script> alert('Error. Data not Saved')</script>";
                    
                     echo "error :".$sql. "<br>". $conn->error;
                   }
             }else{
               echo "<script> alert('Error. move upload')</script>";

             }
         }else {
           echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";

         
     }}
     
     if (isset($_POST["update"])) {
     include('include/connection.php');
     $idr=mysqli_real_escape_string($conn,$_POST["id"]);
      $date= date('Y/m/d');
     $start=mysqli_real_escape_string($conn,$_POST["start"]);
     $end=mysqli_real_escape_string($conn,$_POST["end"]);
     $description=mysqli_real_escape_string($conn,$_POST["description"]);
     $status=mysqli_real_escape_string($conn,$_POST["status"]);
     $kvk=mysqli_real_escape_string($conn,$_POST["kvk"]);
     
        // define path  
         $filename            = $_FILES["simage"]["name"];
         $tmp_dir             = $_FILES["simage"]["tmp_name"];
         $size                = $_FILES["simage"]["size"];
         $ext                 = pathinfo($filename,PATHINFO_EXTENSION);
         
         $new_image= $filename.".".$ext;
         $upload_directory="../accountant/uploadedImages/".$new_image;
         $upload_directory2="../accountant/uploadedImages/".$new_image;
          
         
       

         if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
         {
                if (move_uploaded_file($tmp_dir,$upload_directory)) 
             {   
              
         
                 $sql5 = ("UPDATE `advertisement` SET `image`='$upload_directory',`description`='$description',`date`='$start',`status`='$status',`endDate`='$end',`approval`='$status',`Aid`='$kvk' WHERE id = $idr");
                   if (mysqli_query($conn,$sql5)) {
                     echo "<script> 
                     alert('Data have Been Saved.');
                          </script>";
                   echo "<meta http-equiv='refresh' content='0;add.php'>" ;
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
          <h1 class="mainHeading mr-5">All Advertisments</h1>
        

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><a class="btn btn-outline-info" data-toggle="modal" data-target="#Addmdl" > <i class="fas fa-plus"></i> Add Addvertisment</a></td>
                      <td></td>
                      <td></td>
                  </tr>
                    <tr>
                      <th>S#</th>
                      <th>Image</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Status</th>
                      <th>Approved By</th> 
                       <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $sts=1;
                        $date=date('Y-m-d');
                        $sqlw="UPDATE `advertisement` SET `status` = '2' WHERE `date` < '$date'";
                        $runw=mysqli_query($conn,$sqlw);
                         $sqle="UPDATE `advertisement` SET `status` = '2' WHERE `endDate` < '$date'";
                        $rune=mysqli_query($conn,$sqle);
                        
                        
                            while ($row = mysqli_fetch_array($run)) { 
                            $aid=$row['id'];  

                    ?>
                    <tr>
                      <td><?php echo $cnt; ?></td>
                     <td><img src="../accountant/<?php echo $row["image"];?>" class="img-fluid " style=" height: 50px; width: 50px;" alt="img"></td>
                      <td><?php echo $row["date"]; ?></td>
                      <td><?php echo $row["endDate"]; ?></td>
                      <td><?php 
                      if( $row["approval"]== "1"){
                          echo "Active";
                      }
                      else{
                          echo "Inactive";
                      }
                      ?></td>
                      
                       <td> 
                        <?php
                         $ad=$row["Aid"]; 
                        $query1="SELECT * FROM `admin`
                         WHERE id='$ad'";
                         $run1 = mysqli_query($conn,$query1);
                        
                        $row1= mysqli_fetch_array($run1);
                       if (empty($row1["name"])) {
                         echo " "; 
                        }else {
                          echo $row1["name"];
                        }
                       ?>
                        </td> 
                      <!-- <td><img src="../accountant/<?php //echo $row["Ai_mg"];?>" class="img-fluid " style=" height: 50px; width: 50px;" alt="img"></td> -->
                       <td class="d-flex">
                        <a class="btn btn-outline-info" data-toggle="modal" data-target="#editmd<?php echo $row['id'] ?>" onclick="getdept(
                          <?php echo $row['id'];?>)"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="add.php?hhid=<?php echo $row['id'];?>" ><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
                    <div class="modal fade" id="editmd<?php echo $row['id'] ?>" role="dialog" >
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: lightgray;">
        <div class="modal-header">
          <h4 class="modal-title">Edit Advertisement</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          
          <form  method="post" enctype="multipart/form-data">
               <div class="form-group">
            <label for="contact">Image:</label>
             <input type="hidden" id="id" name="id">
            <input name="simage" type="file" class="form-control" value="<?php echo $row['image']  ?>" required>
          </div>
          
          <div class="form-group">
            <label for="name">Start Date:</label>
            <input name="start" type="date" class="form-control" placeholder="Enter Name" value="<?php echo $row['date'] ?>" required>
          </div>
          
          <div class="form-group">
            <label for="name">End  Date:</label>
            <input name="end" type="date" class="form-control" placeholder="Enter Name"  value="<?php echo $row['endDate'] ?>"  required>
          </div>
          <div class="form-group">
            <label for="name">Description:</label>
            <textarea class="form-control" rows="10" name="description"><?php  echo $row['description']; ?></textarea>
          </div>
           <div class="form-group">
            <label for="name">Status:</label>
             <select name="status" id="status">
                 <option value="1">Active</option>
                 <option value="2">Inactive</option>
             </select>
          </div>
        
          <div class="form-group">
            <label for="email">Admin:</label>
            <?php 
            $sql5="SELECT * FROM `admin` ";
            $run5=mysqli_query($conn,$sql5);
            ?>
            <select name="kvk" id="kvk">
                <?php while ($row = mysqli_fetch_array($run5)){?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
              <?php }?>
            </select>
          </div>

         </div>
        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
                      <?php  
                          $cnt++; 
                        }
                      ?>
                  </tbody>
                </table>
         <!-- End Collapse -->

        <!-- Table -->
       
         
        </div>
      </div>
    </div>
     <?php include("include/footer.php"); ?>
     <div class="modal fade" id="Addmdl" role="dialog" >
    <div class="modal-dialog modal-md" >
    
      <!-- Modal content-->
      
      <!--Add Staff  Modal -->
  
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: lightgray;">
        <div class="modal-header">
          <h4 class="modal-title">Add Accountant</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form  method="post" enctype="multipart/form-data">
               <div class="form-group">
            <label for="contact">Image:</label>
            <input name="simage" type="file" class="form-control" required>
          </div>
          
          <div class="form-group">
            <label for="name">Start Date:</label>
            <input name="start" type="date" class="form-control" placeholder="Enter Name"  required>
          </div>
          
          <div class="form-group">
            <label for="name">End  Date:</label>
            <input name="end" type="date" class="form-control" placeholder="Enter Name"  required>
          </div>
          <div class="form-group">
            <label for="name">Ad Description:</label>
            <textarea class="form-control" name="description" required rows="10"></textarea>
          </div>
           <div class="form-group">
            <label for="name">Status:</label>
             <select name="status" id="status">
                 <option value="1">Active</option>
                 <option value="2">Inactive</option>
             </select>
          </div>
        
          <div class="form-group">
            <label for="email">Admin:</label>
            <?php 
            $sql5="SELECT * FROM `admin` ";
            $run5=mysqli_query($conn,$sql5);
            ?>
            <select name="kvk" id="kvk">
                <?php while ($row = mysqli_fetch_array($run5)){?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
              <?php }?>
            </select>
          </div>

         </div>
        <div class="modal-footer">
          <button type="submit" name="save" class="btn btn-outline-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>


  <!--Edit Staff  Modal -->
  

  <script>
      function getdept(id,date,endDate,status,desgId,deptId) {
        
      $("#id").val(id);
      $("#start").val(date);
      $("#end").val(endDate);
      $("#status").val(status);
      $("#address").val(desgId);
      $("#kvk").val(deptId);
      }
          
  </script>
  </body>
</html>
