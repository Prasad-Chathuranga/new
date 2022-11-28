
<?php 
session_start();
  if (!isset($_SESSION["id"])) {
   echo "<script>window.location.href='login.php'</script>";
 }
$id = $_SESSION["id"];
require_once("include/head.php") ?>
  <body>
    <!-- Header navbar-->
     <?php require_once("include/navbar.php") ?>
    <!-- main -->
    <main>
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-2 order-lg-0 order-2">
            <div class="card">
              <div class="cardTextTop">
                You have <span>
                <?php  
                     $querytc="SELECT * FROM `total_credits`
                     WHERE Aid= '$id'";
                     $runtc = mysqli_query($conn,$querytc);
                     $rowtc = mysqli_fetch_array($runtc);
                        if (empty($rowtc["tcr_amount"])) {
                          echo "No";
                        } else {
                           echo $rowtc["tcr_amount"];
                        }
                            
                     
                    ?>  
                credits</span> available for use
              </div>
              <div>

                <a href="buycredit.php" class="btn creditsBtn">
                  Buy Credits</a>
              </div>
              <hr />
              <div class="contact">
                <div class="contactText">Your contact</div>
                  <?php 
                      
                      $sq="SELECT * FROM `accountant` WHERE Aid='$id'";
                      $runn=mysqli_query($conn,$sq);
                      $roww=mysqli_fetch_array($runn);
                      $to=$roww['kvknumber'];
                     
                      $sq3="SELECT * FROM `admin` WHERE id='$to'";
                      $runn3=mysqli_query($conn,$sq3);
                      $roww3=mysqli_fetch_array($runn3); 
                       ?>
                <div class="contactPerson">
                  <div>
                  <img src="./<?php echo $roww3['photo']; ?>" alt="sdsad" class="img-fluid" style="border-radius: 5px;"/>
                  </div>
                  <div>
                  <div class="fontSmall">
                        
                     <p><?php echo $roww3['name']; ?></p>
                    </div>
                    <div class="fontSmall textColor"> <?php echo $roww3['mobileNo']; ?></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card p0">
                 <!-- dfdsjfh -->
                <?php
include 'include/connection.php';
$result = mysqli_query($conn,"SELECT * FROM  advertisement WHERE status='1' ORDER BY RAND() LIMIT 1 ");
?>
<?php
while($row = mysqli_fetch_array($result)) {
?>
              <img src="./<?php echo $row['image'] ?>" class="img-fluid" alt="" />
              <div class="paddingAll">
              <?php 
            } 
              ?>
                <div class="cardText">
                  Look for reinforcement for your office?
                </div>
               
              </div>
            </div>
          </div>
          <div class="col-lg-10 order-lg-0 order-1">
            <div class="refunds">
              <div class="refundsHeading">
                <h2>My Refund Requests</h2>
              </div>
              <div class="table-responsive">
              
                <?php  
                   $query="SELECT * FROM `refund`
                   left JOIN buy ON refund.bcr_id=buy.bid
                   left JOIN job ON buy.Jid=job.Jid WHERE buy.Aid='$id'";
                   $run = mysqli_query($conn,$query);
                   if (mysqli_num_rows($run) > 0) {
                ?> 
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Refund request Date</th>
                      <th scope="col">My Description</th>
                      <th scope="col">Admin Description</th>

                      <th scope="col">job credits</th>
                      <th scope="col">Job Id</th>
                      <th scope="col">Job Title</th>
                      
                      <th scope="col">Status</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php    
                             
                             ///////////////////// select data for invioce   ///////////////////////////////
                              
                                while ($row = mysqli_fetch_array($run)) {
                             
                        ?>
                    <tr>
                      <td><?php echo $row["requestdate"];?></td>
                      <td><?php echo $row["rdesc"]; ?></td>
                      <td><?php echo $row["admindesc"]; ?></td>
                      <td><?php echo $row["bcredits"]; ?></td>
                      <td><?php echo $row["Jid"]; ?></td>
                      <td><?php echo $row["Jtitle"]; ?></td>
                      <td> 
                      <?php 
                            if($row["RSts"]==1){
                              echo "<div class='approved'>
                          <i class='fa-solid fa-check'></i>Approved
                        </div>";
                            }else{
                              echo "<div class='approved'>
                              <i class='fa-solid '></i>Pending
                            </div>";
                            }
                      
                       
                      ?></td>
                      <td>
                        <a class="btn btn-outline-info" href="jobdetail.php?jddet=<?php echo $row['Jid'];?>" data-toggle="popover" title="View job Details" >View</a>
                      </td>
                    </tr>
                       <?php  
                             
                              } ?>
                  </tbody>
                </table>
                <?php  
                              }else{
                                  echo "No Data Found.";
                                  die();
                              }  
                               ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
