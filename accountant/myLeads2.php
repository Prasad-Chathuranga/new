<?php 
session_start();
if (!isset($_SESSION["id"])) {
 echo "<script>window.location.href='login.php'</script>";
}
$id = $_SESSION["id"];
$bid = $_GET["bid"];
require_once("include/head.php") ;

  
     if (isset($_POST["submit"])) {
     
     $name=$_POST["desc"];
     $status=$_POST["status"];
     $date=date('Y/m/d');
   
    
         
                
                 $sql = ("INSERT INTO `log`( `bid`, `date`, `Aid`, `desc`, `status`, `admin`) VALUES ('$bid','$date','$id','$name','$status','1')");
                 
                  if (mysqli_query($conn,$sql)) {
                     echo "<script> 
                     alert('Data have Been Saved.');
                          </script>";
                   echo "<meta http-equiv='refresh' content='0;../accountant/my leads1.php'>" ;
                   }else {
                     echo "<script> alert('Error. Data not Saved')</script>";
                    
                     echo "error :".$sql. "<br>". $conn->error;
                   }
         }

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
                         } else {
                            echo $rowtc["tcr_amount"];
                         }
                            
                     
                    ?>  
                credits</span> available for use
              </div>
              <div>
                <a href="" class="btn creditsBtn">Buy Credits</a>
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
            <div class="logboek">
              <h2 class="logboekHeading">
                Log Book 
              </h2>
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                      <?php
                      
                       $query="SELECT * FROM `log`
                        Left JOIN accountant ON log.Aid=accountant.Aid
                       WHERE bid= '$bid'";
                       $run = mysqli_query($conn,$query);
                      
                       if (mysqli_num_rows($run) > 0) {
                      ?>
                    <tr>
                      
                      <th class="tableHeading" scope="col">Name</th>
                      <th class="tableHeading" scope="col">Discription</th>
                      <th class="tableHeading" scope="col">Status</th>
                      <th class="tableHeading" scope="col">Date</th>
                      <th class="tableHeading" scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php    
                          while ($row = mysqli_fetch_array($run)) {
                        ?>
                    <tr>
                      
                      <td><?php echo $row ['Aname'] ?></td>
                      <td>
                        <?php echo $row ['desc'] ?>
                      </td>
                      <td><?php echo $row ['status'] ?></td>
                      <td><?php echo $row ['date'] ?></td>
                      <td>
                        <a href="deletelog.php?delid=<?php echo $row['id'];?>" class="btn btn-outline-danger" onclick="return confirm('Are you Sure to Delete!')"  ><i class="fas fa-trash-alt"></i></a href="deletelog.php?delid=<?php echo $row['id'];?>">
                      </td>
                    </tr>
                    <?php } ?>
                   
                  </tbody>
                   <?php  
                }else{
                   echo "No Data Found.";
                }  
                ?>
                </table>
                <div>
                  <button
                    class="btn logboekBtn"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                  >
                    Add a Log
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modalDialog">
        <div class="modal-content modalContent">
          <div class="modal-header modalHeader">
            <h5 class="modal-title modalTitle" id="exampleModalLabel">
              Logboek
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <div>
              <label for="">Logboek status *</label>
              <form method="post" action="">
              <select class="form-select" name="status">
                <option value="">
                  --Kies een gebeurtenis en klant niet gesproken--
                </option>
                <option value="Email gestuurd">Email gestuurd</option>
                <option value="Telefonisch de opdracht besproken">Telefonisch de opdracht besproken</option>
                <option value="Telefonisch kennis gemaakt en een afspaak ingepland">
                  Telefonisch kennis gemaakt en een afspaak ingepland
                </option>
                <option value="Anders, reden:">Anders, reden:</option>
              </select>
            </div>
            <div class="textareaBox">
              <textarea rows="8" class="form-control mb-3"  name="desc" required></textarea>
            </div>
            <div>
              <button class="btn modalBtn" type="submit" name="submit">
                Logboek gebeurtenis toevoegen
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
