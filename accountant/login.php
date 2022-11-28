<?php
        session_start();
        require_once('../connection.php'); 
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Login!</title>
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
                if(isset($_GET['Logout'])){
                        session_destroy();
                        header('Location:index.php');
                }
                if(isset($_POST['Login'])){     
                        $Email=mysqli_real_escape_string($conn,$_POST['email']);
                        $Pass=mysqli_real_escape_string($conn,$_POST['password']);

                        //$sql="SELECT * FROM accountant WHERE Aemail='$Email' AND Apassword='$Pass' AND ASts=1";
                        $sql="SELECT * FROM accountant WHERE Aemail='$Email' AND ASts=1";
                        $result=mysqli_query($conn,$sql);

                        
                        if(mysqli_num_rows($result)==1)
                        {
                                $row = mysqli_fetch_array($result);
                                // require_once "include/encryptor-master/EncryptorClass.php";
                                // $objDecryptor = new Decryptor($Pass, $row['pwd_salt']);
                                // if($objDecryptor->result == $row['pwd_hash'])
                                // {
                                        $_SESSION["id"] = $row['Aid'];
                                        $_SESSION['name'] = $row['Aname'];
                                        $_SESSION["usimg"] = $row['Ai_mg'];
                                        $_SESSION['nomb'] = $row['Aphone'];
                                        $_SESSION['admId'] = $row['admId'];
                                        header("Location:availableleads.php?msg = succsess");
                                // }
                                // else {
                                //         header("Location:login.php?msgs=faild");
                                // }
                        }
                        else {
                                header("Location:login.php?msgs=faild");
                        }
                        /*if(mysqli_num_rows($result)>0){
                                $Res=mysqli_fetch_assoc($result);
                                $_SESSION["id"] = $Res['Aid'];
                                $_SESSION['name'] = $Res['Aname'];
                                $_SESSION["usimg"] = $Res['Ai_mg'];
                                $_SESSION['nomb'] = $Res['Aphone'];
                                $_SESSION['admId'] = $Res['admId'];

                                //  echo   "<script>alert('$se2/$ids');</script>";
                                // echo "<meta http-equiv='refresh' content='0;availableleads.php'>";
                                // echo "<script>window.location.href='availableleads.php'</script>";
                                header("Location:availableleads.php?msg = succsess");
                        }
                        else{
                                header("Location:login.php?msgs=faild");
                        }*/
                }
        ?>
        <body>
                <div class="row no-gutters">
                        <div class="col-md-5">
                                <div class="application-side">
                                        <div>
                                                <div class="brand">
                                                        Accountant <div>Login</div>
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
                                        <form action="" method="post">
                                                <div class="login-form">
                                                        <?php 
                                                                if (isset($_GET['msgs'])) {
                                                                        echo "<p class='form-control bg-danger text-white' >Incorrect Email or Password  </p>";
                                                                }
                                                        ?>
                                                        <div class="form-group">
                                                                <label for="">Email</label>
                                                                <input autocomplete="off" class="form-control" type="email" placeholder="User Email" name="email" required/>
                                                                <label for="">Password</label>
                                                                <input class="form-control" type="password" placeholder="Password" name="password" required/>
                                                                <a href="forgotPassword.php" class="d-flex float-right">Forgot Password?</a>
                                                                <button name="Login" class="form-btn">Login</button>
                                                        </div>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>
                <script src="js/jquery-3.2.1.min.js"></script>
        </body>
</html>