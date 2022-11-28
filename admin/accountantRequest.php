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
          <h1 class="mainHeading mr-5">New Accountant Requests</h1>

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $sts=0;
                        $run = accFun($conn,$sts);
                        
                            while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                    <form action="" method="post">
                      <td><?php echo $cnt; ?></td>
                      <td><?php echo $row["Aemail"]; ?></td>
                      <td> 
                        <?php 
                            if($row["ASts"]==1){
                              echo "<div class='approved'>
                          <i class='fa-solid fa-check'></i>Approved
                          </div>";
                            }else{
                              echo "<div class='approved'>
                              <i class='fa-solid '></i>Pending
                            </div>";
                            }
                        ?>

                      </td>
                      <td class="d-flex">
                      <input type="hidden" value="<?php echo $row["Aid"];?>" name="id">

                         <button class="btn btn-outline-primary" type="sumbit" name="approved" onclick="return confirm('Are you sure Approve.')" >Approve</button>

                         <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="accountantRequest.php?hhid=<?php echo $row['Aid'];?>" ><i class="fas fa-trash-alt"></i></button>
                      </td>
                     </form>
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
     
  </body>
</html>
