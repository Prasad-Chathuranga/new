<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
 $id=$_SESSION["id"];
     include("include/head.php");  
     include("function/adminFun.php");  
?>

  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
        
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">All Admins</h1>
          <button class="btn btn-outline-primary ml-auto" style="float: left;" data-toggle="modal" data-target="#myModal"><i>Add Admin</i> </button>

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
                      <th> Name</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Role</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $sts=1;
                        $run = ctFun($conn);
                            while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                      <td><?php echo $cnt; ?></td>
                      <td><?php echo $row["name"]; ?></td>
                      <td><?php echo $row["email"]; ?></td>
                      <td><?php echo $row["password"]; ?></td>
                      <td><?php echo $row["type"]; ?></td>
                      <td><img src="../accountant/<?php echo $row["photo"];?>" class="img-fluid " style=" height: 50px; width: 50px;" alt="img"></td>
                      <td class="d-flex">
                       <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="admins.php?hhhid=<?php echo $row['id'];?>" ><i class="fas fa-trash-alt"></i></button>
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
      <!--Add Staff  Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: lightgray;">
        <div class="modal-header">
          <h4 class="modal-title">Add Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
          
          <div class="form-group">
            <label for="name">Admin Name:</label>
            <input name="name" type="text" class="form-control" placeholder="Enter Admin Name"  required>
          </div>
          <div class="form-group ">
                    
                    <label for=""> Role</label>
                     <select name="role" class="form-control" required>               
                        <option  disabled> Select Role</option> 
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                      
    
                     </select>
                </div>
          <div class="form-group">
            <label for="contact">Admin Email:</label>
            <input name="email" type="email" class="form-control" placeholder="Enter Admin Email"  required>
          </div>
          <div class="form-group">
            <label for="contact">Admin password:</label><small id="pwdmsg" style="display: none; color:#ca2127">8 Characters, upper and lower case alphabets, digits and special characters</small>
            <input name="password" id="password" type="password" class="form-control" placeholder="Enter Admin Password"  required>
          </div>
          <div class="form-group">
            <label for="contact">Admin Image:</label>
            <input name="nimage" type="file" class="form-control" placeholder="Enter Admin Image"  required>
          </div>
         </div>
        <div class="modal-footer">
          <button type="submit" name="savead" class="btn btn-outline-primary">Save</button>
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
            <label for="name">Company Type:</label>
            <input type="hidden" id="id" name="id">
            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Company Type"  required>
          </div>
          <div class="form-group">
            <label for="contact">Job type:</label>
            <input name="jt" type="text" class="form-control" id="jt" placeholder="Enter Job Type"  required>
          </div>

         </div>
        <div class="modal-footer">
          <button type="submit" name="editct" class="btn btn-primary">Save Change</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <script>
      function getdept(id,name,email) {
        
      $("#id").val(id);
      $("#name").val(name);
      $("#jt").val(email);
      }

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
          
  </script>
  </body>
</html>
