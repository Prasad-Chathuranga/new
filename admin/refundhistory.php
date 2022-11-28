<?php  
session_start();
if (!isset($_SESSION["id"])) {
    echo "<script>window.location.href='login.php'</script>";
   }
     include("include/head.php");  
     include("function/refundFun.php");  
     
?>

  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
        
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">Refund History </h1>
        </div> 
        <div class="mainTable mt-4">
        
              <table id="myTable" class="table table-striped">
                  <thead>
                    <tr>
                        <th>Refund ID</th>
                        <th>Lead ID</th>
                        <th>Accountant</th>
                        <th>Lead Company</th>
                        <th>Lead Title</th>
                        <th>E-mail</th>
                        <th>Credit</th>
                        <th>Request Date</th>
                        <th>Request Description</th>
                        <th>Admin Description</th>
                        <th>Approved By</th>
                        <th>Status</th>
                        <th>Action</th>
                        <?php
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $cnt=1;
                        $query="select ref.Rid, ref.requestdate, ref.rdesc, ref.RSts, ref.admindesc, 
                            buy.bcredits, buy.Aid, 
                            job.Jid, job.Jtitle, job.company, job.email as jemail, 
                            acc.Aname, acc.Aemail, 
                            admin.name as admname 
                            from refund ref 
                            join buy on ref.bid=buy.bid 
                            join job on job.Jid=buy.Jid 
                            join accountant acc on acc.Aid=buy.Aid 
                            join admin on admin.id=ref.amid 
                            WHERE (RSts='1' or RSts=2) 
                            order by ref.requestdate desc";
                        $run = mysqli_query($conn,$query);
                        if (mysqli_num_rows($run) > 0) {
                            
                        
                            while ($row = mysqli_fetch_array($run)) {   
                    ?>
                    <tr>
                        <td><?php echo $row['Rid'];?></td>
                        <td><?php echo $row['Jid'];?></td>
                        <td><?php echo $row["Aname"];?></td>
                        <td><?php echo $row["company"];?></td>
                        <td><?php echo $row['Jtitle'];?></td>
                        <td><?php echo $row["jemail"];?></td>
                        <td><?php echo $row["bcredits"];?></td>
                        <td><?php echo $row["requestdate"];?></td>
                        <td><?php echo $row["rdesc"];?></td>
                        <td><?php echo $row["admindesc"];?></td>
                        <td><?php echo $row["admname"];?></td>
                        <td>
                              <?php 
                                    if($row["RSts"]==1){
                                    echo "<div class='text-light bg-success rounded p-1'>
                                    <b>
                                    Approved
                                    </b>
                                </div>";
                                    }else if($row["RSts"]==2){
                                    echo "<div class='text-light bg-danger rounded p-1'>
                                    <b>Rejected</b>
                                    </div>";
                                    }
                                ?>
                            </td>
                            <td class="d-flex">
                            <a class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')" href="refundrequest.php?rraa=<?php echo $row['Rid'];?>" ><i class="fas fa-trash-alt"></i></button>
                            </td>
                    </tr>
                      <?php  
                          $cnt++; 
                        }
                      }else{
                        echo "No Requests Found";
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
