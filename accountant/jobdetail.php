<?php 
        session_start();
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        $id = $_SESSION["id"];

        require_once("include/head.php");
        function calculatedistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
        {
            if(trim($latitudeFrom)=="" || $longitudeFrom == "" || $latitudeTo == "" || $longitudeTo == "")
            {
                return 0;
            }
            $theta    = $longitudeFrom - $longitudeTo;
            $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
            $dist    = acos($dist);
            $dist    = rad2deg($dist);
            $miles    = $dist * 60 * 1.1515;
            return round($miles * 1.609344, 2);
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
                                                        <a href="buycredit.php" class="btn creditsBtn">
                                                                Buy Credits</a>
                                                        </div>
                                                        <hr />
                                                        <div class="contact">
                                                                <div class="contactText">Your contact</div>
                                                                <?php 
                                                                        $sq="SELECT * FROM `accountant` LEFT JOIN city ON city.id = accountant.Acity WHERE Aid='$id'";
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
                                                <div class="packages">
                                                        <div class="creditsHeading">
                                                                <h2>Job Details</h2>
                                                        </div>
                                                        <?php 
                                                                if (isset($_GET["jddet"]))
                                                                {
                                                                        $jid=$_GET["jddet"];
                                                                        $query="SELECT buy.*,job.*,city.name as city_nm,city.lat,city.lng FROM `buy` JOIN job ON buy.Jid=job.Jid LEFT JOIN city ON city.id = job.Jcity WHERE buy.Aid= '$id' AND buy.Jid='$jid'";
                                                                        $run = mysqli_query($conn,$query);
                                                                        $row = mysqli_fetch_array($run);
                                                                }
                                                        ?>
                                                        <div class="table-responsive">
                                                                <table class="table table-striped" style="table-layout:fixed;">
                                                                        <thead>
                                                                                <tr>
                                                                                        <th>Title</th>
                                                                                        <td><?php echo $row["Jtitle"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Salary</th>
                                                                                        <td>
                                                                                            <?php
                                                                                                //echo $row["Jsalary"];
                                                                                                if($row['Jsalary']=='0')
                                                                                                {
                                                                                                        echo "Unknown";
                                                                                                }
                                                                                                else if($row['Jsalary']=='1')
                                                                                                {
                                                                                                        echo "€0.00-€50.000";
                                                                                                }
                                                                                                else if($row['Jsalary']=='2')
                                                                                                {
                                                                                                        echo "€50.000-€100.000";
                                                                                                }
                                                                                                else if($row['Jsalary']=='3')
                                                                                                {
                                                                                                        echo "€100.00-€250.000";
                                                                                                }
                                                                                                else if($row['Jsalary']=='4')
                                                                                                {
                                                                                                        echo "€250.00-€500.000";
                                                                                                }
                                                                                                else if($row['Jsalary']=='5')
                                                                                                {
                                                                                                        echo "500.000+";
                                                                                                }
                                                                                            ?>
                                                                                        </td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>City</th>
                                                                                        <td><?php echo $row["city_nm"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Distance From City</th>
                                                                                        <td id="dist">
                                                                                            <?php
                                                                                                echo calculatedistance($row["lat"], $row["lng"], $roww["lat"], $roww["lng"])." KM";
                                                                                            ?>
                                                                                        </td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Description.</th>
                                                                                        <td style="word-wrap:break-word;"><?php echo $row["jdesAft"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Start Date</th>
                                                                                        <td><?php echo $row["startDate"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>End Date</th>
                                                                                        <td><?php echo $row["endDate"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Job Bought Credits</th>
                                                                                        <td><?php echo $row["bcredits"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Job Bought Date</th>
                                                                                        <td><?php echo $row["buydate"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Company</th>
                                                                                        <td><?php echo $row["company"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Kvk Number</th>
                                                                                        <td><?php echo $row["kvk_number_customer"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Email</th>
                                                                                        <td><?php echo $row["email"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Phone</th>
                                                                                        <td><?php echo $row["phone"]; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th>Address</th>
                                                                                        <td><?php echo $row["street"];?>,<?php echo $row["postal"];?></td>
                                                                                </tr>
                                                                        </thead>
                                                                </table>
                                                                <a href="my leads1.php" class="btn btn-outline-info" ><i class="fas fa-angle-double-left"></i>Back</a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
                // console.log('<?php echo $row["lat"] ?>','<?php echo $row["lng"] ?>','<?php echo $roww["lat"] ?>','<?php echo $roww["lng"] ?>')
                //distanceCalculate('<?php echo $row["lat"] ?>','<?php echo $row["lng"] ?>','<?php echo $roww["lat"] ?>','<?php echo $roww["lng"] ?>')
                function distanceCalculate(lat1, lon1, lat2, lon2) {
                        
                        if ((lat1 == lat2) && (lon1 == lon2)) {
                                document.getElementById("dist").textContent = 0 + " KM";
                        }
                        else {
                                var radlat1 = Math.PI * lat1/180;
                                var radlat2 = Math.PI * lat2/180;
                                var theta = lon1-lon2;
                                var radtheta = Math.PI * theta/180;
                                var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                                if (dist > 1) {
                                        dist = 1;
                                }
                                dist = Math.acos(dist);
                                dist = dist * 180/Math.PI;
                                dist = dist * 60 * 1.1515;
                                dist = dist * 1.609344 
                                document.getElementById("dist").textContent = dist.toFixed(2) + " KM";
                        }
                }
        </script>
</body>
</html>
