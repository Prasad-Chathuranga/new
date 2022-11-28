<?php 
  include("include/connection.php"); 
  session_start();
  if (!isset($_SESSION["id"])) {
    echo "<script>window.location.href='login.php'</script>";
  }

  // require_once("include/head.php");
  $id = $_SESSION["id"];

  $query="SELECT * FROM `setting` WHERE Aid='$id'";
  $run = mysqli_query($conn,$query);
  $row= mysqli_fetch_array($run);

  if(isset($_POST["save"])){
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

    $queryAccountant = "SELECT * FROM `accountant` where Aid='$id'";
    $runAccountant = mysqli_query($conn,$queryAccountant);
    $rowAccountant = mysqli_fetch_array($runAccountant);

    $nAccountantCityId = $rowAccountant['Acity'];
    
    $queryAccountantCity = "SELECT * FROM `city` where id='$nAccountantCityId'";
    $runAccountantCity = mysqli_query($conn,$queryAccountantCity);
    $rowAccountantCity = mysqli_fetch_array($runAccountantCity);

    $strAccountCityLat = $rowAccountantCity['lat'];
    $strAccountCityLng = $rowAccountantCity['lng'];

    $queryAllCities = "SELECT * FROM `city`";
    $runAllCities = mysqli_query($conn,$queryAllCities);

    $strCities = "";

    $km=mysqli_real_escape_string($conn,$_POST["km"]);

    while($rstRow = mysqli_fetch_array($runAllCities))
    {
      $nDestinationCityId = $rstRow['id'];
      $strDestinationLat = $rstRow['lat'];
      $strDestinationLng = $rstRow['lng'];

      if($nDestinationCityId==$nAccountantCityId)
      {
        $strCities .= $nDestinationCityId.",";
      }
      else{
        $nDistance = calculatedistance($strAccountCityLat, $strAccountCityLng, $strDestinationLat, $strDestinationLng);
        if($nDistance<=$km)
        {
          $strCities .= $nDestinationCityId.",";
        }
      }

    }
    $strCities = rtrim($strCities,",");
    
    //$filtertrn=mysqli_real_escape_string($conn,$_POST["filtertrn"]);
    $filtertrnTemp = isset($_POST['filtertrn']) ? $_POST['filtertrn'] : array();
    $filtertrn = "";
    if(count($filtertrnTemp)>0)
    {
        foreach($filtertrnTemp as $onetrn)
        {
            $filtertrn .= $onetrn.",";
        }
        $filtertrn = rtrim($filtertrn, ",");
    }


    $location=mysqli_real_escape_string($conn,$_POST["location"]);
    $strTempIndustry = isset($_POST['industory']) ? $_POST['industory'] : array();
    $industory = "";
    //$industory=$_POST['industory']; 
    if(count($strTempIndustry) > 0){
      foreach($strTempIndustry as $type_of_industry){
        $industory .= $type_of_industry.",";
      }
      $industory = rtrim($industory,",");
    }

    $type_of_works=isset($_POST['business']) ? $_POST['business'] : array();
    $work="";
    if(count($type_of_works) > 0){
      foreach($type_of_works as $type_of_work){
        $work .= $type_of_work.",";
      }
      $work = rtrim($work,",");
    }

    // echo "<pre>";print_r($_POST);die;
    // echo "<pre>";print_r(mysqli_num_rows($run));die;
    if(mysqli_num_rows($run) <= 0){
      mysqli_query($conn,"INSERT INTO `setting`(`distance`,`filtertrn`, `location`, `nearby`, `industory`, `Aid`, `business`, `search_cities`) VALUES ('".$km."','".$filtertrn."','".$location."','on','".$industory."','".$id."','".$work."', '".$strCities."')");
      echo " <script>alert('Setting Save Succesfully.')</script>";
      echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
    }
    else{
      $update_query = "UPDATE `setting` SET `distance`='$km',`industory`='$industory',`business`='$work',`location`='$location',`filtertrn`='$filtertrn', `search_cities`='$strCities' WHERE Aid='$id'";
      if (mysqli_query($conn,$update_query)) {
        echo " <script>alert('Setting Save Succesfully.')</script>";
        echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
      }
    }
  }

      if (isset($_POST["savest"])) {
        // $tid=mysqli_real_escape_string($conn,$_POST["name"]);
        // $salary=mysqli_real_escape_string($conn,$_POST["salary"]);
        $km=mysqli_real_escape_string($conn,$_POST["km"]);
        $industory=$_POST['industory']; 
        $type_of_works=$_POST['type_of_work'];
        $work="";  
        foreach($type_of_works as $type_of_work){
          $work .= $type_of_work.",";
        }
        // $place=mysqli_real_escape_string($conn,$_POST["place"]);

        $update_query = "UPDATE `setting` SET `distance`='$km',`industory`='$industory',`business`='$work' WHERE Aid='$id'";
          if (mysqli_query($conn,$update_query)) {
          echo " <script>alert('Setting Save Succesfully.')</script>";
          echo "<meta http-equiv='refresh' content='0;availableleads.php'>";


          }else{
            echo " <script>alert('data not saved.')</script>";

          }
      }
      
      if (isset($_POST["reset"])) {
       
        $update_query = "UPDATE `setting` SET `distance`='',`industory`='',`business`='' WHERE Aid='$id'";
          if (mysqli_query($conn,$update_query)) {
          echo " <script>alert('Setting Reset Succesfully.')</script>";
          echo "<meta http-equiv='refresh' content='0;availableleads.php'>";


          }else{
            echo " <script>alert('data not saved.')</script>";

          }
      }
 ?>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    /> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/available leads-style.css" />
    <link rel="stylesheet" href="css/refunds-style.css" />
    <link rel="stylesheet" href="./css/setting-style.css" />
    <link rel="stylesheet" href="./css/translate.css" />
    <title>Document</title>
    <style type="text/css">
    .goog-te-banner-frame.skiptranslate {
        display: none !important;
    }
    body {
      top: 0px !important; 
    }
    </style>
  </head>
  <body>
    <!-- Header navbar-->
     <?php require_once("include/navbar.php") ?>
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
            <div class="settings">
              <div class="settingsHeading">
                <h2>My settings</h2>
              </div>
              <form action="" method="post">
              <div class="row g-3">
                <div class="col-lg-8">
                  <div class="filterPlace">
                    <label for="">Filter place</label>
                    <input type="text" class="form-control inputBox" name="location"  value="<?php echo isset($row["location"]) ? $row["location"] : "" ?>" />
                  </div>
                  <div class="row align-items-center">
                    <div class="col-10">
                      <label for="">Filter range from place in KM</label>
                      <input
                        type="range"
                        class="form-range"
                        id="customRange1"
                        name="km"
                        max="1000"
                        value="<?php echo isset($row["distance"]) ? $row["distance"] : "" ?>"
                        oninput="showKM(this.value)"
                        onchange="showKM(this.value)"
                      />
                    </div>
                    <div class="col-2">
                      <div>
                        <span id="di"><?php echo isset($row["distance"]) ? $row["distance"] : "50"; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row py-4">
                    <div class="col-lg-12">
                      <div class="form-check form-switch formSwitch">
                        <label for=""
                          >Collaboration possible throughout the
                          Netherlands</label
                        >
                        <div>
                          <input
                            class="form-check-input formCheckInput"
                            type="checkbox"
                            role="switch"
                            id="flexSwitchCheckChecked"
                            checked
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  /*<div class="row align-items-center">
                    <div class="col-10">
                      <label for="">Filter turnover</label>
                      <input
                        type="range"
                        class="form-range"
                        id="customRange1"
                        name="filtertrn"
                        value="<?php echo isset($row["filtertrn"]) ? $row["filtertrn"] : "" ?>"
                        oninput="showRevenue(this.value)"
                        onchange="showRevenue(this.value)"
                      />
                    </div>
                    <div class="col-2">
                      <div>
                        <span id="rv"><?php echo isset($row["filtertrn"]) ? $row["filtertrn"] : "50" ?></span>
                      </div>
                    </div>
                  </div>*/
                  ?>
                  <div class="row">
                    <div class="col-12">
                      <div>
                        <button class="btn settingBtn" type="submit" name="save">Update settings</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="rightInput mb-4">
                    <label for="">Filter industries </label>
                    <?php
                    /*<select
                      aria-placeholder="anc"
                      class="form-control selectpicker"
                      aria-label="Default select example"
                      data-live-search="true"
                      name="industory"
                    >
                      <option value="">-Select-</option>
                      <option value="Particulier" <?php echo isset($row["industory"]) && $row["industory"] == "Particulier" ? "selected" : "" ?>>Particulier</option>
                      <option value="ZZP/Eenmanszaak" <?php echo isset($row["industory"]) && $row["industory"] == "ZZP/Eenmanszaak" ? "selected" : "" ?>>ZZP/Eenmanszaak</option>
                      <option value="V.O.F" <?php echo isset($row["industory"]) && $row["industory"] == "V.O.F" ? "selected" : "" ?>>V.O.F</option>
                      <option value="B.V" <?php echo isset($row["industory"]) && $row["industory"] == "B.V" ? "selected" : "" ?>>B.V</option>
                      <option value="Stichting/Vereniging" <?php echo isset($row["industory"]) && $row["industory"] == "Stichting/Vereniging" ? "selected" : "" ?>>Stichting/Vereniging</option>
                      <option value="Maatschap" <?php echo isset($row["industory"]) && $row["industory"] == "Maatschap" ? "selected" : "" ?>>Maatschap</option>
                    </select>*/
                    ?>
                    <select
                      aria-placeholder="anc"
                      class="selectpicker"
                      multiple
                      aria-label="Default select example"
                      data-live-search="true"
                      data-actions-box="true"
                      name="industory[]"
                    >
                      <!-- <option value="">-Select-</option> -->
                      <option value="Particulier" <?php echo isset($row["industory"]) && in_array("Particulier", explode(",",$row["industory"])) ? "selected" : ""; ?>>Particulier</option>
                      <option value="ZZP/Eenmanszaak" <?php echo isset($row["industory"]) && in_array("ZZP/Eenmanszaak", explode(",",$row["industory"])) ? "selected" : ""; ?>>ZZP/Eenmanszaak</option>
                      <option value="V.O.F" <?php echo isset($row["industory"]) && in_array("V.O.F", explode(",",$row["industory"])) ? "selected" : ""; ?>>V.O.F</option>
                      <option value="B.V" <?php echo isset($row["industory"]) && in_array("B.V", explode(",",$row["industory"])) ? "selected" : ""; ?>>B.V</option>
                      <option value="Stichting/Vereniging" <?php echo isset($row["industory"]) && in_array("Stichting/Vereniging", explode(",",$row["industory"])) ? "selected" : ""; ?>>Stichting/Vereniging</option>
                      <option value="Maatschap" <?php echo isset($row["industory"]) && in_array("Maatschap", explode(",",$row["industory"])) ? "selected" : ""; ?>>Maatschap</option>
                    </select>
                  </div>
                  <div class="rightInput">
                    <label for=""
                      >Filter business type (several possible)</label
                    >
                    <select
                      aria-placeholder="anc"
                      class="selectpicker"
                      multiple
                      aria-label="Default select example"
                      data-live-search="true"
                      data-actions-box="true"
                      name="business[]"
                    >
                      <option value="Aangifte inkomstenbelasting" <?php echo isset($row["business"]) && in_array("Aangifte inkomstenbelasting", explode(",",$row["business"])) ? "selected" : ""; ?>>Aangifte inkomstenbelasting</option>
                      <option value="Aangifte omzetbelasting btw" <?php echo isset($row["business"]) && in_array("Aangifte omzetbelasting btw", explode(",",$row["business"])) ? "selected" : ""; ?>>Aangifte omzetbelasting btw</option>
                      <option value="Aangifte" <?php echo isset($row["business"]) && in_array("Aangifte", explode(",",$row["business"])) ? "selected" : ""; ?>>Aangifte</option>
                      <option value="Volledige boekhouding" <?php echo isset($row["business"]) && in_array("Volledige boekhouding", explode(",",$row["business"])) ? "selected" : ""; ?>>Volledige boekhouding</option>
                      <option value="Toezicht op de boekhouding" <?php echo isset($row["business"]) && in_array("Toezicht op de boekhouding", explode(",",$row["business"])) ? "selected" : ""; ?>>Toezicht op de boekhouding</option>
                      <option value="Jaarrekening" <?php echo isset($row["business"]) && in_array("Jaarrekening", explode(",",$row["business"])) ? "selected" : ""; ?>>Jaarrekening</option>
                      <option value="Accountantsverklaring" <?php echo isset($row["business"]) && in_array("Accountantsverklaring", explode(",",$row["business"])) ? "selected" : ""; ?>>Accountantsverklaring</option>
                      <option value="Salarisadministratie" <?php echo isset($row["business"]) && in_array("Salarisadministratie", explode(",",$row["business"])) ? "selected" : ""; ?>>Salarisadministratie</option>
                      <option value="Anders Toelichten bij opdrachtbeschrijving" <?php echo isset($row["business"]) && in_array("Anders Toelichten bij opdrachtbeschrijving", explode(",",$row["business"])) ? "selected" : ""; ?>>Anders Toelichten bij opdrachtbeschrijving</option>
                      <option value="Salarisadministratie" <?php echo isset($row["business"]) && in_array("Salarisadministratie", explode(",",$row["business"])) ? "selected" : ""; ?>>Salarisadministratie</option>
                      <!-- <option value="Salarisadministratie">Salarisadministratie</option> -->
                    </select>
                  </div>
                  <div class="rightInput mb-4">
                    <label for="">Filter turnover</label>
                    <select
                      aria-placeholder="anc"
                      class="form-control selectpicker"
                      aria-label="Default select example"
                      data-live-search="true"
                      data-actions-box="true"
                      id="customRange1"
                      name="filtertrn[]"
                      multiple
                    >
                      <option value="1" <?php echo isset($row["filtertrn"]) && in_array("1", explode(",",$row["filtertrn"])) ? "selected" : ""; ?>>€0.00-€50.000</option>
                      <option value="2" <?php echo isset($row["filtertrn"]) && in_array("2", explode(",",$row["filtertrn"])) ? "selected" : ""; ?>>€50.000-€100.000</option>
                      <option value="3" <?php echo isset($row["filtertrn"]) && in_array("3", explode(",",$row["filtertrn"])) ? "selected" : ""; ?>>€100.00-€250.000</option>
                      <option value="4" <?php echo isset($row["filtertrn"]) && in_array("4", explode(",",$row["filtertrn"])) ? "selected" : ""; ?>>€250.00-€500.000</option>
                      <option value="5" <?php echo isset($row["filtertrn"]) && in_array("5", explode(",",$row["filtertrn"])) ? "selected" : ""; ?>>500.000+</option>
                      
                      <?php
                        //for($i=1; $i<=100; $i++)
                        //{
                          /*?>
                          <option value="<?php echo $i;?>" <?php if($i==$row["filtertrn"]) { ?> selected <?php } ?>><?php echo $i;?></option>
                          <?php*/
                          ?>
                          


                          <?php
                        //}
                      ?>
                    </select>
                  </div>
                  <!-- <div class="rightInput">
                    <label for=""
                      >Filter assignment type (several possible)</label
                    >
                    <select
                      aria-placeholder="anc"
                      class="selectpicker"
                      multiple
                      aria-label="Default select example"
                      data-live-search="true"
                    >
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                      <option value="5">Five</option>
                      <option value="6">Six</option>
                      <option value="7">Seven</option>
                      <option value="8">Eight</option>
                    </select>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          </form>
                    <!-- <div class="col-lg-3">
                      <div class="filterPlace">
                        <label for="">Filter Salary.</label>

                          <select name="salary" class="form-control" required>               
                            <option disabled selected value="">Filter Salary.</option> 
                            <option value="Unknown" <?php if("Unknown"==$row['revenue']){ echo "SELECTED"; } ?>>Unknown</option>
                            <option value="€0.00-€50.000" <?php if("€0.00-€50.000"==$row['revenue']){ echo "SELECTED"; } ?>>€0.00-€50.000</option>
                            <option value="€50.000-€100.000" <?php if("€50.000-€100.000"==$row['revenue']){ echo "SELECTED"; } ?>>€50.000-€100.000</option>
                            <option value="€100.00-€250.000" <?php if("€100.00-€250.000"==$row['revenue']){ echo "SELECTED"; } ?>>€100.00-€250.000</option>
                            <option value="€250.00-€500.000" <?php if("€250.00-€500.000"==$row['revenue']){ echo "SELECTED"; } ?>>€250.00-€500.000</option>
                            <option value="500.000+" <?php if("500.000+"==$row['revenue']){ echo "SELECTED"; } ?>>500.000+</option>
        
                        </select>
                      </div>
                      
                    </div>
                    <div class="col-lg-3">
                      <div class="filterPlace">
                        <label for="">Filter place</label>

                        <select name="place" class="form-control" required>              
                          <option disabled selected value="">Filter place</option> 

                              <?php 
                                // $query_com="SELECT DISTINCT Jcity FROM `job`";
                                // $run_com = mysqli_query($conn,$query_com);
                                //   while ($row_com = mysqli_fetch_array($run_com)) {
                              ?>
                                  <option value="<?php echo $row_com['Jcity']; ?>" <?php 
                                  // if($row_com['Jcity']==$row['location']){ echo "SELECTED"; } 
                                   ?> ><?php echo $row_com['Jcity']; ?></option>
                              <?php
                            //  } 
                             ?>
                          </select>
                      </div>
                    </div> -->
                    <!--<div class="col-lg-3"><br>-->
                    <!--  <div class="rightInput d-flex">-->
                    <!--    <input-->
                    <!--      type="submit" name="savest"-->
                    <!--      class="btn btn-success"-->
                    <!--      placeholder="Accountant" value="Save Setting"-->
                    <!--      onclick="return confirm('Are you Sure to save this setting.!')"-->
                    <!--    />-->
                    <!--    </form>-->
                    <!--    <form action="" method="post">-->
                    <!--    <input-->
                    <!--      type="submit" name="reset"-->
                    <!--      class="btn btn-danger"-->
                    <!--      placeholder="Accountant" value="Reset Setting"-->
                    <!--      onclick="return confirm('Are you Sure Reset the job to default setting.!')"-->
                    <!--    />-->
                    <!--    </form>-->
                    <!--    </center>-->
                    <!--  </div>-->
                    <!--</div>-->
          
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
      function showKM(newVal){
          document.getElementById("di").innerHTML=newVal;
      }
      function showRevenue(newVal){
          document.getElementById("rv").innerHTML=newVal;
      }

      $(document).ready(function(){
        $(".bs-select-all").removeClass('btn-light');
        $(".bs-select-all").addClass('btn-success');

        $(".bs-deselect-all").removeClass('btn-light');
        $(".bs-deselect-all").addClass('btn-danger');
      })

      $(".bs-select-all").on('click', function() {
    
      });

    $(".bs-deselect-all").on('click', function() {

    });
     
    </script>
  </body>
</html>
