<?php 
session_start();
if (!isset($_SESSION["id"])) {
 echo "<script>window.location.href='login.php'</script>";
}
$id=$_SESSION["id"];

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
                         if (empty($row["tcr_amount"]) OR $row['tc_expiry'] < $date) {
                           echo "No";
                           if($row['tc_expiry'] < $date){
                           $update_query="UPDATE `total_credits` SET `tcr_amount`='0' WHERE Aid='$id'";
                           mysqli_query($conn,$update_query);
                          }
                         } else {
                            echo $row['tcr_amount'];
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
                <div class="contactPerson">
                  <div>
                    <img src="<?php echo $_SESSION['usimg']; ?>" alt="" class="img-fluid" />
                  </div>
                  <div>
                    <div class="fontSmall">
                      <?php  echo $_SESSION['name']; ?>
                    </div>
                    <div class="fontSmall textColor"> <?php echo $_SESSION['nomb']; ?></div>
                    <div class="fontSmall textColor">Email</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card p0">
              <img src="./img/card-img.png" class="img-fluid" alt="" />
              <div class="paddingAll">
                <div class="cardText">
                   <?php echo $row9['description'] ?>
                </div>
               
              </div>
            </div>
          </div>
          <div class="col-lg-10 order-lg-0 order-1">
            <div class="myLeads">
              <div class="myLeadsHeading">
                <h2>
                  My jobs
                </h2>
              </div>
              <div class="table-responsive">
                <div class="logText">
                  <h5>Log</h5>
                </div>

                  <?php 

                     $query="SELECT * FROM `buy`
                     JOIN job ON buy.Jid=job.Jid WHERE Aid='$id'";
                     $run = mysqli_query($conn,$query);
                     if (mysqli_num_rows($run) > 0) {
                  ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Create</th>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Credits</th>
                      <th scope="col">Status</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       
                         while ($row = mysqli_fetch_array($run)) {
                    ?>
                    <tr>
                      <td scope="row"><?php echo $row["buydate"];?></td>
                      <td><?php echo $row["Jtitle"];?></td>
                      <td>
                      <?php echo $row["jdesAft"];?>
                      </td>
                      <td>
                        <?php echo $row["Jcredits"];?>
                      </td>
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
                      
                       
                      ?></td>
                      <!-- <td>
                        <button class="btn trashBtn">
                          <i class="fa-solid fa-trash-can"></i>
                        </button>
                      </td> -->
                    </tr>
                    <?php  
                             
                              } ?>
                  </tbody>
                </table>
                <?php  
                              }else{
                                  echo "No Data Found.";
                                  //die();
                              }  
                               ?>
              </div>
              <!-- <div>
                <button class="btn eventLogBtn">Add Event Log</button>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
