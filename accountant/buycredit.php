<?php
        session_start();
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        require_once("include/head.php");

        // payment confirmation
        $nPaymentID = 0;
        if(isset($_GET["order_id"])){
                require_once "./payment/initialize.php";
                $paymentQuery = 'SELECT * FROM `payment` WHERE order_id="'.$_GET["order_id"].'"';
                $runQuery = mysqli_query($conn,$paymentQuery);
                $pdata = mysqli_fetch_assoc($runQuery);
                $payment_data = $mollie->payments->get($pdata["payment_id"]);
                $fp = fopen("payment_logs.txt", "a+");
                fwrite($fp, print_r($payment_data, true));
                fclose($fp);
                if(isset($payment_data) && $payment_data->status == "paid"){
                        $strStatus = $payment_data->status;
                        $strConsumerName = $payment_data->details->consumerName;
                        $strConsumerAccount = $payment_data->details->consumerAccount;
                        $strConsumerBIC = $payment_data->details->consumerBic;
                        $strPaidAt = date("Y-m-d H:i_s", strtotime($payment_data->paidAt));
                        
                        // echo "<pre>";print_r($pdata["id"]);die;
                        // echo 'UPDATE `payment` SET `status`="'.$payment_data->status.'",`message`="'.json_encode($payment_data).'" WHERE id='.$pdata["id"].'';die;
                        $q = "UPDATE `payment` SET `status`='".$payment_data->status."',`message`='".json_encode($payment_data)."', 
                                `customername`='".$strConsumerName."', `customeraccount`='".$strConsumerAccount."', `customerbic`='".$strConsumerBIC."',
                                `paidat`='".$strPaidAt."' WHERE id=".$pdata["id"]." ";
                        $update = mysqli_query($conn,$q);

                        $id = $_SESSION["id"];
                        if (isset($_GET["package"]))
                        {
                                $query="SELECT * FROM `packages` WHERE pid=".$_GET["package"];
                                $run = mysqli_query($conn,$query);
                                $row2 = mysqli_fetch_array($run);
                                $message = "Bought a ".$row2["ptitle"]." plan";
                                // echo " <script>alert('$price/$credit/$upload_directory')</script>";
                                $checkq="SELECT * FROM `total_credits` WHERE Aid='$id'";
                                $result = mysqli_query($conn,$checkq);
                                $check = mysqli_fetch_array($result);
                                if (!empty($check)) {
                                        $query="SELECT * FROM `total_credits` WHERE Aid='$id'";
                                        $run = mysqli_query($conn,$query);
                                        $row = mysqli_fetch_array($run);
                                        $remain= $row["tcr_amount"]+$row2['pcredits'];
                                        //echo "$remain";
                                        $xdate= $row2['pxdate'];
                                        $totcred="UPDATE `total_credits` SET `tcr_amount`='$remain',`tc_expiry`='$xdate' WHERE Aid='$id'";
                                        $data=mysqli_query($conn,$totcred);
                                        
                                        $insert= "INSERT INTO `buy_credit`( `credits`, `amount`, `crSts`, `Aid`, `bcr_date`,`pkg`, `payment_id`) 
                                                VALUES (".$row2['pcredits'].",'".$row2['pamount']."',1,'$id',now(),'".$row2['ptitle']."', '".$pdata["id"]."')";
                                        $data=mysqli_query($conn,$insert);
                                        if ($data==TRUE) {
                                                $insert_log= "INSERT INTO `credit_logs`(`Aid`, `credit`, `message`, `created`) VALUES ('$id','+".$row2['pcredits']."','$message',now())";
                                                $dataLog=mysqli_query($conn,$insert_log);
                                                echo " <script>alert('Success! Your request submit Successfully.')</script>";
                                                if($_SERVER['REMOTE_ADDR']!='119.160.97.144')
                                                {
                                                        echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
                                                }
                                        }
                                        else{
                                                echo " <script>alert('Error. credit not added.')</script>";
                                                //  echo "error :".$insert_query. "<br>". $conn->error."<br>";
                                                //  echo "error :".$update_query. "<br>". $conn->error."<br>";
                                        }
                                }
                                else{
                                        $date = date("Y-m-d");
                                        $insert1= "INSERT INTO `total_credits`( `tcr_amount`, `tc_expiry`,`tcr_creation`, `Aid`) 
                                                VALUES ('".$row2['pcredits']."','".$row2['pxdate']."','$date','$id')";
                                        $data=mysqli_query($conn,$insert1);
                                        $insert2= "INSERT INTO `buy_credit`( `credits`, `amount`, `crSts`, `Aid`, `bcr_date`,`pkg`, `payment_id`) 
                                                VALUES (".$row2['pcredits'].",'".$row2['pamount']."',1,'$id',now(),'".$row2['ptitle']."', '".$pdata["id"]."')";
                                        $data=mysqli_query($conn,$insert2);
                                        if ($data==TRUE) {
                                                $insert_log= "INSERT INTO `credit_logs`(`Aid`, `credit`, `message`, `created`) VALUES ('$id','+".$row2['pcredits']."','$message',now())";
                                                $dataLog=mysqli_query($conn,$insert_log);
                                                echo " <script>alert('Success! Your request submit Successfully.')</script>";
                                                //echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
                                        }
                                        else{
                                                echo " <script>alert('Error. credit not added.')</script>";
                                                //  echo "error :".$insert_query. "<br>". $conn->error."<br>";
                                                //  echo "error :".$update_query. "<br>". $conn->error."<br>";
                                        }
                                }
                        }


                        // echo $update;die;

                        /*$selectBuyCredit = "select max(bcr_id) as bcr_id from buy_credit where Aid=".$pdata['Aid'];
                        $runQueryBCredit = mysqli_query($conn,$selectBuyCredit);
                        $bCredit = mysqli_fetch_assoc($runQueryBCredit);



                        $strUpdateBCredit = "update buy_credit set payment_id=".$pdata["id"]." where bcr_id=".$bCredit['bcr_id'];
                        $runQueryBCredit2 = mysqli_query($conn,$strUpdateBCredit);*/
                }
                // echo "<pre>";print_r($payment_data);die;
                // echo "<pre>";print_r($getData);die;

                // $protocol = isset($_SERVER['HTTPS']) && \strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
                // $hostname = $_SERVER['HTTP_HOST'];
                // $path = \dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
                // echo "<p>Your payment status is '" . \htmlspecialchars($status) . "'.</p>";
                // die;
        }

        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $date = $year . '-' . $month . '-' . $day;
       
