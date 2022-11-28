<?php 
        session_start();
        require_once('include/connection.php'); 
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Forgot Password</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css"/>
                <link rel="stylesheet" href="./css/login.css" />
                <style>
                        .my-form {
                                background-image: url("img/bgl.jpg");
                                background-position: center;
                                background-size: cover;
                                padding-left: 4em;
                                background-blend-mode: multiply;
                                background-color: rgba(0, 0, 0, 0.4);
                        }
                </style>
        </head>
        <?php
                if(isset($_POST["submit"])){
                        $email = $_POST["email"];
                        $query = "SELECT * FROM accountant WHERE Aemail='$email'";
                        $run = mysqli_query($conn,$query);
                        if(mysqli_num_rows($run) > 0){
                                $row = mysqli_fetch_array($run);
                                $password = rand(00000,99999);
                                require_once "include/encryptor-master/EncryptorClass.php";
                                $objEncryptor = new Encryptor($password);
                                $strHash = $objEncryptor->hash;
                                $strSalt = $objEncryptor->salt;

                                // the message
                                $msg = "Hi\nYour password reset successfully\n\nYour new password :- ".$password."\n\nThanks";
                                // use wordwrap() if lines are longer than 70 characters
                                $msg = wordwrap($msg,70);
                                // send email
                                // print_r(mail($email,"Reset Password",$msg));die;
                                $to      = $email;
                                $subject = 'Reset Password';
                                $headers = 'From: webmaster@example.com'       . "\r\n" .
                                        'Reply-To: webmaster@example.com' . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion(). "\r\n";
                                if(@mail($to, $subject, $msg, $headers)){
                                        $updateQuery = "update `accountant` set
                                                        `pwd_hash`='".$strHash."',
                                                        `pwd_salt`='$strSalt'
                                                        where `Aid`='".$row["Aid"]."'";
                                        //$updateQuery = "UPDATE accountant SET Apassword='".$password."' WHERE Aid='".$row["Aid"]."'";
                                        $runQuery = mysqli_query($conn,$updateQuery);
                                        if($runQuery){
                                                ?>
                                                <script type="text/javascript">
                                                        alert("We have sent you mail. please check");
                                                        window.location.href = 'login.php';
                                                </script>
                                                <?php
                                        }
                                        else{
                                                ?>
                                                <script type="text/javascript">
                                                        alert("Password not reset")
                                                </script>
                                                <?php
                                        }
                                }
                                else{
                                        /*$updateQuery = "UPDATE accountant SET Apassword='".$password."' WHERE Aid='".$row["Aid"]."'";
                                        $runQuery = mysqli_query($conn,$updateQuery);
                                        if($runQuery){
                                                ?>
                                                <script type="text/javascript">
                                                        alert("Password Reset successfully")
                                                </script>
                                                <?php
                                        }
                                        else{
                                                ?>
                                                <script type="text/javascript">
                                                        alert("Password not reset")
                                                </script>
                                                <?php
                                        }*/
                                        ?>
                                        <script type="text/javascript">
                                                alert("error to send mail");
                                        </script>
                                        <?php
                                }
                        }
                        else{
                                ?>
                                <script type="text/javascript">
                                        alert("No email found");
                                        window.location.href = 'forgotPassword.php';
                                </script>
                                <?php
                        }
                }
                /*
                if(isset($_GET['Logout'])){
                        session_destroy();
                        header('Location:index.php');
                }
                if(isset($_POST['Login'])){
                        $Email=mysqli_real_escape_string($conn,$_POST['email']);
                        $Pass=mysqli_real_escape_string($conn,$_POST['password']);
                        $sql="SELECT * FROM accountant WHERE Aemail='$Email' AND Apassword='$Pass' AND ASts=1";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                                $Res=mysqli_fetch_assoc($result);
                                $_SESSION["id"] = $Res['Aid'];
                                $_SESSION['name'] = $Res['Aname'];
                                $_SESSION["usimg"] = $Res['Ai_mg'];
                                $_SESSION['nomb'] = $Res['Aphone'];
                                echo   "<script>alert('$se2/$ids');</script>";
                                echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
                                echo "<script>window.location.href='availableleads.php'</script>";
                                header("Location:availableleads.php?msg = succsess");
                        }
                        else{
                                header("Location:login.php?msgs=faild");
                        }
                }
                */
        ?>
        <body>
                <div class="row no-gutters">
                        <div class="col-md-5">
                                <div class="application-side">
                                        <div>
                                                <div class="brand">
                                                        Accountant
                                                        <div>Login</div>
                                                </div>
                                                <div>
                                                        <h1 class="text-white oddHeading">
                                                                Application <br />Login Page
                                                        </h1>
                                                        <div class="text-white">
                                                                Login or register form here to access
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-7">
                                <div class="my-form pb-5" id="form">
                                        <form method="post">
                                                <div class="login-form">
                                                        <?php 
                                                                if (isset($_GET['msgs'])) {
                                                                        echo "<p class='form-control bg-danger text-white' >Incorrect Email or Password  </p>";
                                                                }
                                                        ?>
                                                        <div class="form-group">
                                                                <label for="">Email</label>
                                                                <input autocomplete="off" class="form-control" type="email" placeholder="User Email" name="email" required/>
                                                                <a href="login.php" class="d-flex float-right">Back to login</a>
                                                                <button name="submit" type="submit" class="form-btn">Forgot Password</button>
                                                        </div>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>
                <script src="js/jquery-3.2.1.min.js"></script>
        </body>
</html>