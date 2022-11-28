<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php");  
     include("function/creditFun.php");  
     
?>

  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
        
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">Credits History </h1>
        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
                      <th>Accountant</th>
                      <th>Email</th>
                      <th>Contact</th>                      
                      <th>Credit</th>
                      <th>Price</th>
                      <th>Date</th>
                      <!-- <th>Approved By</th> -->
                      <!-- <th>Status</th> -->
                      <th>Invoice</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $sts=1;
                        $run = credFun($conn,$sts);
                            while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row["Aname"]; ?></td>
                            <td><?php echo $row["Aemail"]; ?></td>
                            <td><?php echo $row["Aphone"]; ?></td>
                            <td><?php echo $row["credits"]; ?></td>
                            <td><?php echo $row["amount"]; ?></td>
                            <td><?php echo $row["bcr_date"]; ?></td>
                            <!-- <td> -->
                              <?php
                              //   $ad=$row["admnId"]; 
                              //   $query1="SELECT * FROM `admin`
                              //   WHERE id='$ad'";
                              //   $run1 = mysqli_query($conn,$query1);
                                
                              //   $row1= mysqli_fetch_array($run1);
                              // if (empty($row1["name"])) {
                              //   echo " "; 
                              // }else {
                              //   echo $row1["name"];
                              // }
                              ?>
                            <!-- </td> -->
                            <!-- <td> -->
                              <?php 
                                //     if($row["crSts"]==1){
                                //     echo "<div class='approved'>
                                //      Approved
                                // </div>";
                                //     }else{
                                //     echo "<div class='approved'>
                                //     <i class='fa-solid '></i>Pending
                                //     </div>";
                                //     }
                                ?>
                            <!-- </td> -->
                            <td>
                            <?php 
                            $crd=$row["bcr_id"];
                                    if($row["crSts"]==1){
                                    echo "<a class='btn btn-primary' href='inv.php?inc=$crd'>
                                Invioce
                                </a>";
                                    }else{
                                    echo "";
                                    }
                                ?>
                            </td>
                           
                            <td class="d-flex">
                            <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="creditshistory.php?bchid=<?php echo $row['bcr_id'];?>" ><i class="fas fa-trash-alt"></i></button>
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
    
       <!-- Edit Modal  -->
  <!-- <div class="modal fade" id="editModal" role="dialog" >
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <!-- <div class="modal-content" style="background-color: lightgray;">
        
        <div class="modal-body">
        </div>
           <div class="form-group" >
                   <img id="image" class="img-fluid" style="height: 300px; width: 100%;">
           </div>
         </div>
      </div>
    </div>
  </div> --> -->
<!-- <script>
     function getdept(id) {

$("#image").attr("src",id);
}

</script> -->
  </body>
</html>
