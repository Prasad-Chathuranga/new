<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        echo "<script>window.location.href='login.php'</script>";
    }
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
        <?php
            require_once("include/navbar.php"); 
            $id = $_SESSION["id"];
            
            $arrJobCount = array();
            $strQueryJobs = "select Jid from  job order by Jid";
            $runQueryJob = mysqli_query($conn,$strQueryJobs);
            while($rowJob=mysqli_fetch_assoc($runQueryJob))
            {
                $nJobID = $rowJob['Jid'];
                $arrJobCount["$nJobID"] = 0;
            }

            $strQueryJobCount = "select count(*) as cnt, Jid from buy where bSts=1 group by Jid";
            $runQueryJobCount = mysqli_query($conn,$strQueryJobCount);
            while ($rowJobCount = mysqli_fetch_assoc($runQueryJobCount)) {
                $nJobCount = $rowJobCount['cnt'];
                $nJobID = $rowJobCount['Jid'];
                $arrJobCount["$nJobID"] = $nJobCount;
            }


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
                      
                      $sq="SELECT * FROM `accountant` LEFT JOIN city ON city.id = accountant.Acity WHERE Aid='$id'";
                      $runn=mysqli_query($conn,$sq);
                      $roww=mysqli_fetch_array($runn);
                      //$to=$roww['kvknumber'];
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
                           $query = "SELECT * FROM `job` LEFT JOIN city ON city.id = job.Jcity WHERE job.JSts = 1 AND job.startDate <= CURDATE()  AND (job.Jtitle LIKE '%$searchValue%' OR job.JdesBef LIKE '%$searchValue%' OR job.Jsalary='$searchValue' OR job.Jcity='$searchValue' OR job.distanceKm='$searchValue' OR job.Jcredits='$searchValue') ORDER BY Jid DESC ";
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
                      $industry = $rowset["industory"];
                      $business = $rowset["business"];
                      $searchCities = $rowset['search_cities'];
                      $salary = $rowset['filtertrn'];
                      $where = "";
                        $whereSalary = "";
                      if(isset($salary) && $salary != ""){
                        $arrSearchSalary = explode(",", $salary);
                        $whereSalary .= " And (";
                        for($nCount=0;$nCount<count($arrSearchSalary); $nCount++)
                        {
                          $whereSalary .= " Jsalary LIKE '".$arrSearchSalary[$nCount]."' OR";
                        }
                        $whereSalary = rtrim($whereSalary,"OR");
                        $whereSalary .= ") ";
                      }
                      $where = $where.$whereSalary;
                      
                      /*if(isset($salary) && $salary != "0")
                      {
                        $where = " And Jsalary like '%".$salary."%'";
                      }*/
                      /*if(isset($industry) && $industry != ""){
                        $where .= " AND business_form LIKE '%".$industry."%' ";
                      }*/
                      $whereCities = "";
                      if(isset($searchCities) && $searchCities != ""){
                        $arrSearchCities = explode(",", $searchCities);
                        $whereCities .= " And (";
                        for($nCount=0;$nCount<count($arrSearchCities); $nCount++)
                        {
                          $whereCities .= " Jcity LIKE '".$arrSearchCities[$nCount]."' OR";
                        }
                        $whereCities = rtrim($whereCities,"OR");
                        $whereCities .= ") ";
                      }
                      $where = $where.$whereCities;
                      $whereIndustry = "";
                      if(isset($industry) && $industry != ""){
                        $arrIndustry = explode(",", $industry);
                        $whereIndustry = " And (";
                        for($nCount=0;$nCount<count($arrIndustry); $nCount++)
                        {
                          $whereIndustry .= " business_form LIKE '%".$arrIndustry[$nCount]."%' OR";
                        }
                        $whereIndustry = rtrim($whereIndustry,"OR");
                        $whereIndustry .= ") ";
                      }
                      $where = $where.$whereIndustry;

                      $whereBusiness = "";

                      if(isset($business) && $business != ""){
                        $string = explode(",",$business);
                        // print_r($string);die;
                        $whereBusiness = " AND (";
                        foreach($string as $key=>$val){
                            $whereBusiness .= " `type of work` LIKE '%".$val."%' OR";
                        }
                        $whereBusiness = rtrim($whereBusiness,"OR");
                        $whereBusiness .= ") ";
                        // print_r($where);die;
                        // $query="SELECT * FROM `job` LEFT JOIN city ON city.id = job.Jcity WHERE startDate <= CURDATE() AND job.JSts=1 AND business_form LIKE '%".$industry."%' ORDER BY Jid DESC";
                      }
                      $where = $where.$whereBusiness;

                      $query="SELECT * FROM `job` LEFT JOIN city ON city.id = job.Jcity WHERE startDate <= CURDATE() AND job.JSts=1 ".$where." ORDER BY Jid DESC";
                      /*if($_SERVER['REMOTE_ADDR']=='182.186.254.16')
                      {
                        echo $query;
                        exit;
                      }*/
                    //   if (empty($km)) {
                    //     $query="SELECT * FROM `job` WHERE JSts = 1 AND startDate <= CURDATE() ORDER BY Jid DESC";
                    //     // $run = mysqli_query($conn,$query);
                    //   }else {
                        //  $query="SELECT * FROM `job` LEFT JOIN city ON city.id = job.Jcity WHERE distanceKm <='$km' AND startDate <= CURDATE() AND job.JSts=1 ORDER BY Jid DESC";
                    //   $query="SELECT * FROM `job` LEFT JOIN city ON city.id = job.Jcity WHERE startDate <= CURDATE() AND job.JSts=1 ORDER BY Jid DESC";
                        // code...
                    //   }
                    }else{
                      $query = "SELECT * FROM `job` LEFT JOIN city ON job.Jcity = city.id WHERE JSts=1 AND startDate <= CURDATE() ORDER BY Jid DESC";
                    }
                  }
                //   print_r($query);die;
                //   print_r($km);die;

                       // $query="SELECT * FROM `job` WHERE JSts = 1 AND endDate >= CURDATE() ORDER BY Jid DESC";
                       //echo $query;
                       //exit;
                    $run = mysqli_query($conn,$query);
                    if (mysqli_num_rows($run) > 0) {
                      // echo "<pre>";print_r(mysqli_fetch_assoc($run));die;
                      while ($row = mysqli_fetch_assoc($run)) {
                        // echo "<pre>";print_r($row);
                        // if ($row["JSts"]==1 AND $row["startDate"] >= $date ) {
                          
                          
               ?>
              
              <div class="col-lg-4" id="jobBox-<?php echo $row["Jid"]; ?>">
              <div class="box">
              <div>
                    <h3 class="boxHeading">
                        <?php 
                            $id = $_SESSION["id"];
                            //echo $id;
                            $sqli=mysqli_query($conn,"SELECT * FROM `buy` WHERE Aid='$id' AND Jid='".$row['Jid']."'");
                            $check = mysqli_fetch_array($sqli);
                            if (!empty($check)) {
                                ?>     
                                <a href="jobdetail.php?jddet=<?php echo $row['Jid']?>" class="boxHeading"><?php echo isset($row['Jtitle']) ? $row['Jtitle'] : ""; ?></a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <!--<form action="buyjob.php">-->
                                    <!--  <input type="hidden" name="id" value="<?php echo $row['Jid']; ?>">-->
                                    <!--  <input type="hidden" id="distanceKm-<?php echo $row['Jid'] ?>" name="distanceKm" value="">-->
                                    <!--  <input type="submit" name="submit" value="Buy order" class="btn orderBtn">-->
                                <!--</form>-->
                                <?php
                                    echo isset($row['Jtitle']) ? $row['Jtitle'] : "";
                            }
                            
                        ?>


                      
                   
                   </h3>
                  <p class="pt-2">
                  <?php echo isset($row['JdesBef']) ? substr($row['JdesBef'],0,70) : "" ?>
                   </p>
                   <p>
                       
                   </p>
                   <div class="view">
                      <a data-bs-toggle="collapse" href="#job-<?php echo $row['Jid']; ?>"><i class="fa-solid fa-chevron-down me-1"></i>see more
                      </a>
                    </div>
                    <div class="collapse" id="job-<?php echo $row['Jid']; ?>">
                 
                   <p  style="word-break: break-all">
                      <?php 
                        if(isset($row['JdesBef']))
                        {
                                $strDisplay = str_replace(" ", '&nbsp;', substr($row['JdesBef'],70,2000));
                                echo nl2br($strDisplay);
                        }
                        else{
                                echo "";
                        }
                        ?>
                   </p>
             
               
                   </div>
                   
                   <div class="row g-4 text-center pt-4">
                      <div class="col-lg-4">
                        <h5> 
                                <?php
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
                        </h5>
                        <p class="para">Salary</p>
                      </div>
                       <div class="col-lg-4">
                        <h5> <?php //echo $row['distanceKm'] ?>KM</h5>
                        <h5 id="kms-<?php echo $row["Jid"]; ?>">
                                <?php
                                        echo calculatedistance($roww["lat"],  $roww["lng"], $row["lat"], $row["lng"]);
                                ?>
                        </h5>
                        <p class="para">Distance</p>
                      </div>
                      <div class="col-lg-4">
                        <h5> <?php echo $row['name'] ?></h5>
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
                    <?php }
                    else if($row['endDate']<date("Y-m-d"))
                    {
                        ?>
                        <a href="#" class="btn orderBtn" id="test" style="cursor: not-allowed;">Expired</a>
                        <?php
                    }
                    
                    else{ ?>
                      <!--<form action="buyjob.php">-->
                      <!--  <input type="hidden" name="id" value="<?php echo $row['Jid']; ?>">-->
                      <!--  <input type="hidden" id="distanceKm-<?php echo $row['Jid'] ?>" name="distanceKm" value="">-->
                      <!--  <input type="submit" name="submit" value="Buy order" class="btn orderBtn">-->
                      <!--</form>-->
                        <?php
                            $nJobID = $row['Jid'];
                            $nJobCount = $arrJobCount["$nJobID"];
                            if($nJobCount<3)
                            {
                                ?>
                                <a href="<?php echo 'buyjob.php?id='.$row['Jid'] ?>" class="btn orderBtn" onclick="return confirm('Are you suer to buy this lead?');">Buy order</a> 
                                <?php
                            }
                         } ?>
                      <script type="text/javascript">
                        // function distanceCalculate(lat1, lon1, lat2, lon2, unit="K") {
                          /*var distance = '<?php echo $km ?>' || null;
                          console.log(distance);
                          var id = '<?php echo $row['Jid'] ?>'
                          var lat1 =  '<?php echo $row["lat"] ?>'
                          var lon1 = '<?php echo $row["lng"] ?>'
                          var lat2 = '<?php echo $roww["lat"] ?>'
                          var lon2 = '<?php echo $roww["lng"] ?>'
                            if ((lat1 == lat2) && (lon1 == lon2)) {
                                document.getElementById("kms-"+id).textContent = 0;
                            } else {
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
                                // if (unit=="K") { 
                                dist = dist * 1.609344 
                                // }
                                // if (unit=="N") { dist = dist * 0.8684 }
                                document.getElementById("kms-"+id).textContent = dist.toFixed(2);
                                if(distance != null && distance > 0 && dist.toFixed(0) <= distance){
                                    console.log("ASDasd")
                                    document.getElementById("jobBox-"+id).style.display = "block";
                                }else{
                                    if(distance == null){
                                        console.log("NULL")
                                        document.getElementById("jobBox-"+id).style.display = "block";
                                    }else{
                                        document.getElementById("jobBox-"+id).style.display = "none";      
                                    }
                                }
                            }
                            console.log(dist.toFixed(0));*/
                        // }
                      </script>
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