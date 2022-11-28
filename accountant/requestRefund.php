<?php 
  session_start();
  if (!isset($_SESSION["id"])) {
   echo "<script>window.location.href='login.php'</script>";
 }
 $id = $_SESSION["id"];
 require_once("include/head.php");
 if (isset($_POST["submit"])) {
  $crid=$_GET["bcr"];
  $reson=$_POST["desc"];
  $yesorno=$_POST['yesorno'];
  $query="SELECT * FROM `refund` WHERE bcr_id='$crid'";
  $run = mysqli_query($conn,$query);
  if (mysqli_num_rows($run) > 0) { 
    echo " <script>alert('You Already request for  Refund of this Job.')</script>";

}else{
  $insert_query2= "INSERT INTO `refund`(`requestdate`,`on` ,`RSts`, `bcr_id`,`rdesc`,`Aid`) VALUES (now(),'$yesorno','0','$crid','$reson',$id)";
  
  if (mysqli_query($conn,$insert_query2)) {
    
  echo " <script>alert('Success! Your request submited. It well be Approved soon from the Admin.')</script>";
  echo "<meta http-equiv='refresh' content='0;credits.php'>";


  }
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
                include 'include/connection.php';

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
                 <?php 
                $sql9 = "SELECT * FROM `advertisement` WHERE status = 1 ORDER BY RAND() LIMIT 1";
                $run9 = mysqli_query($conn,$sql9);
                $row9= mysqli_fetch_array($run9);
                ?>
              <img src="./<?php echo $row9['image'] ?>" class="img-fluid" alt="" />
              <div class="paddingAll">
                <div class="cardText">
                  Look for reinforcement for your office?
                </div>
               
              </div>
            </div>
          </div>
          <div class="col-lg-10 order-lg-0 order-1">
            <div class="packages">
              <center><h4>Refund Request</h4></center>
        </div>
        <div  >
      
        <div >
          <div >
            <h5 class="modal-title modalTitle" >
              
            </h5>
           
          </div>
          <div class="modal-body">
            <h6 class="modalBodyTopText">
             <center>Job Discription</center>
            </h6>
            <div class="alertBox">
              <p>
                <span
                  ><i
                    class="fa-solid fa-circle-exclamation faCircleExclamation"
                  ></i
                ></span>
                Read Carefuly before Refund
              </p>
            </div>
            <div class="loremBox" id="desc">
            <?php 
            $id = $_SESSION["id"];
             
             $query3="SELECT * FROM `buy`
             left JOIN job ON buy.Jid=job.Jid 
             left JOIN company ON job.CompanyId=company.cid
             WHERE buy.Aid= '$id'";
             $run3 = mysqli_query($conn,$query3);
             $row3=mysqli_fetch_array($run3);
             echo $row3['jdesAft'];
            ?>
            </div>
            <div class="textareaBox">
              <form action="" method="post">
              <label for=""
                >Reason for refund request</label
              >
              <textarea name="desc" rows="8" class="form-control mb-3"></textarea>
              
           
              <label for="">Have u contacted Comapny ?</label>
              <br>
              
                <select name="yesorno" id="">
                  <option value="yes">Yes I Have</option>
                  <option value="no">No I Have</option>
                </select>
              
            
            
               <input class="btn modalBtn" type="submit" name="submit" value="Request"> 
               </form>
            </div>
          </div>
        </div>
      </div>
    </div>
       
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
<script>
  function getFunc(jid) {
// alert(jid);
$("#bid").val(jid);
}

</script>
  </body>
</html>
