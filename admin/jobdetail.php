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
          <?php 
          include 'include/connection.php';
              
                  $jid=$_GET["jddet"];
                $query="SELECT job.*,city.name as city_nm FROM job LEFT JOIN city ON city.id = job.Jcity WHERE Jid='".$jid."'";
                $result = $conn->query($query);
                //$row = mysqli_fetch_array($run);
      if ($result->num_rows > 0) {
    // output data of each row
      while($row = $result->fetch_assoc()) {
        //print_r($row);
          ?>
        <div class="contentsHeader d-flex p-0">
          <h1 class="mainHeading mr-5">Details of <strong style="color:#00b068;"><?php echo $row["Jtitle"]; ?></strong> job</h1>

        </div> 
        <div class="mainTable mt-4">
          
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
                        <td><?php echo $row["city_nm"]; ?></td>

                      </tr>
                      <tr>
                        <th>Distance</th>                      
                        <td><?php echo $row["distanceKm"]; ?></td>
                      </tr>
                      <tr>
                          <th>Credit</th>
                          <td><?php echo $row["Jcredits"]; ?></td>
                      </tr>
                      <tr>
                          <th>Description Before Job.</th>
                          <td><?php echo $row["JdesBef"]; ?></td>
                      </tr>
                      <tr>
                          <th>Description After Job.</th>
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
                          <th>Company</th>
                          <td><?php echo $row["company"]; ?></td>
                      </tr>
                      <tr>
                          <th>Company Email</th>
                          <td><?php echo $row["email"]; ?></td>
                      </tr>
                      <tr>
                          <th>Company Address</th>
                          <td><?php echo $row["street"]; ?>,<?php echo $row["postal"]; ?></td>
                      </tr>
                      <tr>
                          <th>Company website</th>
                          <td><a href="<?php echo $row["website"]; ?>"> <?php echo $row["website"]; ?></a></td>
                      </tr>
                  </thead>
                </table>
                <a href="job.php" class="btn btn-outline-info"
          ><i class="fas fa-angle-double-left"></i>Back</a>
         <!-- End Collapse -->

        <!-- Table -->
       
         
        </div>
        <?php 
   }
}
         ?>
      </div>
    </div>
     <?php include("include/footer.php"); ?>
  


 
  </body>
</html>
