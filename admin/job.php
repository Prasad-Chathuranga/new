<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php");  
     include("function/jobFun.php");  
     
?>

  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
        
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">All Job Details</h1>

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>Lead#</th>
                      <th>Company</th>
                      <th>Date</th>
                      <th>City</th>                      
                      <th>Credit</th>
                      
                      <th>Status</th>
                      <th>Apporved By</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $run = jobFun($conn);
                            while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                      <td><?php echo $row['Jid']; ?></td>
                      <td><?php echo $row["company"]; ?></td>
                      <td><?php echo date("Y-m-d", strtotime($row["addDate"])); ?></td>

                      <td><?php echo $row["city_nm"]; ?></td>
                      <td><?php echo $row["Jcredits"]; ?></td>
                      
                      <td>
                           <?php 
                                    if($row["JSts"]==1){
                                    echo "<div class='approved' >
                                <i class='fa fa-check'></i>Approved
                                </div>";
                                    }else{
                                    echo "<div class='approved btn btn-outline-danger'>
                                    <i class='fa-solid '></i>Pending
                                    </div>";
                                    }
                                ?>
                                
                      </td>
                      <td><?php
                         $ad=$row["admId"]; 
                        $query1="SELECT * FROM `admin`
                        WHERE id='$ad'";
                        $run1 = mysqli_query($conn,$query1);
                        
                        $row1= mysqli_fetch_array($run1);
                       if (empty($row1["name"])) {
                        echo " "; 
                       }else {
                         echo $row1["name"];
                       }
                       ?></td>
                      <td class="d-flex">
                         <a class="btn btn-outline-info" href="jobdetail.php?jddet=<?php echo $row['Jid'];?>" data-toggle="popover" title="View job Details" ><i class="fas fa-angle-double-right"></i></button>
                         <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="job.php?Jid=<?php echo $row['Jid'];?>" ><i class="fas fa-trash-alt"></i></button>

                        
                          <a href="editjob.php?jded=<?php echo $row['Jid'];?>" class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
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
      <!--Edit Staff  Modal -->
  <div class="modal fade" id="editmd" role="dialog" >
    <div class="modal-dialog modal-md" >
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: lightgray;">
        <div class="modal-header">
          <h3 class="modal-title" style="font-weight:bold">Approve job with Credits</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Enter Job Credits:</label>
            <input type="hidden" id="id" name="id">
            <input autocomplete="off" name="credit" type="number" class="form-control" placeholder="Enter Credit" id="name" required>
          </div>
          <div class="form-group">
            <label for="name">Enter Job Description For After bought:</label>
            <textarea name="jdesAft" id="jdesAft" class="form-control" required rows="10">

            </textarea>
          </div>
          
         
        <div class="modal-footer">
          <button type="submit" name="editjob" class="btn btn-primary">Approve</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <script>
      function getdept(id) {
        
      $("#id").val(id);
      }
          
  </script>
  </body>
</html>
