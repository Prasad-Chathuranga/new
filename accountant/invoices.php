<?php
        session_start();
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        $id=$_SESSION["id"];

        require_once("include/head.php");
?>
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
                                                                        }
                                                                        else {
                                                                                echo $rowtc["tcr_amount"];
                                                                        }
                                                                ?>  
                                                                credits
                                                        </span> available for use
                                                </div>
                                                <div>
                                                        <a href="buycredit.php" class="btn creditsBtn">Buy Credits</a>
                                                </div>
                                                <hr />
                                                <div class="contact">
                                                        <div class="contactText">Your contact</div>
                                                        <?php 
                                                                $sq="SELECT * FROM `accountant` WHERE Aid='$id'";
                                                                $runn=mysqli_query($conn,$sq);
                                                                $roww=mysqli_fetch_array($runn);
                                                                $admId=$_SESSION['admId'];
                                                                $sq3="SELECT * FROM `admin` WHERE id='$admId'";
                                                                $runn3=mysqli_query($conn,$sq3);
                                                                if(mysqli_num_rows($runn3)>0)
                                                                {
                                                                        $roww3=mysqli_fetch_array($runn3); 
                                                                        ?>
                                                                        <div class="contactPerson">
                                                                                <div>
                                                                                        <?php
                                                                                                if(trim($roww3['photo'])!="")
                                                                                                {
                                                                                                        ?>
                                                                                                        <img src="./<?php echo $roww3['photo']; ?>" alt="sdsad" class="img-fluid" style="border-radius: 5px;"/>
                                                                                                        <?php
                                                                                                }
                                                                                        ?>
                                                                                </div>
                                                                                <div>
                                                                                        <div class="fontSmall">
                                                                                                <p>
                                                                                                        <?php
                                                                                                                if(isset($roww3['name']) && trim($roww3['name'])!="")
                                                                                                                {
                                                                                                                        echo $roww3['name'];
                                                                                                                }
                                                                                                        ?>
                                                                                                </p>
                                                                                        </div>
                                                                                        <div class="fontSmall textColor">
                                                                                                <?php
                                                                                                        if(isset($roww3['mobileNo']) && trim($roww3['mobileNo'])!="")
                                                                                                        {
                                                                                                                echo $roww3['mobileNo'];
                                                                                                        }
                                                                                                ?>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <?php
                                                                }
                                                                
                                                        ?>
                                                </div>
                                        </div>
                                        <?php 
                                                $sql9 = "SELECT * FROM `advertisement` WHERE status = 1 ORDER BY RAND() LIMIT 1";
                                                $run9 = mysqli_query($conn,$sql9);

                                                if(mysqli_num_rows($run9)>0)
                                                {
                                                        $row9= mysqli_fetch_array($run9);
                                                        ?>
                                                        <div class="card p0">
                                                                <img src="./<?php echo $row9['image'] ?>" class="img-fluid" alt="" />
                                                                <div class="paddingAll">
                                                                        <div class="cardText">
                                                                                <?php echo $row9['description'] ?>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <?php
                                                }
                                                else{
                                                        ?>
                                                        <div class="card p0">
                                                                <div class="paddingAll">
                                                                        <div class="cardText">
                                                                                No Ad set
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <?php
                                                }
                                        ?>
                                </div>
                                <div class="col-lg-10 order-lg-0 order-1">
                                        <div class="invoices">
                                                <div class="invoicesHeading">
                                                        <h2>My Credit invoices</h2>
                                                </div>
                                                <div class="table-responsive">
                                                        <?php 
                                                                $query="SELECT * FROM `buy_credit`
                                                                        JOIN accountant ON buy_credit.Aid=accountant.Aid
                                                                        WHERE buy_credit.Aid='$id'";
                                                                $run = mysqli_query($conn,$query);
                                                                if (mysqli_num_rows($run) > 0)
                                                                {
                                                                        ?>
                                                                        
                <table class="table" id="myTable">
                  <thead>
                    <tr>
                      <th scope="col" class="tableHeading">Package Name</th>
                      <th scope="col" class="tableHeading">Credits</th>
                      <th scope="col" class="tableHeading"><i class="fa fa-euro"></i> Amount</th>
                      <!-- <th scope="col" class="tableHeading">Credit Approval Status</th> -->
                      <th scope="col" class="tableHeading">Invioce </th>
                       <th scope="col" class="tableHeading">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                       <?php    
                             
                             ///////////////////// select data for invioce   ///////////////////////////////
                              
                                while ($row = mysqli_fetch_array($run)) {
                             
                        ?>
                    <tr>
                      <form action="" method="post">
                          <td><?php echo $row["pkg"];?></td>
                          <td><?php echo $row["credits"];?></td>
                          <td><i class="fa fa-euro"></i> <?php echo $row["amount"];?></td>
                          <!-- <td> -->
                              <?php 
                                //     if($row["crSts"]==1){
                                //     echo "<div class='approved'>
                                // <i class='fa-solid fa-check'></i>Approved
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
                                      // if($GLOBALS["lang"] == "en"){
                                        echo "<a class='btn btn-primary' href='inv.php?inc=$crd'>
                                          <i class='fa-solid fa-check'></i>Invioce
                                        </a>";
                                      // }else{
                                      //   echo "<a class='btn btn-primary' href='inv-nl.php?inc=$crd'>
                                      //     <i class='fa-solid fa-check'></i>Invioce
                                      //   </a>";
                                      // }
                                    }else{
                                    echo "";
                                    }
                                ?>
                            </td>
                            <td><?php echo $row["bcr_date"];?></td>
                          
                      </form>
                    </tr>
                       <?php  
                             
                              } ?>
                              <tfoot>
    <tr>
     <?php 
     $id=$_SESSION["id"];
     $result = mysqli_query($conn, "SELECT SUM(amount) AS value_sum FROM buy_credit WHERE Aid=$id"); 
     $row = mysqli_fetch_assoc($result); 
     $sum = $row['value_sum'];

     ?>

      <td style="visibility: hidden;">Sum</td>
      <td>Total</td>
      <td><i class="fa fa-euro"><?php echo $sum; ?></td>
        <td style="visibility:hidden;">$180</td>
      <td style="visibility:hidden;">Sum</td>
    </tr>
  </tfoot>
                  </tbody>
                </table>
                <?php  
                              }else{
                                  echo "No Data Found.";
                                  //die();
                              }  
                               ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
    <script src="js/index.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
  </body>
</html>
