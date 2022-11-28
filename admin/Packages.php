<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php"); 
     
     
    //  AddPackage
   if(isset($_POST['AddPackage'])){
      $ptitle= $_POST["ptitle"];
      $psts= $_POST["psts"];
      $pdesc= $_POST["pdesc"];
      $pamount= $_POST["pamount"];
      $pcredits= $_POST["pcredits"];
      $xdate= $_POST["xdate"];
      $sql=("INSERT INTO `packages`(`ptitle`, `pcredits`, `pamount`, `psts`,`pxdate`,`pdesc`) VALUES ('$ptitle','$pcredits','$pamount','$psts','$xdate','$pdesc')");
    if (mysqli_query($conn,$sql)) {
      echo "<script> alert('Package Created Successfully')</script>";
      echo "<script>window.location.href='Packages.php'</script>";
    }else{
       die("Error In Adding Package");
   }
    }


    //  Update Package
    if(isset($_POST['update'])){
      $ptitle= $_POST["ptitle"];
      $pid= $_POST["pid"];
      $psts= $_POST["psts"];
      $pdesc= $_POST["pdesc"];
      $pamount= $_POST["pamount"];
      $pcredits= $_POST["pcredits"];
      $xdate= $_POST["xdate"];
    if (mysqli_query($conn,
    "UPDATE `packages` SET `ptitle` = '$ptitle', `pcredits` = '$pcredits', `pamount` = '$pamount', `pxdate` = '$xdate', `pdesc` = '$pdesc' WHERE `packages`.`pid` = '$pid';")) {
      echo "<script> alert('Package Updated Successfully')</script>";
      echo "<script>window.location.href='Packages.php'</script>";
    }else{
      die("Error In updating Package");
   }
    }
    

    if(isset($_GET['delid'])){
      if (mysqli_query($conn,"DELETE FROM `packages` WHERE `pid`=".$_GET['delid'])) {
        echo "<script> alert('Package Deleted Successfully')</script>";
        echo "<script>window.location.href='Packages.php'</script>";
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
          <h1 class="mainHeading mr-5">Packages</h1>

        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><a class="btn btn-outline-info" data-toggle="modal" data-target="#Addmdl" > <i class="fas fa-plus"></i> Create New Packege</a></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>S#</th>
                      <th>Title</th>      
                      <th>Credit</th>
                      <th>Discription</th>
                      <th>Price</th> 
                      <th>Expiry date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $query="SELECT * FROM `packages` ";
                        $run = mysqli_query($conn,$query);
                        if (mysqli_num_rows($run) > 0) {
                         
                        
                            while ($row = mysqli_fetch_array($run)) {   
                    ?> 
                    <tr>
                      <td><?php echo $cnt; ?></td>
                      <td><?php echo $row["ptitle"]; ?></td>
                      <td><?php echo $row["pcredits"]; ?></td>
                      <td><?php echo $row["pdesc"]; ?></td>
                      <td>€<?php echo $row["pamount"]; ?></td>
                      <td><?php echo $row["pxdate"]; ?></td>
                      <td>
                        <?php 
                            if($row["psts"]==1){ ?>
                            <span class="btn btn-success">Active</span>
                              <?php } else{ ?>
                                <span class="btn btn-danger">Inactive</span>
                                <?php

                              }
                        ?>
                      </td>
                      
                      <td class="d-flex">
                         <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="?delid=<?php echo $row['pid'];?>" ><i class="fas fa-trash-alt"></i></button>

                         <a class="btn btn-outline-info" data-toggle="modal" data-target="#editmd" onclick="getdept(
                          <?php echo $row['pid'];?>,'<?php echo $row['ptitle']; ?>','<?php echo $row['pcredits']; ?>',
                          '<?php echo $row['pamount']; ?>','<?php echo $row['pxdate']; ?>','<?php echo $row['pdesc']; ?>')"><i class="fas fa-edit"></i></a>
                              </a>
                      </td>
                    </tr>
                      <?php  
                          $cnt++; 
                        }
                      }else{
                       echo "<tr>No Packages</tr>";
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
  <div class="modal fade" id="Addmdl" role="dialog" >
    <div class="modal-dialog modal-md" >
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: lightgray;">
        <div class="modal-header">
          <h3 class="modal-title" style="font-weight:bold">Creat Package</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Package Name:</label>
              <input autocomplete="off" name="ptitle" class="form-control" placeholder="Enter Package Name" required>
            </div>
            <div class="form-group">
              <label for=""> Credits:</label>
              <input autocomplete="off" name="pcredits" type="number" class="form-control" placeholder="Enter Credit" required>
            </div>
            <div class="form-group">
              <label for="">Amount:</label>
              <input autocomplete="off" name="pamount" type="number" class="form-control" placeholder="Enter Amount" required>
            </div>
             <div class="form-group">
              <label for="">Discription:</label>
              <br>
               <textarea name="pdesc" id="pdesc" cols="50" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="">Expiry Date</label>
              <input autocomplete="off" name="xdate" type="date" class="form-control" placeholder="dd/mm/yy" required>
            </div>
            <div class="form-group">
              <label for="">Status:</label>
              <select class="form-control" name="psts">
                <option value="" selected>Select Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          
          </div>
         
        <div class="modal-footer">
          <button type="submit" name="AddPackage" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>




  <div class="modal fade" id="editmd" role="dialog" >
    <div class="modal-dialog modal-md" >
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: lightgray;">
        <div class="modal-header">
          <h3 class="modal-title" style="font-weight:bold">Edit Package</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Package Name:</label>
              <input type="hidden" id="pid" name="pid">
              <input autocomplete="off" id="ptitle" name="ptitle" class="form-control" placeholder="Enter Package Name" required>
            </div>
            <div class="form-group">
              <label for=""> Credits:</label>
              <input autocomplete="off" id="pcredits" name="pcredits" type="number" class="form-control" placeholder="Enter Credit" required>
            </div>
            <div class="form-group">
              <label for="">Amount:</label>
              <input autocomplete="off" id="pamount" name="pamount" type="number" class="form-control" placeholder="Enter Amount" required>
            </div>
             <div class="form-group">
              <label for="">Discription:</label>
              <br>
               <textarea name="pdesc" id="pdesc" cols="50" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="">Expiry Date</label>
              <input autocomplete="off" name="xdate" id="xdate" type="date" class="form-control" placeholder="dd/mm/yy" >
            </div>
            <div class="form-group">
              <label for="">Status:</label>
              <select class="form-control" name="psts">
                <option value=""  id="psts" selected>Select Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          
          </div>
        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <script>
      function getdept(pid, ptitle, pcredits, pamount,pdesc, psts) {
        // alert(ptitle);
      $("#pid").val(pid);
      $("#ptitle").val(ptitle);
      $("#pcredits").val(pcredits);
      $("#pamount").val(pamount);
        $("#pdesc").val(pdesc);
      $("#psts").val(psts);
      if(psts==1){
        $("#psts").text("Active");
      }else{
        $("#psts").text("inactive");
      }
      
      }
          
  </script>
  </body>
</html>
