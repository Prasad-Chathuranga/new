<?php 
        session_start();
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        //$date = $year . '-' . $month . '-' . $day;
        $date=date("Y-m-d");
        include('include/connection.php');
        $id = $_SESSION["id"];

        $query="SELECT * FROM `total_credits` WHERE Aid= '$id'";
        $run = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($run);

        if (isset($_POST["save"])) {
                $jid=mysqli_real_escape_string($conn,$_POST['id']);
                $credit=mysqli_real_escape_string($conn,$_POST['credit']);

                if($row["tcr_amount"]>=$credit){
                        $remain= $row["tcr_amount"]-$credit;
                        $insert_query= "INSERT INTO `buy`(`Jid`, `Aid`, `buydate`, `bcredits`, `bSts`) VALUES ('$jid','$id',now(),'$credit',1)";
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
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
                <link rel="stylesheet" href="./css/refunds-style.css?time=<?php echo time();?>" />
                <title>Refunds</title>
        </head>
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
                                                                You have <span><?php  
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
                                                                credits</span> available for use
                                                        </div>
                                                        <div>
                                                                <a href="buycredit.php" class="btn creditsBtn">Buy Credits</a>
                                                        </div>
                                                        <hr />
                                                        <div class="contact">
                                                                <div class="contactText">Your contact</div>
                                                                <div class="contactPerson">
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
                                                                                        <?php
                                                                                }
                                                                        ?>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="card p0">
                                                        <?php 
                                                                $sql9 = "SELECT * FROM `advertisement` WHERE status = 1 ORDER BY RAND() LIMIT 1";
                                                                $run9 = mysqli_query($conn,$sql9);
                                                                if(mysqli_num_rows($run9)>0)
                                                                {
                                                                        $row9= mysqli_fetch_array($run9);
                                                                        ?>
                                                                        
                                                                        <img src="./<?php echo $row9['image'] ?>" class="img-fluid" alt="" />
                                                                        <div class="paddingAll">
                                                                                <div class="cardText">
                                                                                        <?php echo $row9['description'] ?>
                                                                                </div>
                                                                        </div>
                                                                        <?php
                                                                }
                                                                else{
                                                                        ?>
                                                                        <div class="paddingAll">
                                                                                <div class="cardText">No Ad set</div>
                                                                        </div>
                                                                        <?php
                                                                }
                                                        ?>
                                                </div>
                                        </div>
                                
                        
                        <?php
                                $id=$_GET['id']; 
                                $sql="SELECT refund.*,job.Jtitle,job.JdesBef,job.Jcredits,job.startDate,job.endDate,admin.name FROM refund
                                        left join buy on buy.bid=refund.bid
                                        Left JOIN job ON job.Jid=buy.Jid 
                                        Left JOIN admin ON refund.amId=admin.id
                                        where  Rid='$id' "; 
                                $result = $conn -> query($sql);
                                if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($data = $result->fetch_assoc()) {
                                                //print_r($data);
                                                ?>
                                                <div class="col-lg-10 order-lg-0 order-1">
                                                        <div class="bgWhite">
                                                                <div class="table-responsive">
                                                                        <table class="table mb-0">
                                                                                <tbody>
                                                                                        <tr>
                                                                                                <td>Lead</td>
                                                                                                <td class="ps">
                                                                                                        <?php echo $data['Jtitle'] ?>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Gekocht</td>
                                                                                                <td class="ps"><?php echo  $data['startDate'] ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Datum aanvragen</td>
                                                                                                <td class="ps"><?php echo  $data['endDate'] ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Aangevraagde credits</td>
                                                                                                <td class="ps"><?php echo  $data['Jcredits'] ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>User Question</td>
                                                                                                <td class="ps"><?php echo  $data['rquestion'] ?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>Description</td>
                                                                                                <td class="ps"><?php echo  $data['rdesc'] ?></td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </div>
                                                                <div class="table-responsive">
                                                                        <table class="table mt-5">
                                                                                <thead>
                                                                                        <tr>
                                                                                                <th class="tableHeading">#</th>
                                                                                                <th class="tableHeading">Wanneer</th>
                                                                                                <th class="tableHeading">Status</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody class="tableBgColor">
                                                                                        <tr>
                                                                                                <td><?php echo  $data['Rid']; ?></td>
                                                                                                <td><?php echo  $data['requestdate']; ?></td>
                                                                                                <td>
                                                                                                        <div class="border-bottom">
                                                                                                                <?php
                                                                                                                        if($data['RSts']==1)
                                                                                                                        {
                                                                                                                                ?>
                                                                                                                                <div class="approvedText"><i class="fa-solid fa-check"></i> Approved</div>
                                                                                                                                <?php
                                                                                                                        }
                                                                                                                        else if($data['RSts']==2)
                                                                                                                        {
                                                                                                                                ?>
                                                                                                                                <div class="RejectedText"><i class="fa-solid fa-close"></i> Not Approved</div>
                                                                                                                                <?php
                                                                                                                        }
                                                                                                                        else
                                                                                                                        {
                                                                                                                                ?>
                                                                                                                                <div> Pending</div>
                                                                                                                                <?php
                                                                                                                        }
                                                                                                                        
                                                                                                                ?>
                                                                                                                
                                                                                                        </div>
                                                                                                        <?php
                                                                                                                if($data['RSts']==1 || $data['RSts']==2)
                                                                                                                {
                                                                                                                        ?>
                                                                                                                        <p>
                                                                                                                                <strong>Admin Response:</strong>&nbsp;<?php echo $data['admindesc']; ?>
                                                                                                                        </p>
                                                                                                                        <?php
                                                                                                                }
                                                                                                                if($data['RSts']==1)
                                                                                                                {
                                                                                                                        ?>
                                                                                                                        <p>Approved By:</p>
                                                                                                                        <?php echo  $data['name'] ?>
                                                                                                                        <?php
                                                                                                                }
                                                                                                                else if($data['RSts']==2)
                                                                                                                {
                                                                                                                        ?>
                                                                                                                        <p>Rejected By:</p>
                                                                                                                        <?php echo  $data['name'] ?>
                                                                                                                        <?php
                                                                                                                }
                                                                                                        ?>
                                                                                                        
                                                                                                        
                                                                                                </td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </div>
                                                        </div>
                                                </div>
                                                <?php
                                        } 
                                }
                        ?>
                </main>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
</html>