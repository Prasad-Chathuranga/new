<?php
        session_start();
        if(!isset($_SESSION["id"])){
                header('Location:login.php?Logout=logout');
        }
        include("include/connection.php");
        
        if(isset($_POST["submit"])){
                $old_password = $_POST["old_password"];
                $new_password = $_POST["password"];
                $confirm_password = $_POST["confirm_password"];

                if($old_password == "" && $new_password == "" && $confirm_password == ""){
                        ?>
                        <script type="text/javascript">
                                alert("Please enter password");
                                window.location.href = 'change_password.php';
                        </script>
                        <?php
                }
                // print_r($_SESSION["id"]);die;

                $query = 'SELECT * FROM `accountant` WHERE Aid = "'.$_SESSION["id"].'"';
                $run = mysqli_query($conn,$query);
                // print_r($run);die;
                // $row = mysqli_fetch_array($run);

                if(mysqli_num_rows($run) > 0){
                        $row = mysqli_fetch_array($run);
                        // print_r($row);die;
                        
                        //exit;
                        require_once "include/encryptor-master/EncryptorClass.php";
                        $objDecryptor = new Decryptor($old_password, $row['pwd_salt']);
                        

                        //if($row["Apassword"] == $old_password){
                        if($objDecryptor->result == $row['pwd_hash']){
                                if($new_password == $confirm_password){
                                        
                                        $objEncryptor = new Encryptor($new_password);
                                        $strHash = $objEncryptor->hash;
                                        $strSalt = $objEncryptor->salt;

                                        //$update = mysqli_query($conn,'UPDATE `accountant` SET Apassword = "'.$new_password.'" WHERE Aid = "'.$_SESSION['id'].'"');
                                        $strQueryUpdate = "update `accountant` set
                                                        `pwd_hash`='".$strHash."',
                                                        `pwd_salt`='$strSalt'
                                                        where `Aid`='".$_SESSION['id']."'";
                                        $update = mysqli_query($conn,$strQueryUpdate);
                                        if($update){
                                                ?>
                                                <script type="text/javascript">
                                                        alert('password updated successfully');
                                                        window.location.href = 'availableleads.php';
                                                </script>
                                                <?php
                                        }
                                        else{
                                                ?>
                                                <script type="text/javascript">
                                                        alert('password not updated successfully');
                                                        window.location.href = 'change_password.php';
                                                </script>
                                                <?php
                                        }
                                }
                                else{
                                        ?>
                                        <script type="text/javascript">
                                                alert("Both Password does not match");
                                                window.location.href = 'change_password.php';
                                        </script>
                                        <?php
                                }
                        }
                        else{
                                ?>
                                <script type="text/javascript">
                                        alert("password does not match.!");
                                        window.location.href = 'change_password.php';
                                </script>
                                <?php
                        }
                }
                else{
                        ?>
                        <script type="text/javascript">
                                alert('user not found!!')
                        </script>
                        <?php
                }
        }
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <!-- CSS only -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
                <link rel="stylesheet" href="./css/available leads-style.css" />
                <link rel="stylesheet" href="./css/password.css" />
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
                <title>Password</title>
        </head>
        <body>
                <?php
                        require_once("include/navbar.php");
                ?>
                <div class="container">
                        <div class="row">
                                <div class="col-lg-6 mx-auto">
                                        <div class="passwordForm">
                                                <h1>Change Password</h1>
                                                <form id="changePassword" method="post">
                                                        <label for="">Old Passowrd</label>
                                                        <input type="password" name="old_password" id="" />
                                                        <label for="">New Passwor</label><small id="pwdmsg" style="display: none; color:#ca2127">8 Characters, upper and lower case alphabets, digits and special characters</small>
                                                        <input type="password" name="password"  id="password" />
                                                        <label for="">Confirm Passowrd</label>
                                                        <input type="password" name="confirm_password" id="" />
                                                        <input type="submit" name="submit" class="submitBtn" value="Submit">
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
                <script src="./js/index.js"></script>
        </body>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script>
            $('#password').blur(function(e){
        e.preventDefault();
        var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$");
        var password = $(this).val();
        if (regex.test(password)) {
            //return true;
            $('#pwdmsg').css("display", "none");
        }
        else
        {
            $(this).val("");
            $('#pwdmsg').css("display", "block");
            //alert('Password must be 8 characters long and include at least one upper case letter, one lower case letter, one integer and special character');
            $(this).focus();
        }
    });
        </script>
</html>