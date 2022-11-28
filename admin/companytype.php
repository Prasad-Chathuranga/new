<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php");  
     include("function/companyFun.php");  
?>

  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
        
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">Company Type</h1>
          <button class="btn btn-outline-primary ml-auto" style="float: left;" data-toggle="modal" data-target="#myModal"><i>Add Company Type</i> </button>

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
                      <th>Type Name</th>
                      <th>Job type</th>
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
                      <td><?php echo $row["ctype"]; ?></td>
                      <td><?php echo $row["job_type"]; ?></td>
                      <td class="d-flex">
                        <a class="btn btn-outline-info" data-toggle="modal" data-target="#editmd" onclick="getdept(
                          <?php echo $row['tid'];?>,'<?php echo $row['ctype']; ?>','<?php echo $row['job_type']; ?>')"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="companytype.php?hhid=<?php echo $row['tid'];?>" ><i class="fas fa-trash-alt"></i></button>
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
          <h4 class="modal-title">Add Company Type</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
          
          <div class="form-group">
            <label for="name">Company Type:</label>
            <input name="name" type="text" class="form-control" placeholder="Enter Company Type"  required>
          </div>
          <div class="form-group">
            <label for="contact">Job type:</label>
            <input name="jt" type="text" class="form-control" placeholder="Enter Job Type"  required>
          </div>

         </div>
        <div class="modal-footer">
          <button type="submit" name="savect" class="btn btn-outline-primary">Save</button>
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
          
  </script>
  </body>
</html>
