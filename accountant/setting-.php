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
        $km=mysqli_real_escape_string($conn,$_POST["km"]);
        $revenue=mysqli_real_escape_string($conn,$_POST["revenue"]);
        $location=mysqli_real_escape_string($conn,$_POST["location"]);  
        $business_form=$_POST['business_form']; 
          $type_of_works=$_POST['type_of_work'];
          if(count($type_of_works) > 0){
            $work="";
            foreach($type_of_works as $type_of_work){
              $work .= $type_of_work.",";
            }
          }
        if(mysqli_num_rows($run) <= 0){
          
          mysqli_query($conn,"INSERT INTO `setting`(`distance`, `location`, `revenue`, `business_form`, `Aid`, `type of work`) VALUES ('".$km."','$location','$revenue','$business_form','$id','$work')");
        }else{
          $update_query = "UPDATE `setting` SET `distance`='$km',`business_form`='$business_form',`type of work`='$work',`location`='$location',`revenue`='$revenue' WHERE Aid='$id'";
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
        $business_form=$_POST['business_form']; 
        $type_of_works=$_POST['type_of_work'];
        $work="";  
        foreach($type_of_works as $type_of_work){
          $work .= $type_of_work.",";
        }
        // $place=mysqli_real_escape_string($conn,$_POST["place"]);

        $update_query = "UPDATE `setting` SET `distance`='$km',`business_form`='$business_form',`type of work`='$work' WHERE Aid='$id'";
          if (mysqli_query($conn,$update_query)) {
          echo " <script>alert('Setting Save Succesfully.')</script>";
          echo "<meta http-equiv='refresh' content='0;availableleads.php'>";


          }else{
            echo " <script>alert('data not saved.')</script>";

          }
      }
      
      if (isset($_POST["reset"])) {
       
        $update_query = "UPDATE `setting` SET `distance`='',`business_form`='',`type of work`='' WHERE Aid='$id'";
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
    <link rel="stylesheet" href="./css/setting-style.css" />
    <style type="text/css">
    .goog-te-banner-frame.skiptranslate {
        display: none !important;
    }
    body {
      top: 0px !important; 
    }
    </style>
    <title>Document</title>
  </head>
  <body>
    <!-- Header navbar-->
     <?php require_once("include/navbar.php") ?>
    <!-- main -->
    <main>
      <div class="container-fluid">
        <div class="row">
        
           <div class="col-lg-12">
            <div class="settings">
              <div class="settingsHeading">
                <h2>My settings</h2>
              </div>
              <form action="" method="post">
              <div class="row g-3">
                <div class="col-lg-8">
                  <div class="filterPlace">
                    <label for="">Filter place</label>
                    <input type="text" class="form-control inputBox" name="location"  value="<?php echo $row["location"] != "" ? $row["location"] : "" ?>" />
                  </div>
                  <div class="row align-items-center">
                    <div class="col-10">
                      <label for="">Filter range from place in KM</label>
                      <input
                        type="range"
                        class="form-range"
                        id="customRange1"
                        name="km"
                        value="<?php echo $row["distance"] != "" ? $row["distance"] : "" ?>"
                      />
                    </div>
                    <div class="col-2">
                      <div>
                        <span><?php echo $row["distance"] != "" ? $row["distance"] : ""; ?></span>
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
                  <div class="row align-items-center">
                    <div class="col-10">
                      <label for="">Filter turnover</label>
                      <input
                        type="range"
                        class="form-range"
                        id="customRange1"
                        name="revenue"
                        value="<?php echo $row["revenue"] != "" ? $row["revenue"] : "" ?>"
                      />
                    </div>
                    <div class="col-2">
                      <div>
                        <span><?php echo $row["revenue"] != "" ? $row["revenue"] : "" ?></span>
                      </div>
                    </div>
                  </div>
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
                    <label for="">Filter industries (several possible)</label>
                    <select
                      aria-placeholder="anc"
                      class="form-control selectpicker"
                      aria-label="Default select example"
                      data-live-search="true"
                      name="business_form"
                    >
                      <option value="">-Select-</option>
                      <option value="Particulier" <?php echo isset($row["business_form"]) && $row["business_form"] == "Particulier" ? "selected" : "" ?>>Particulier</option>
                      <option value="ZZP/Eenmanszaak" <?php echo isset($row["business_form"]) && $row["business_form"] == "ZZP/Eenmanszaak" ? "selected" : "" ?>>ZZP/Eenmanszaak</option>
                      <option value="V.O.F" <?php echo isset($row["business_form"]) && $row["business_form"] == "V.O.F" ? "selected" : "" ?>>V.O.F</option>
                      <option value="B.V" <?php echo isset($row["business_form"]) && $row["business_form"] == "B.V" ? "selected" : "" ?>>B.V</option>
                      <option value="Stichting/Vereniging" <?php echo isset($row["business_form"]) && $row["business_form"] == "Stichting/Vereniging" ? "selected" : "" ?>>Stichting/Vereniging</option>
                      <option value="Maatschap" <?php echo isset($row["business_form"]) && $row["business_form"] == "Maatschap" ? "selected" : "" ?>>Maatschap</option>
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
                      name="type_of_work[]"
                    >
                      <option value="Aangifte inkomstenbelasting" <?php echo isset($row["type of work"]) && in_array("Aangifte inkomstenbelasting", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Aangifte inkomstenbelasting</option>
                      <option value="Aangifte omzetbelasting btw" <?php echo isset($row["type of work"]) && in_array("Aangifte omzetbelasting btw", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Aangifte omzetbelasting btw</option>
                      <option value="Aangifte" <?php echo isset($row["type of work"]) && in_array("Aangifte", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Aangifte</option>
                      <option value="Volledige boekhouding" <?php echo isset($row["type of work"]) && in_array("Volledige boekhouding", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Volledige boekhouding</option>
                      <option value="Toezicht op de boekhouding" <?php echo isset($row["type of work"]) && in_array("Toezicht op de boekhouding", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Toezicht op de boekhouding</option>
                      <option value="Jaarrekening" <?php echo isset($row["type of work"]) && in_array("Jaarrekening", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Jaarrekening</option>
                      <option value="Accountantsverklaring" <?php echo isset($row["type of work"]) && in_array("Accountantsverklaring", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Accountantsverklaring</option>
                      <option value="Salarisadministratie" <?php echo isset($row["type of work"]) && in_array("Salarisadministratie", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Salarisadministratie</option>
                      <option value="Anders Toelichten bij opdrachtbeschrijving" <?php echo isset($row["type of work"]) && in_array("Anders Toelichten bij opdrachtbeschrijving", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Anders Toelichten bij opdrachtbeschrijving</option>
                      <option value="Salarisadministratie" <?php echo isset($row["type of work"]) && in_array("Salarisadministratie", explode(",",$row["type of work"])) ? "selected" : ""; ?>>Salarisadministratie</option>
                      <!-- <option value="Salarisadministratie">Salarisadministratie</option> -->
                    </select>
                  </div>
                  <div class="rightInput">
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
                  </div>
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
  </body>
</html>
