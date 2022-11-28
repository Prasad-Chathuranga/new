<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        echo "<script>window.location.href='login.php'</script>";
    }

    $id = $_SESSION["id"];
    require_once("include/head.php");
    if (isset($_POST["save"])) {
        $crid=$_POST["id"];
        $reson=$_POST["reason"];
        $query="SELECT * FROM `refund` WHERE bcr_id='$crid'";
        $run = mysqli_query($conn,$query);
        if (mysqli_num_rows($run) > 0) { 
            echo " <script>alert('You Already request for Refund of this Job.')</script>";
        }
        else{
            $insert_query2= "INSERT INTO `refund`(`requestdate`, `RSts`, `bcr_id`,`rdesc`) VALUES (now(),0,'$crid','$reson')";
            if (mysqli_query($conn,$insert_query2)) {
                echo " <script>alert('Success! Your request submited. It well be Approved soon from the Admin.')</script>";
                echo "<meta http-equiv='refresh' content='0;credits.php'>";
            }
            else{
                echo " <script>alert('refund request failed')</script>";
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
                                <div class="cardText">
                                        No Ad set
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-10 order-lg-0 order-1">
                <div class="packages">
                    <div class="creditsHeading">
                        <h2>My Bought Credits</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Counter</th>
                                    <th scope="col" class="tHeadColor">Created</th>
                                    <th scope="col" class="tHeadColor">Credits</th>
                                    <th scope="col" class="tHeadColor">Description</th>
                                    <th scope="col" class="tHeadColor">Expiry</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // $query="SELECT * FROM `buy_credit` as bc LEFT JOIN buy as b ON b.Aid = bc.Aid WHERE bc.Aid= '$id' ORDER BY bc.bcr_date DESC,b.buydate DESC ";
                                    $queryLastPackage = "select * from buy_credit where Aid='$id' order by bcr_id desc limit 0, 1";
                                    $runLastPackage = mysqli_query($conn,$queryLastPackage);
                                    $nCount = 1;
                                    if (mysqli_num_rows($runLastPackage) > 0)
                                    {
                                         while ($row = mysqli_fetch_array($runLastPackage)) {
                                            $pkg = $row["pkg"];
                                            $strQueryPackage = "select * from packages where ptitle = '$pkg'";
                                            $runPackage = mysqli_query($conn,$strQueryPackage);
                                            $rowPkg = mysqli_fetch_array($runPackage);
                                            ?>
                                            <tr>
                                                <td><?php echo $nCount;?>
                                                <td><b><?php echo $row["bcr_date"]; ?></b></td>
                                                <td><b><?php echo $row["credits"]; ?></b></td>
                                                <td><b><?php echo $row["pkg"]; ?></b></td>
                                                <td><b><?php echo $rowPkg['pxdate'];?></b></td>
                                            </tr>
                                            <?php
                                            $nCount = $nCount+1;
                                        }
                                    }
                                    $query = "SELECT * FROM `credit_logs` WHERE Aid = '$id' ORDER BY id desc ";
                                    $run = mysqli_query($conn,$query);
                                    if (mysqli_num_rows($run) > 0)
                                    {
                                        while ($row = mysqli_fetch_array($run)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $nCount;?>
                                                <td><?php echo $row["created"] ?></td>
                                                <td><?php echo $row["credit"] ?></td>
                                                <td><?php echo $row["message"] ?></td>
                                                <td><?php
                                                if($row["credit"][0]=='+'){
                                                   $amount = ltrim($row["credit"],$row["credit"][0]);
                                                   $sql9 = "SELECT pxdate from `packages` WHERE pcredits = '$amount'";
                                                    $run9 = mysqli_query($conn,$sql9);
                       
                                                $row9= mysqli_fetch_array($run9);
                                                echo $row9['pxdate'];
                                                }
                                                ?></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
                                            $nCount = $nCount+1;
                                        }
                                    }
                                    else{
                                        echo "No Data Found.";
                                        //die();
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                order : [[0, 'asc']],
                columnDefs: [
                    {
                        target: 0,
                        visible: false,
                        searchable: false,
                    },
                ],
            });
        });
    </script>
    <script>
        function getFunc(jid) {
            // alert(jid);
            $("#bid").val(jid);
        }
    </script>
</body>
</html>