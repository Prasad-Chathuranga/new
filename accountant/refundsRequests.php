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
<script>
        function myFunction() {
                const date2 = new Date(document.getElementById("outDate").value);
                console.log(date2);
                const date1 = new Date(document.getElementById("inDate").value);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                document.getElementById("stay").value= diffDays;
                console.log('diffDays');
        }
</script>
<body>
        <!-- Header navbar-->
        <?php
                require_once("include/navbar.php");
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
                                        <!-- <div class="card p0" style="visibility:hidden">
                                                <div class="cardTopBg">
                                                        <span>Business</span>
                                                </div>
                                                <div class="cardLink">
                                                        <ul>
                                                                <li>
                                                                        <a href="">Overview</a>
                                                                </li>
                                                                <li>
                                                                        <a href="">Contact</a>
                                                                </li>
                                                                <li>
                                                                        <a href="">Subsidiaries</a>
                                                                </li>
                                                        </ul>
                                                </div>
                                        </div> -->
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
                                        <div class="bgWhite">
                                                <h2 class="refundRequests">My Refund Requests</h2>
                                                <div class="table-responsive">
                                                        <table class="table mb-0">
                                                                <thead>
                                                                        <tr>
                                                                            <th scope="col">Lead ID</th>
                                                                            <th scope="col">Lead Title</th>
                                                                            <th scope="col">Company</th>
                                                                            <th scope="col">Refund request date</th>
                                                                            <th scope="col">Request</th>
                                                                            <th scope="col">Admin Response</th>
                                                                            <th scope="col">Purchased</th>
                                                                            <th scope="col">Status</th>
                                                                            <th scope="col"></th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <?php 
                                                                                $id = $_SESSION["id"];
                                                                                //$query="SELECT * FROM `refund` WHERE Aid ='$id' ORDER BY Aid DESC";
                                                                                $query = "select ref.*, 
                                                                                        buy.bcredits, buy.Aid, 
                                                                                        job.Jid, job.Jtitle, job.company, job.email as jemail,
                                                                                        acc.Aname, acc.Aemail
                                                                                        from refund ref
                                                                                        join buy on ref.bid=buy.bid
                                                                                        join job on job.Jid=buy.Jid
                                                                                        join accountant acc on acc.Aid=buy.Aid
                                                                                        WHERE ref.Aid ='$id'
                                                                                        order by ref.requestdate desc";
                                                                                    
                                                                                $run = mysqli_query($conn,$query);
                                                                                if (mysqli_num_rows($run) > 0) {
                                                                                        while ($row = mysqli_fetch_array($run)) {
                                                                                                ?>
                                                                                                <tr>
                                                                                                        <td class="tData"><?php echo $row['Jid'] ?></td>
                                                                                                        <td class="tData"><?php echo $row['Jtitle'] ?></td>
                                                                                                        <td class="tData"><?php echo $row['company'] ?></td>
                                                                                                        <td class="tData">
                                                                                                                <?php
                                                                                                                        $date=$row['requestdate'];
                                                                                                                        echo  date('d-m-Y', strtotime($date));
                                                                                                                ?>
                                                                                                        </td>
                                                                                                        <td class="tData"><?php echo $row['rdesc'] ?></td>
                                                                                                        <td class="tData"><?php echo $row['admindesc'] ?></td>
                                                                                                        <td class="tData">
                                                                                                                <?php 
                                                                                                                        $bcr=$row['bid'];
                                                                                                                        $query2="SELECT * FROM `buy` WHERE bid ='$bcr'";
                                                                                                                        
                                                                                                                        $run2 = mysqli_query($conn,$query2);
                                                                                                                        $row2 = mysqli_fetch_array($run2);
                                                                                                                        echo $row2['buydate'];
                                                                                                                ?>
                                                                                                        </td>
                                                                                                        <td class="tData">
                                                                                                                <?php
                                                                                                                        if ($row['RSts']=='1') {
                                                                                                                                // code...
                                                                                                                                ?>
                                                                                                                                <a href="./refunds.php?id=<?php echo $row['Rid']; ?>" class="btn  ApprovedText text-white">Approved</a>
                                                                                                                                <?php
                                                                                                                        }
                                                                                                                        elseif ($row['RSts']=='2')
                                                                                                                        {
                                                                                                                                ?>
                                                                                                                                <a>Rejected</a>
                                                                                                                                <?php
                                                                                                                        }
                                                                                                                        else{
                                                                                                                                ?>
                                                                                                                                <a>Pending</a>
                                                                                                                                <?php
                                                                                                                        }
                                                                                                                ?>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <a href="refunds.php?id=<?php echo $row['Rid'];?>" class="btn tableBtn">
                                                                                                                        <i class="fa-solid fa-scale-balanced"></i>
                                                                                                                </a>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                        ?>
                                                                </tbody>
                                                        </table>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>