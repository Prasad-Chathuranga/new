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
          <h1 class="mainHeading mr-5">Job Bought Requests </h1>
        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
                      <th>Accountant</th>
                      <th>Email</th>
                      <th>Job Title</th>                      
                      <th>Credit</th>
                      <th>Request Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $sts=0;
                        $run = buyFun($conn,$sts);
                            while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                      <form action="" method="post">
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row["Aname"]; ?></td>
                            <td><?php echo $row["Aemail"]; ?></td>
                            <td><?php echo $row["Jtitle"]; ?></td>
                            <td><?php echo $row["bcredits"]; ?></td>
                            <td><?php echo $row["buydate"]; ?></td>
                            <td>
                            <?php 
                                    if($row["bSts"]==1){
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
                            <input type="hidden" value="<?php echo $row["bid"];?>" name="id">
                            <button class="btn btn-outline-primary" type="sumbit" name="approved" onclick="return confirm('Are you sure Approve.')" >Approve</button>
                            <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="jobrequest.php?byid=<?php echo $row['bid'];?>" ><i class="fas fa-trash-alt"></i></button>
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
