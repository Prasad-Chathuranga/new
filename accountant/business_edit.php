<?php
        session_start();
        include("include/connection.php"); 
        $id = $_GET["id"];
        $query2 ="select * from accountant where Aid = '$id'";
        $acc = mysqli_query($conn,$query2);
        $row1 = mysqli_fetch_array($acc);
        // $kvk_number =$row1["kvknumber"];

        $query="SELECT accountant.*,company.cname,company.cemail,company.caddress,company.cwebsite,company.cLogo,company.ctype,company.vat,
                company.cdesc,company.place,company.postal_code,company.street,company.house_number,company.kvk_accountant 
                FROM accountant
                left JOIN company ON accountant.cid=company.cid
                left JOIN companytype ON company.tid=companytype.tid
                WHERE Aid='$id'";
        
        $run = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($run);
        $kvk =$row["kvk_accountant"];

        $companytype = 'SELECT * FROM `companytype`';
        $typerun = mysqli_query($conn,$companytype);
        $bIsDataError = false;

        if (isset($_POST["update"])) {
                //echo "<pre>";print_r($_SESSION);die;
                //echo "<pre>";print_r($_POST);die;
                $phone = mysqli_real_escape_string($conn,$_POST["phone"]);
                if($phone){
                $insert_query = "UPDATE `accountant` SET `Aphone` = '$phone' WHERE `Aid` = $id";
                $typerun = mysqli_query($conn,$insert_query);
                }
                $tid=mysqli_real_escape_string($conn,$_POST["tid"]);
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
                $kvk_number=mysqli_real_escape_string($conn,$_POST["kvk_number"]);
                $imageUrl=$_FILES["aimg"]["name"];
                //$comt=mysqli_real_escape_string($conn,$_POST["company"]);
                $vatPattern = "/(?xi)^((NL)?[0-9]{9}B[0-9]{2})$/m";
                $bVATMatch = preg_match_all($vatPattern, $vat, $arrMatch);
                if($bVATMatch)
                {
                        $uid = $_SESSION["id"];
                        $queryo="SELECT * FROM `accountant` WHERE Aid='$uid'";
                        $runo = mysqli_query($conn,$queryo);
                        $rowo= mysqli_fetch_array($runo);
                        $cid=$rowo['cid'];

                        // echo $cid;die;
                        if($cid == 0){
                                $ins = mysqli_query($conn,"INSERT INTO `company`(`cname`, `cemail`, `caddress`, `cwebsite`, `cLogo`, `ctype`, `cdesc`, `tid`, `vat`, `place`, `postal_code`, `street`, `house_number`,`kvk_accountant`) VALUES ('".$name."','".$email."','".$address."','".$web."','','".$ctype."','".$desc."','".$tid."','".$vat."','".$place."','".$postal_code."','".$street."','".$house_number."','".$kvk_number."')");
                                $lastID=mysqli_insert_id($conn);
                                // mysqli_query($conn,"UPDATE `accountant` SET `kvknumber`= '".$kvk_number."',`cid` = '".$lastID."' WHERE `Aid` = $id");
                                mysqli_query($conn,"UPDATE `accountant` SET `cid` = '".$lastID."' WHERE `Aid` = $id");
                                $cid = $lastID;
                        }

                        // echo $cid;die;
                        if ($imageUrl=='') {
                                $insert_query = "UPDATE `company` SET `cname` = '$name', `cemail` = '$email', `caddress` = '$address', `cwebsite` = '$web', `cdesc` = '$desc',`ctype` = '$ctype',`tid` = '".$tid."',`vat` = '$vat',`place` = '$place',`postal_code` = '$postal_code',`street` = '$street',`house_number` = '$house_number', `kvk_accountant` = '$kvk_number' WHERE `company`.`cid` = $cid";
                                //   mysqli_query($conn,"UPDATE `accountant` SET `kvknumber`= '".$kvk_number."',`cid` = '".$lastID."' WHERE `Aid` = $id");
                                mysqli_query($conn,"UPDATE `accountant` SET `cid` = '".$lastID."' WHERE `Aid` = $id");
                                //   echo $insert_query;die;
                                if (mysqli_query($conn,$insert_query)) {
                                        echo " <script>alert('data have been Modify.')</script>";
                                        echo "<script>window.location.href = 'business.php';</script>";
                                }
                                else{
                                        $bIsDataError = true;
                                        echo " <script>alert('data not Modify.')</script>";
                                }
                        }
                        else{
                                $folder = "uploadedImages/".$imageUrl;
                                move_uploaded_file($_FILES['aimg']['tmp_name'],$folder); 
                                $insert_query = "UPDATE `company` SET `cname` = '$name', `cemail` = '$email', `caddress` = '$address', `cwebsite` = '$web', `cdesc` = '$desc',`cLogo`='$folder',`ctype` = '$ctype',`tid` = '".$tid."',`vat` = '$vat',`place` = '$place',`postal_code` = '$postal_code',`street` = '$street',`house_number` = '$house_number', `kvk_accountant` = '$kvk_number' WHERE `company`.`cid` = $cid";
                                
                                if (mysqli_query($conn,$insert_query)) {
                                        echo " <script>alert('data have been Modify.')</script>";
                                        echo "<script>window.location.href = 'business.php';</script>";
                                }
                                else{
                                        $bIsDataError = true;
                                        echo " <script>alert('data not Modify.')</script>";
                                }
                        }
                }
                else {
                        $bIsDataError = true;
                        echo " <script>alert('Incorrect VAT number.')</script>";
                }
        }
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
                <link rel="stylesheet" href="./css/company-style.css" />
                <link rel="stylesheet" href="./css/translate.css" />
                <title>Edit Compnay</title>
                <style>
                        /* Chrome, Safari, Edge, Opera */
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                        }

                        /* Firefox */
                        input[type=number] {
                                -moz-appearance: textfield;
                        }
                </style>
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
                                                                                <label for="" class="form-label formLabel">Company Name <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strCName = $row["cname"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strCName = mysqli_real_escape_string($conn,$_POST["name"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="text" name="name" class="form-control formControl text_num" <?php /*placeholder="Administratiekantoor BC"*/ ?> value="<?php echo $strCName; ?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">Company Address <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strAddress = $row["caddress"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strAddress = mysqli_real_escape_string($conn,$_POST["address"]);
                                                                                        }
                                                                                ?>
                                                                                <textarea required type="text" name="address" class="form-control formControl" <?php /*placeholder="Address"*/ ?>><?php echo $strAddress; ?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">E-mail <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strEmail = $row["cemail"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strEmail = mysqli_real_escape_string($conn,$_POST["email"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="email" name="email" class="form-control formControl" <?php /*placeholder="adm.bc@outlook.com"*/ ?> value="<?php echo $strEmail; ?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">Phone <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strPhone = $row["Aphone"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                //$strPhone = mysqli_real_escape_string($conn,$_POST["email"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="number" name="phone" class="form-control formControl" <?php /*placeholder="0634566680"*/ ?> value="<?php echo $strPhone;?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">VAT</label>
                                                                                <?php
                                                                                        $strVAT = $row["vat"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strVAT = mysqli_real_escape_string($conn,$_POST["vat"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="text" name="vat" id="vat" class="form-control formControl" <?php /*placeholder="NL000099998B57"*/ ?> value="<?php echo $strVAT; ?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">Website</label>
                                                                                <?php
                                                                                        $strWebSite = $row["cwebsite"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strWebSite = mysqli_real_escape_string($conn,$_POST["web"]);
                                                                                        }
                                                                                ?>
                                                                                <input  type="text" name="web" class="form-control formControl" <?php /*placeholder="www.administratiekantoor-bc.nI"*/ ?> value="<?php echo $strWebSite; ?>"/>
                                                                        </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">Business type <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strCType = $row["ctype"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strCType = mysqli_real_escape_string($conn,$_POST["ctype"]);
                                                                                        }
                                                                                ?>
                                                                                <select required class="form-select formSelect" name="ctype" onchange="getTID(this);">
                                                                                        <option <?php echo $strCType == "" ? "selected" : ""; ?>>Please Select Business type</option>
                                                                                        <option <?php echo $strCType == "Private Person" ? "selected" : "" ?> value="Private Person" data-value="1">Private Person</option>
                                                                                        <option <?php echo $strCType == "VOF" ? "selected" : "" ?> value="VOF" data-value="2">VOF</option>
                                                                                        <option <?php echo $strCType == "Foundation/ Association" ? "selected" : "" ?> value="Foundation/ Association" data-value="3">Foundation/ Association </option>
                                                                                        <option <?php echo $strCType == "Self Employed / Sole Proprietorship" ? "selected" : "" ?> value="Self Employed / Sole Proprietorship" data-value="4">Self Employed / Sole Proprietorship </option>
                                                                                        <option <?php echo $strCType == "BV" ? "selected" : "" ?> value="BV" data-value="5">BV</option>
                                                                                        <option <?php echo $strCType == "Partnership" ? "selected" : "" ?> value="Partnership" data-value="6">Partnership</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">Place <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strPlace = $row["place"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strPlace = mysqli_real_escape_string($conn,$_POST["place"]);
                                                                                        }
                                                                                ?>
                                                                                <input required  type="text" name='place' class="form-control formControl textonly" <?php /*placeholder="IJmuiden"*/ ?> value="<?php echo $strPlace; ?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">Postal Code <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strPostalCode = $row["postal_code"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strPostalCode = mysqli_real_escape_string($conn,$_POST["postal_code"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="text" name='postal_code' class="form-control formControl zipcode" <?php /*placeholder="1973 RE"*/ ?> value="<?php echo $strPostalCode; ?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">Street</label>
                                                                                <?php
                                                                                        $strStreet = $row["street"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strStreet = mysqli_real_escape_string($conn,$_POST["street"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="text" name='street' class="form-control formControl textonly" <?php /*placeholder="Grahamstraat"*/ ?>value="<?php echo $strStreet; ?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">House number <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strHouse = $row["house_number"];
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strHouse = mysqli_real_escape_string($conn,$_POST["house_number"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="number" name='house_number' class="form-control formControl" <?php /*placeholder="227"*/ ?>value="<?php echo $strHouse; ?>"/>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                                <label for="" class="form-label formLabel">KVK Number <span class="textRed">*</span></label>
                                                                                <?php
                                                                                        $strKVK = $kvk;
                                                                                        if($bIsDataError)
                                                                                        {
                                                                                                $strKVK = mysqli_real_escape_string($conn,$_POST["kvk_number"]);
                                                                                        }
                                                                                ?>
                                                                                <input required type="number" name='kvk_number' id="kvk_number" class="form-control formControl" value="<?php echo $strKVK; ?>"/>
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
                                                                        <?php
                                                                                $strDesc = $row["cdesc"];
                                                                                if($bIsDataError)
                                                                                {
                                                                                        $strDesc = mysqli_real_escape_string($conn,$_POST["desc"]);
                                                                                }
                                                                        ?>
                                                                        <textarea  name="desc" class="form-control formControl" rows="6" ><?php echo $strDesc; ?></textarea>
                                                                        <div>
                                                                                <input type="hidden" name="tid" id="tid" value="<?php echo isset($row["tid"]) ? $row["tid"] : ""; ?>">
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script type="text/javascript">
                        function getTID(data){
                                var value = $(data).find(':selected').data('value');
                                $("#tid").val(value);
                        }

                        $(document).ready(function(){
                                $('.textonly').keypress(function (e) {
                                        var regex = new RegExp("^[a-zA-Z ]+$");
                                        //var regex = new RegExp("/^[a-zA-Z ]+$/");
                                        var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                                        if (regex.test(strigChar)) {
                                                return true;
                                        }
                                        return false
                                });

                                /*$('.zipcode').keypress(function (e) {
                                        //var rege = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i;
                                        var regex = new RegExp("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i");
                                        //var regex = new RegExp("/^[a-zA-Z ]+$/");
                                        var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                                        if (regex.test(strigChar)) {
                                                return true;
                                        }
                                        return false
                                });*/
                                $('.zipcode').blur(function(){
                                        var zipcode = $(this).val();
                                        var rege = new RegExp('^[0-9]{4} [A-Z]{2}$');
                                        if(!(rege.test(zipcode)))
                                        {
                                                alert('Please enter postal code in 1234 AB format')
                                        }
                                });

                                $('#vat').blur(function(){
                                        console.log('in kvk');
                                        var vatNum = $(this).val();
                                        var rege = new RegExp('^NL[0-9]{9}B[0-9]{2}$');
                                        if(!(rege.test(vatNum)))
                                        {
                                                alert('Please enter VAT number in NLXXXXXXXXXBXX format')
                                        }
                                });

                                $('.text_num').blur(function(){
                                        var cmpany = $(this).val();
                                        var rege = new RegExp('^[a-zA-Z0-9 ]+$');
                                        if(!(rege.test(cmpany)))
                                        {
                                                alert('Company name can only have alpha numeric values')
                                        }
                                });

                                $('#kvk_number').blur(function(){
                                    var kvkNumber = $(this).val();
                                    var rege = new RegExp('^[0-9]{8}$');
                                    if(!(rege.test(kvkNumber)))
                                    {
                                            alert('KVK number can only be 8 digits');
                                            $(this).val("");
                                    }
                                });
                        })
                </script>
        </body>
</html>