?>
<body>
        <!-- Header navbar-->
        <?php
                require_once("include/navbar.php");
                $id = $_SESSION['id'];
                $query="SELECT * FROM `total_credits` WHERE Aid= '$id'";
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
                                }
                                else{
                                        echo " <script>alert('Error. job not buy.')</script>";
                                        // echo "error :".$insert_query. "<br>". $conn->error."<br>";
                                        // echo "error :".$update_query. "<br>". $conn->error."<br>";
                                }
                        }
                        else {
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
                                        }
                                        else{
                                                echo " <script>alert('Error. credit not added.')</script>";
                                                //  echo "error :".$insert_query. "<br>". $conn->error."<br>";
                                                //  echo "error :".$update_query. "<br>". $conn->error."<br>";
                                        }
                                }
                                else{
                                        echo "<script> alert('Error. move upload')</script>";
                                }
                        }
                        else {
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
                                                                        $id = $_SESSION['id'];
                                                                        $querytc="SELECT * FROM `total_credits` WHERE Aid= '$id'";
                                                                        $runtc = mysqli_query($conn,$querytc);
                                                                        $rowtc = mysqli_fetch_array($runtc);
                                                                        if (empty($rowtc["tcr_amount"])) {
                                                                                echo "No";
                                                                        }
                                                                        else {
                                                                                echo $rowtc["tcr_amount"];
                                                                        }
                                                                ?>
                                                        credits</span> available for use
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
                        <div class="card p0">
                                <?php 
                                        $sql9 = "SELECT * FROM `advertisement` WHERE status = 1 ORDER BY RAND() LIMIT 1";
                                        $run9 = mysqli_query($conn,$sql9);
                                        $row9= mysqli_fetch_array($run9);
                                        if(mysqli_num_rows($run9)>0)
                                        {
                                                ?>
                                                <img src="./<?php echo $row9['image'] ?>" class="img-fluid" alt="" />
                                                <div class="paddingAll">
                                                        <div class="cardText">
                                                                <?php echo $row9['description'] ?>
                                                        </div>
                                                </div>
                                                <?php
                                        }
                                ?>
                                
                        </div>
                </div>
                <div class="col-lg-10 order-lg-0 order-1">
                        <div class="row g-4">
                                <?php 
                                        $query="SELECT `pid`, `ptitle`, `pcredits`, `pamount`, `psts`,`pxdate`,`pdesc` FROM `packages` WHERE `psts`=1";
                                        $run = mysqli_query($conn,$query);
                                        if (mysqli_num_rows($run) > 0) {
                                                while ($row = mysqli_fetch_array($run)) {
                                                        ?>
                                                        <div class="col-lg-4">
                                                                <div class="box">
                                                                        <div>
                                                                                <h3 style="border-Bottom:2px solid black;padding-bottom:5px;">
                                                                                        <?php echo $row["ptitle"]; ?>
                                                                                </h3>
                                                                                <p class="pt-2">
                                                                                        <!-- <?php echo $row["JdesBef"]; ?> -->
                                                                                </p>
                                                                                x<div class="row g-4 text-center pt-4">
                      <div class="col-lg-6">
                        <h6 style="font-weight:bold"><?php echo $row["pcredits"]; ?>
                         </h6>
                        <p class="para">Credits</p>
                      </div>
                      <div class="col-lg-6">
                        <h6 style="font-weight:bold"><i class="fa fa-euro"></i> <?php echo $row["pamount"]; ?></h6>
                        <p class="para">  
                        Amount

                        </p>
                      </div>
                      <?php
                      /*<div class="col-lg-4">
                        <h6 style="font-weight:bold"> <?php echo $row["pxdate"]; ?></h6>
                        <p class="para">  
                        Expiry Date

                        </p>
                      </div>*/
                      ?>
                       <div class="col-lg-12">
                        <p class="para">  
                        <?php echo substr($row["pdesc"],0,500); ?>
                        </p>
                      </div>
                    </div>
                    <div class="text-center">
                          <a href="payment.php?package=<?php echo $row["pid"]; ?>" class="btn orderBtn" >
                              Buy Now
                          </a>
                          <?php
                          /*<a href="buycredit.php?package=<?php echo $row["pid"]; ?>" class="btn orderBtn" >
                              Buy Now
                          </a> */ ?>
                    </div>
                  </div>
                </div>
                
              </div>
                <?php 
                      
                     }
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


