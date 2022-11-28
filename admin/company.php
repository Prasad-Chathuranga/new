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
          <h1 class="mainHeading mr-5">Companies Details</h1>

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th>S#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Website</th>
                      <th>Address</th>                      
                      <th>Description</th>
                      <th>Company Type</th>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $sts=1;
                        $run = comFun($conn,$sts);
                            while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                    
                      <td><?php echo $cnt; ?></td>
                      <td><?php echo $row["cname"]; ?></td>
                      <td><?php echo $row["cemail"]; ?></td>
                      <td><?php echo $row["cwebsite"]; ?></td>
                      <td><?php echo $row["caddress"]; ?></td>
                      <td><?php echo $row["cdesc"]; ?></td>
                      <td><?php echo $row["ctype"]; ?></td>
                      <!-- <td class="d-flex">
                       
                        <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="company.php?cid=<?php 
                        // echo $row['cid'];
                        ?>" ><i class="fas fa-trash-alt"></i></button>
                      </td> -->
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
