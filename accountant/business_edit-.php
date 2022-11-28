<?php
session_start();
include("include/connection.php"); 
$id = $_GET["id"];
$query="SELECT accountant.*,company.cname,company.cemail,company.caddress,company.cwebsite,company.cLogo,company.ctype,company.vat,company.cdesc,company.place,company.postal_code,company.street,company.house_number FROM accountant
      left JOIN company ON accountant.cid=company.cid
      left JOIN companytype ON company.tid=companytype.tid
      WHERE Aid='$id'";
$run = mysqli_query($conn,$query);
$row = mysqli_fetch_array($run);

$companytype = 'SELECT * FROM `companytype`';
$typerun = mysqli_query($conn,$companytype);

if (isset($_POST["update"])) {
  // echo "<pre>";print_r($_SESSION);die;
//   echo "<pre>";print_r($_POST);die;
          // $tid=mysqli_real_escape_string($conn,$_POST["name"]);
          $name=mysqli_real_escape_string($conn,$_POST["name"]);
          $email=mysqli_real_escape_string($conn,$_POST["email"]);
          $address=mysqli_real_escape_string($conn,$_POST["address"]);
          $desc=mysqli_real_escape_string($conn,$_POST["desc"]);
          $web=mysqli_real_escape_string($conn,$_POST["web"]);
          $vat=mysqli_real_escape_string($conn,$_POST["vat"]);
          $ctype=mysqli_real_escape_string($conn,$_POST["ctype"]);
          $place=mysqli_real_escape_string($conn,$_POST["place"]);
          $postal_code=mysqli_real_escape_string($conn,$_POST["postal_code"]);
          $street=mysqli_real_escape_string($conn,$_POST["street"]);
          $house_number=mysqli_real_escape_string($conn,$_POST["house_number"]);
          $imageUrl=$_FILES["aimg"]["name"];
          //$comt=mysqli_real_escape_string($conn,$_POST["company"]);
          $uid = $_SESSION["id"];
          $queryo="SELECT * FROM `accountant` WHERE Aid='$uid'";
      $runo = mysqli_query($conn,$queryo);
       
      $rowo= mysqli_fetch_array($runo);

       
        $cid=$rowo['cid'];
        // echo $cid;die;
        if($cid == 0){
            $ins = mysqli_query($conn,"INSERT INTO `company`(`cname`, `cemail`, `caddress`, `cwebsite`, `cLogo`, `ctype`, `cdesc`, `tid`, `vat`, `place`, `postal_code`, `street`, `house_number`) VALUES ('".$name."','".$email."','".$address."','".$web."','','".$ctype."','".$desc."','','".$vat."','".$place."','".$postal_code."','".$street."','".$house_number."')");   
            $lastID=mysqli_insert_id($conn);
            mysqli_query($conn,"UPDATE `accountant` SET `cid` = '".$lastID."' WHERE `Aid` = $id");
            $cid = $lastID;
        }
        // echo $cid;die;
        if ($imageUrl=='') {
          $insert_query = "UPDATE `company` SET `cname` = '$name', `cemail` = '$email', `caddress` = '$address', `cwebsite` = '$web', `cdesc` = '$desc',`ctype` = '$ctype',`vat` = '$vat',`place` = '$place',`postal_code` = '$postal_code',`street` = '$street',`house_number` = '$house_number' WHERE `company`.`cid` = $cid";
          
        //   echo $insert_query;die;
          if (mysqli_query($conn,$insert_query)) {
          echo " <script>alert('data have been Modify.')</script>";
          echo "<script>window.location.href = 'business.php';</script>";

          }else{
            echo " <script>alert('data not Modify.')</script>";

          }
        }else{
          $folder = "uploadedImages/".$imageUrl;
    move_uploaded_file($_FILES['aimg']['tmp_name'],$folder); 
          $insert_query = "UPDATE `company` SET `cname` = '$name', `cemail` = '$email', `caddress` = '$address', `cwebsite` = '$web', `cdesc` = '$desc',`cLogo`='$folder',`ctype` = '$ctype',`vat` = '$vat',`place` = '$place',`postal_code` = '$postal_code',`street` = '$street',`house_number` = '$house_number' WHERE `company`.`cid` = $cid";
             
          
          if (mysqli_query($conn,$insert_query)) {
          echo " <script>alert('data have been Modify.')</script>";
          echo "<script>window.location.href = 'business.php';</script>";

          }else{
            echo " <script>alert('data not Modify.')</script>";

          }
          
      }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <link rel="stylesheet" href="./css/company-style.css" />
    <!-- google transalte style -->
    <style>
      .goog-te-banner-frame.skiptranslate {
          display: none !important;
      }
      .goog-te-gadget-icon{
        display: none;
      }
      body {
        top: 0px !important; 
      }
    </style>
    <!-- google transalte style -->
    <title>Edit Compnay</title>
  </head>
  <body>
    <?php require_once("include/navbar.php"); ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-12">
          <div class="company mt-3">
            <div class="companyHeading">
              <h2>My company</h2>
            </div>
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >Company Name <span class="textRed">*</span></label
                    >
                    <input
                      required
                      type="text"
                      name="name"
                      class="form-control formControl"
                      placeholder="Administratiekantoor BC"
                      value="<?php echo $row["cname"] ?>"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >Company Address <span class="textRed">*</span></label
                    >
                    <textarea
                      required
                      type="text"
                      name="address"
                      class="form-control formControl"
                      placeholder="Address"
                    ><?php echo $row["caddress"] ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >E-mail <span class="textRed">*</span></label
                    >
                    <input
                      required
                      type="email"
                      name="email"
                      class="form-control formControl"
                      placeholder="adm.bc@outlook.com"
                      value="<?php echo $row["cemail"] ?>"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >Phone <span class="textRed">*</span></label
                    >
                    <input
                      required
                      type="number"
                      class="form-control formControl"
                      placeholder="06-34 56 66 80"
                      value="<?php echo $row["Aphone"] ?>"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel">VAT</label>
                    <input
                      required
                      type="text"
                      name="vat"
                      class="form-control formControl"
                      value="<?php echo $row["vat"] ?>"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel">Website</label>
                    <input
                      required
                      type="url"
                      name="web"
                      class="form-control formControl"
                      placeholder="www.administratiekantoor-bc.nI"
                      value="<?php echo $row["cwebsite"] ?>"
                    />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >Business type <span class="textRed">*</span></label
                    >
                    <select required class="form-select formSelect" name="ctype">
                      <?php /*while ($ctyperow = mysqli_fetch_assoc($typerun)) { ?>
                        <option <?php echo $row["tid"] == $ctyperow["tid"] ? "selected" : "" ?> value="<?php echo $ctyperow["tid"] ?>"><?php echo $ctyperow["ctype"]; ?></option>
                      <?php } */ ?>
                      <option <?php echo $row["ctype"] == "" ? "selected" : ""; ?>>Please Select Business type</option>
                      <option <?php echo $row["ctype"] == "Private Person" ? "selected" : "" ?> value="Private Person">Private Person</option>
                      <option <?php echo $row["ctype"] == "VOF" ? "selected" : "" ?> value="VOF">VOF</option>
                      <option <?php echo $row["ctype"] == "Foundation/ Association" ? "selected" : "" ?> value="Foundation/ Association">Foundation/ Association </option>
                      <option <?php echo $row["ctype"] == "Self Employed / Sole Proprietorship" ? "selected" : "" ?> value="Self Employed / Sole Proprietorship">Self Employed / Sole Proprietorship </option>
                      <option <?php echo $row["ctype"] == "BV" ? "selected" : "" ?> value="BV">BV</option>
                      <option <?php echo $row["ctype"] == "Partnership" ? "selected" : "" ?> value="Partnership">Partnership</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >Place <span class="textRed">*</span></label
                    >
                    <input
                      required
                      type="text"
                      name='place'
                      class="form-control formControl"
                      placeholder="IJmuiden"
                      value="<?php echo $row["place"] ?>"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >Postal Code <span class="textRed">*</span></label
                    >
                    <input
                      required
                      type="text"
                      name='postal_code'
                      class="form-control formControl"
                      placeholder="1973 RE"
                      value="<?php echo $row["postal_code"] ?>"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel">Street</label>
                    <input
                      required
                      type="text"
                      name='street'
                      class="form-control formControl"
                      placeholder="Grahamstraat"
                      value="<?php echo $row["street"] ?>"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label formLabel"
                      >House number <span class="textRed">*</span></label
                    >
                    <input
                      required
                      type="number"
                      name='house_number'
                      class="form-control formControl"
                      placeholder="227"
                      value="<?php echo $row["house_number"] ?>"
                    />
                  </div>
                </div>
                <div class="col-lg-6 pt-4">
                  <div class="mb-3">
                    <div>
                      <label for="" class="form-label formLabel">Logo</label>
                    </div>
                    <input type="file" name="aimg" accept="image/*" />
                  </div>
                </div>
                <div class="col-lg-6 pt-4">
                  <div class="text-end">
                    <img src="./<?php echo $row['cLogo'] ?>" class="img-fluid" alt="" />
                    <!-- <img src="./img/logo-small.png" class="img-fluid" alt="" /> -->
                  </div>
                </div>
                <div class="col-lg-12">
                  <label for="" class="form-label formLabel">Description</label>
                  <textarea
                    required
                    name="desc"
                    class="form-control formControl"
                    rows="6"
                  ><?php echo $row["cdesc"] ?></textarea>
                  <div>
                    <input type="submit" name="update" class="btn updatingBtn" value="Update">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
