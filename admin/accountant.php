<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php");  
     include("function/acctFun.php");  
?>

  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
        
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">All Accountant</h1>
          <!-- <button class="btn btn-outline-primary ml-auto" style="float: left;" data-toggle="modal" data-target="#myModal"><i>Add Accountant</i> </button> -->

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><a class="btn btn-outline-info" data-toggle="modal" data-target="#Addmdl" > <i class="fas fa-plus"></i> Add Accountant</a></td>
                      <td></td>
                      <td></td>
                  </tr>
                    <tr>
                      <th>S#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Chamber of Commerce No</th>                      
                      <th>Admin #</th>
                      <!-- <th>Approved By</th> -->
                      <!-- <th>Image</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $sts=1;
                        $run = accFun($conn,$sts);
                        while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                      <td><?php echo $row["Aid"]; ?></td>
                      <td><?php echo $row["Aname"]; ?></td>
                      <td><?php echo $row["Aemail"]; ?></td>
                      <td><?php echo $row["Aphone"]; ?></td>
                      <td><?php /*echo $row["Aaddress"];*/ echo $row["kvknumber"]; ?></td>
                      <td><?php /*echo $row["kvknumber"];*/ echo $row["admId"]; ?></td>
                      <!-- <td> -->
                        <?php
                      //    $ad=$row["admId"]; 
                      //   $query1="SELECT * FROM `admin`
                      //   WHERE id='$ad'";
                      //   $run1 = mysqli_query($conn,$query1);
                        
                      //   $row1= mysqli_fetch_array($run1);
                      //  if (empty($row1["name"])) {
                      //   echo " "; 
                      //  }else {
                      //    echo $row1["name"];
                      //  }
                       ?>
                       <!-- </td> -->
                      <!-- <td><img src="../accountant/<?php //echo $row["Ai_mg"];?>" class="img-fluid " style=" height: 50px; width: 50px;" alt="img"></td> -->
                       <td class="d-flex">
                        <a class="btn btn-outline-info" data-toggle="modal" data-target="#editmd" onclick="getdept(
                          <?php echo $row['Aid'];?>,'<?php echo $row['Aname']; ?>','<?php echo $row['Aemail']; ?>',
                          '<?php echo $row['Aphone']; ?>','<?php echo $row['Aaddress']; ?>','<?php echo $row['kvknumber']; ?>','<?php echo $row['Acity'] ?>', '<?php echo $row['admId'] ?>')"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="accountant.php?hhid=<?php echo $row['Aid'];?>&cid=<?php echo $row['cid'];?>" ><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
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
          <form action="function/acctFun.php" method="post" enctype="multipart/form-data">
          
          <div class="form-group">
            <label for="name">Name:</label>
            <input name="name" type="text" class="form-control" placeholder="Enter Name"  required>
          </div>
          <div class="form-group">
            <label for="name">Surname:</label>
            <input name="surname" type="text" class="form-control" placeholder="Enter Name"  required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input name="email" type="email" class="form-control" placeholder="Enter Email"  required>
          </div>
          <div class="form-group">
            <label for="contact">Contact:</label>
            <input name="contact" type="text" class="form-control" placeholder="Enter Contact"  required>
          </div>
          <div class="form-group">
            <label for="name">Chamber of Commerce No:</label>
            <input name="kvk" type="text" class="form-control"  id="kvk" required>
          </div>
         
          <div class="form-group">
            <label for="email">Admin:</label>
            <?php 
            $sql5="SELECT * FROM `admin` WHERE type='admin' order by name";
            $run5=mysqli_query($conn,$sql5);
            ?>
            <select name="admid" id="admid" class="form-control">
                <?php while ($row = mysqli_fetch_array($run5)){?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label for="name">Address:</label>
            <input name="address" type="text" class="form-control"  id="address" required>
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <?php 
            $sql6="SELECT * FROM `city` order by name";
            $run6=mysqli_query($conn,$sql6);
            ?>
            <select name="city" id="city" class="form-control" required="">
              <?php while ($row = mysqli_fetch_array($run6)){ ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="email">Password:</label><small id="pwdmsg" style="display: none; color:#ca2127">8 Characters, upper and lower case alphabets, digits and special characters</small>
            <input name="password" id="password" type="password" class="form-control" placeholder="Enter Password" required>
          </div>
          <div class="form-group">
            <label for="contact">Image:</label>
            <input name="simage" type="file" class="form-control" required>
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
  <div class="modal fade" id="editmd" role="dialog" >
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: lightgray;">
        <div class="modal-header">
          <h4 class="modal-title">Edit Accountant</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="hidden" id="id" name="id">
            <input name="name" type="text" class="form-control" placeholder="Enter Name" id="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input name="email" type="email" class="form-control" id="email" required>
          </div>
          <div class="form-group">
            <label for="contact">Contact:</label>
            <input name="contact" type="text" class="form-control"  id="contact" required>
          </div>
          <div class="form-group">
            <label for="name">Chamber of Commerce:</label>
            <input name="kvk" type="text" class="form-control"  id="frmkvknumber" required>
          </div>
          <div class="form-group">
          <label for="email">Admin:</label>
            <?php 
            $sql5="SELECT * FROM `admin` WHERE type='admin' order by name ";
            $run5=mysqli_query($conn,$sql5);
            ?>
            <select name="admin" id="editadmin" class="form-control">
                <?php while ($row = mysqli_fetch_array($run5)){?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <?php 
            $sql6="SELECT * FROM `city` order by name";
            $run6=mysqli_query($conn,$sql6);
            ?>
            <select name="city" id="city" class="form-control">
              <option value="">Select City</option>
              <?php while ($rows = mysqli_fetch_array($run6)){ ?>
                <option value="<?php echo $rows['id'] ?>"><?php echo $rows['name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <!-- <div class="form-group">
            <label for="contact">upload Image: <strong>If you want to change Image.</strong>other vice <strong>don't Upload:</strong> </label>
            <input name="simage" type="file" class="form-control">
          </div> -->
         </div>
        <div class="modal-footer">
          <button type="submit" name="editstaff" class="btn btn-primary">Save Change</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <script>
        $('#password').blur(function(e){
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

        function getdept(id,name,email,contact,desgId,deptId,city,admid) {
            console.log(deptId);
            $("#id").val(id);
            $("#name").val(name);
            $("#email").val(email);
            $("#contact").val(contact);
            $("#address").val(desgId);
            $("#kvknumber").val(deptId);
            $("#editadmin option[value='"+admid+"']").attr('selected','selected');
            $("#city option[value='"+city+"']").attr('selected','selected');
        }

        $('#frmkvknumber').blur(function(){
            kvkNumber = $(this).val();
            var rege = new RegExp('^[0-9]{8}$');
            if(!(rege.test(kvkNumber)))
            {
                alert('KVK number can only be 8 digits');
                $(this).val("");
            }
        });
          
        $('#kvk').blur(function(){
            kvkNumber = $(this).val();
            var rege = new RegExp('^[0-9]{8}$');
            if(!(rege.test(kvkNumber)))
            {
                alert('KVK number can only be 8 digits');
                $(this).val("");
            }
        });
  </script>
  </body>
</html>
