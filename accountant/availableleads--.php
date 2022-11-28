<?php
session_start();
   if (!isset($_SESSION["id"])) {
    echo "<script>window.location.href='login.php'</script>";
  }
require_once("include/head.php");

$month = date('m');
$day = date('d');
$year = date('Y');

$date = $year . '-' . $month . '-' . $day;
?>
 <!-- <script>
        function myFunction() {
            const date2 = new Date(document.getElementById("outDate").value);
            console.log(date2);
const date1 = new Date(document.getElementById("inDate").value);
const diffTime = Math.abs(date2 - date1);
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
document.getElementById("stay").value= diffDays;
console.log('diffDays');
        }
    </script> -->
    <style type="text/css">
      #test{
        background-color: yellowgreen;
      }
    </style>
  <body>
    <!-- Header navbar-->
     <?php require_once("include/navbar.php"); 
               $id = $_SESSION["id"];

               $query="SELECT * FROM `total_credits`
                WHERE Aid= '$id'";
                $run = mysqli_query($conn,$query);
                $row = mysqli_fetch_array($run);

               if (isset($_POST["save"])) {

                 $jid=mysqli_real_escape_string($conn,$_POST['id']);
                 $credit=mysqli_real_escape_string($conn,$_POST['credit']);

                 if($row["tcr_amount"]>=$credit){
                     $remain= $row["tcr_amount"]-$credit;

                     $insert_query= "INSERT INTO `buy`(`Jid`, `Aid`, `buydate`, `bcredits`, `bSts`) 
                     VALUES ('$jid','$id',now(),'$credit',1)";

                     $update_query="UPDATE `total_credits` SET `tcr_amount`='$remain' WHERE Aid='$id'";
                     
                     if (mysqli_query($conn,$insert_query) AND mysqli_query($conn,$update_query)) {
                        
                      echo " <script>alert('Success! you buy job successfully. It well be soon Approved from the Admin.')</script>";
                      echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
            
            
                      }else{
                        echo " <script>alert('Error. job not buy.')</script>";
                        // echo "error :".$insert_query. "<br>". $conn->error."<br>";
                        // echo "error :".$update_query. "<br>". $conn->error."<br>";
            
                      }
                    

                 }else {
                   echo "<script>alert('Sorry. Your credits is less then job credit: $credit')</script>";

                 }
               }

               if (isset($_POST["savecredit"])) {

                $price=mysqli_real_escape_string($conn,$_POST['price']);
                $credit=mysqli_real_escape_string($conn,$_POST['credit']);

                    $upload_directory    = "uploadedImages/";     // define path  
                    $filename            = $_FILES["nimage"]["name"];
                    $upload_directory   .= $filename;
                    $tmp_dir             = $_FILES["nimage"]["tmp_name"];
                    $size                = $_FILES["nimage"]["size"];
                    $ext                 = pathinfo($filename,PATHINFO_EXTENSION);
                  // echo " <script>alert('$price/$credit/$upload_directory')</script>";

                    if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif' OR $ext == 'JPG' OR $ext == 'JPEG' OR $ext == 'PNG' OR $ext == 'GIF') 
                    {
                          if (move_uploaded_file($tmp_dir,$upload_directory)) 
                        {  
                            $insert_query2= "INSERT INTO `buy_credit`( `credits`, `amount`, `crSts`, `Aid`, `bcr_date`, `trx_img`) 
                            VALUES ('$credit','$price',0,'$id',now(),'$upload_directory')";
                            
                            if (mysqli_query($conn,$insert_query2)) {
                              
                            echo " <script>alert('Success! Your request submit Successfully. It well be Approved soon from the Admin.')</script>";
                            echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
                  
                  
                            }else{
                              echo " <script>alert('Error. credit not added.')</script>";
                              //  echo "error :".$insert_query. "<br>". $conn->error."<br>";
                              //  echo "error :".$update_query. "<br>". $conn->error."<br>";
                  
                            }
                            
                        }else{
                          echo "<script> alert('Error. move upload')</script>";

                        }
                    }else {
                      echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";

                    }

              }
     ?>
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
            <?php 
                $sql9 = "SELECT * FROM `advertisement` WHERE status = '1' ORDER BY RAND() LIMIT 1";
                $run9 = mysqli_query($conn,$sql9);
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
          </div>
          <div class="col-lg-10 order-lg-0 order-1">
              <div class="col-lg-12 pb-4" >
                <form action="availableleads.php">
                    <input
                      type="text" 
                      class="searchBox form-control" 
                      name="search"
                      placeholder="Search available leads";
                      value="<?php echo isset($_GET["search"]) ? $_GET["search"] : "" ?>"
                    /> 
                </form>
              </div>
            <div class="row g-4">
               <?php 

                    if (isset($_GET['search']) AND !empty($_GET['search']) ) {

                          $searchValue = mysqli_real_escape_string($conn,$_GET['search']);
                        
                        //   $query = "SELECT * FROM `job` 
                        //   INNER JOIN company ON job.CompanyId=company.cid
                        //   INNER JOIN companytype ON company.tid=companytype.tid
                        //   WHERE job.JSts = 1 AND job.startDate >= CURDATE() AND (job.Jtitle LIKE '%$searchValue%' OR job.JdesBef LIKE '%$searchValue%' OR job.Jsalary='$searchValue' OR job.Jcity='$searchValue' OR job.distanceKm='$searchValue' OR job.Jcredits='$searchValue') ORDER BY Jid DESC ";
                           $query = "SELECT * FROM `job` WHERE job.JSts = 1 AND job.startDate <= CURDATE() AND (job.Jtitle LIKE '%$searchValue%' OR job.JdesBef LIKE '%$searchValue%' OR job.Jsalary='$searchValue' OR job.Jcity='$searchValue' OR job.distanceKm='$searchValue' OR job.Jcredits='$searchValue') ORDER BY Jid DESC ";
                            // print_r($query);die;
                                                    // echo "<script> alert('ok')</script>";

                       }else{
                        $querysett="SELECT * FROM `setting` WHERE Aid='$id'";
                    $setting = mysqli_query($conn,$querysett);
                    $check1 = mysqli_fetch_array($setting);
                    if (!empty($check1)) {
                      $queryset="SELECT * FROM `setting` WHERE Aid='$id'";
                    $runset = mysqli_query($conn,$queryset);
                      $rowset= mysqli_fetch_array($runset);
                      // $salary=$rowset["revenue"];
                      $km=$rowset["distance"];
                      $location=$rowset["location"];
                       if (empty($km)) {
                        $query="SELECT * FROM `job` WHERE JSts = 1
                         ORDER BY Jid DESC";
                        // $run = mysqli_query($conn,$query);
                       }else {
                         $query="SELECT * FROM `job` 
                         WHERE distanceKm <='$km' AND job.JSts=1 ORDER BY Jid DESC";
                       
                        // code...
                      }
                    }else{
                      $query = "SELECT * FROM `job` WHERE JSts=1 AND startDate <= CURDATE() ORDER BY Jid DESC";
                    }
                  }
                  // print_r($query);die;

                       // $query="SELECT * FROM `job` WHERE JSts = 1 AND endDate >= CURDATE() ORDER BY Jid DESC";
                    $run = mysqli_query($conn,$query);
                    if (mysqli_num_rows($run) > 0) {
                      // echo "<pre>";print_r(mysqli_fetch_assoc($run));die;
                      while ($row = mysqli_fetch_assoc($run)) {
                        // echo "<pre>";print_r($row);
                        // if ($row["JSts"]==1 AND $row["startDate"] >= $date ) {
                          
                          
               ?>
              
              <div class="col-lg-4">
              <div class="box">
              <div>
                   <h3 class="boxHeading">
                      
                   <?php echo isset($row['Jtitle']) ? $row['Jtitle'] : ""; ?>
                   </h3>
                  <p class="pt-2">
                  <?php echo isset($row['JdesBef']) ? substr($row['JdesBef'],0,70) : "" ?>
                   </p>
                   <p>
                       
                   </p>
                   <div class="view">
                      <a data-bs-toggle="collapse" href="#<?php echo str_replace(' ', '-', $row['Jtitle']); ?>"><i class="fa-solid fa-chevron-down me-1"></i>see more
                      </a>
                    </div>
                    <div class="collapse" id="<?php echo str_replace(' ', '-', $row['Jtitle']); ?>">
                 
                   <p class="mb-3" id="hidePara">
                      <?php echo isset($row['JdesBef']) ? substr($row['JdesBef'],70,2000) : "" ?>
                   </p>
             
               
                   </div>
                   
                   <div class="row g-4 text-center pt-4">
                      <div class="col-lg-4">
                        <h5> <?php echo $row['Jsalary'] ?></h5>
                        <p class="para">Salary</p>
                      </div>
                       <div class="col-lg-4">
                        <h5> <?php echo $row['distanceKm'] ?>KM</h5>
                        <p class="para">Distance</p>
                      </div>
                      <div class="col-lg-4">
                        <h5> <?php echo $row['Jcity'] ?></h5>
                        <p class="para">City</p>
                      </div>
                    </div>
                    <div class="text-center">
                      <?php 
                      $id = $_SESSION["id"];
                      //echo $id;
                      $sqli=mysqli_query($conn,"SELECT * FROM `buy` WHERE Aid='$id' AND Jid='".$row['Jid']."'");
                      $check = mysqli_fetch_array($sqli);
      ?>
      <?php    if (!empty($check)) {
        
       ?>
                      <a href="#" class="btn orderBtn" id="test" style="cursor: not-allowed;">Bought</a>
                    <?php }else{ ?>
                      <a href="buyjob.php?id=<?php echo $row['Jid']  ?>" class="btn orderBtn">Buy order</a>
                      <?php } ?>
                      <p class="paddignTop fontSize">
                        Job Starts From <span> <?php echo $row['startDate'] ?></span>
                      </p>
                      <p class="fontSize">
                        Job Ends In <span class="countdown-<?php echo $row["Jid"] ?>">
                            <?php if($row['endDate'] >= date('Y-m-d')){ ?>
                                <script type="text/javascript">
                            setInterval(function(){
                              var id = '<?php echo $row["Jid"] ?>'
                              var date = '<?php echo date('d',strtotime($row['endDate'])); ?>'
                              var month = '<?php echo date('F',strtotime($row['endDate'])); ?>'
                              var year = '<?php echo date('Y',strtotime($row['endDate'])); ?>'
                              var endTime = new Date(`${date} ${month} ${year}`);
                                endTime = (Date.parse(endTime) / 1000);
                                var now = new Date();
                                now = (Date.parse(now) / 1000);

                                var timeLeft = endTime - now;

                                var days = Math.floor(timeLeft / 86400); 
                                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                                var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
                                var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
                              
                                if (hours < "10") { hours = "0" + hours; }
                                if (minutes < "10") { minutes = "0" + minutes; }
                                if (seconds < "10") { seconds = "0" + seconds; }
                                if (days < 0) { days = 0; }

                                if(days <= 0 && hours <= 0 && minutes <= 0 && seconds <= 0){
                                    days=0;hours=0;minutes=0;seconds=0;
                                }

                                $(".countdown-"+id).html(`${days} Days ${hours} Hours ${minutes} Minutes ${seconds} Seconds Left`)
                            },1000);
                          </script>
                            <?php }else{ ?>
                                0 Days 0 Hours 0 Minutes 0 Seconds
                            <?php } ?>
                          </span>
                      </p>
                      <p class="fontSize">
                        To Buy This Job <b><?php echo $row['Jcredits'] ?> Credits</b>  Are Required.
                      </p>
                    </div>
                    
                   <!--<div class="row g-4 text-center pt-4">-->
                   <!--   <div class="col-lg-4">-->
                   <!--     <h6 style="font-weight:bold"><?php echo $row["Jsalary"]; ?>-->
                   <!--     </h6>-->
                   <!--     <p class="para">Salary</p>-->
                   <!--   </div>-->
                   <!--   <div class="col-lg-4">-->
                   <!--     <h6 style="font-weight:bold">Company Type</h6>-->
                   <!--     <p class="para">-->
                   <!--     <?php echo $row["ctype"]; ?>-->
                   <!--     </p>-->
                   <!--   </div>-->
                   <!--  <div class="col-lg-4">-->
                   <!--    <h6 style="font-weight:bold"> <?php echo $row["distanceKm"]; ?> km</h6>-->
                   <!--     <p class="para">from <?php echo ucfirst($row["Jcity"]); ?></p>-->
                   <!--  </div>-->
                   <!-- </div>-->
                   <div>
                        <?php
                         
                           $jidsts=$row['Jid'];
                            $sql_buy_sts="SELECT * FROM `buy`
                            WHERE Aid= '$id' AND Jid='$jidsts'";
                           $run_buy_sts = mysqli_query($conn,$sql_buy_sts);
                          $row_buy_sts= mysqli_fetch_array($run_buy_sts);
                            if ($row_buy_sts > 0) {
                           
                           } else {
                              if ($row["endDate"] >=  date('Y-m-d')) {
                                 ?>
                                <!--<button type="button" class="btn orderBtn" onclick="getFunc(<?php echo $row['Jid'];?>,'<?php echo $row['Jcredits']; ?>')" data-bs-toggle="modal" data-bs-target="#myModal">-->
                                <!--  Buy Order-->
                                <!-- </button>-->
                                 <?php
                             }else{
                              ?>
                            <!--  <button type="button" class="btn orderBtn" onclick="return confirm('This job is expired')" style='background-color:gray;'>-->
                            <!--  Buy Order-->
                            <!--</button>-->
                            <?php
                           }
                           }
                        ?>
                  <!-- <p class="paddignTop">-->
                  <!--Credits  <span><?php echo $row["Jcredits"]; ?> </span>-->
                  <!--   </p>-->
                   </div>
                 </div>
               </div>
               <div class="boxBootom">
               Lead #<?php echo $row['Jid'] ?>
                </div>
              </div>
                <?php 
                      }
                     // }
                    }else{
                     ?>
                     <div class="col-lg-6">
                       <div class="box">
                          <h2> Data Not Found. </h2>
                       </div>
                     </div>
                     <?php
                    }
                ?>
            </div>
          </div>
        </div>
      </div>
      
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/index.js"></script>

  </body>
</html>
<!-- The alert job Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Are you sure To buy job in  <span id="credit"></span> credits?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
           <input type="text" id="id" name="id" hidden>
           <input type="text" id="crd" name="credit" hidden>
        <button type="submit" class="btn btn-primary" name="save">Ok</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
     </form>
    </div>
  </div>
</div>


<script>
  function getFunc(jid,credit) {
// alert(jid+credit);
$("#id").val(jid);
$("#credit").text(credit);
$("#crd").val(credit);
}
</script>