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
         <h2 style="margin-top: 50px;text-align: center;">Bought Job Details</h2>
        <div class="contentsHeader d-flex p-0">
         
        </div> 
         <?php 
              if (isset($_GET["jddet"])) {
              include 'include/connection.php';
                $jid=$_GET["jddet"];
                   $query="SELECT * FROM `buy`
                   LEFT JOIN job ON buy.bid=job.Jid WHERE  buy.Jid='$jid'";
                    $run = mysqli_query($conn,$query);
                    $row = mysqli_fetch_array($run);
                 }
                ?>
              <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <td><?php echo $row["Jtitle"]; ?></td>
                    </tr>
                     <tr>
                        <th>Salary</th>
                        <td><?php echo $row["Jsalary"]; ?></td>
                      </tr>
                      <tr>
                        <th>City</th>                        
                        <td><?php echo $row["Jcity"]; ?></td>

                      </tr>
                      <tr>
                        <th>Distance From City</th>                      
                        <td><?php echo $row["distanceKm"]; ?></td>
                      </tr>
                      <tr>
                          <th>Description.</th>
                          <td><?php echo $row["jdesAft"]; ?></td>
                      </tr>
                      <tr>
                          <th>Start Date</th>
                          <td><?php echo $row["startDate"]; ?></td>
                      </tr>
                      <tr>
                          <th>End Date</th>
                          <td><?php echo $row["endDate"]; ?></td>
                      </tr>
                      <tr>
                          <th>Job Bought Credits</th>
                          <td><?php echo $row["bcredits"]; ?></td>
                      </tr>
                      <tr>
                          <th>Job Bought Date</th>
                          <td><?php echo $row["buydate"]; ?></td>
                      </tr>
                      <tr>
                          <th>Company</th>
                          <td><?php echo $row["company"]; ?></td>
                      </tr>
                  </thead>
                </table>
                <h2 style="margin-top: 50px;text-align: center;">Log BooK</h2>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $query="SELECT * FROM `log` WHERE bid='". $row["bid"]."'";
                    
                    $run = mysqli_query($conn,$query);
                    if (mysqli_num_rows($run) > 0) {
                      while ($row = mysqli_fetch_array($run)) {
                        
                          
                          
               ?>
                    <tr>
                      <td><?php echo $row["desc"]; ?></td>
                      <td><?php echo $row["status"]; ?></td>
                      <td><?php echo $row["date"]; ?></td>
                    </tr>
                  <?php }
                  } ?>
                  </tbody>
                </table>
                <a href="jobhistory.php" class="btn btn-outline-info"
          ><i class="fas fa-angle-double-left"></i>Back</a>
              </div>
      </div>
    </div>
     <?php include("include/footer.php"); ?>
  


 
  </body>
</html>
