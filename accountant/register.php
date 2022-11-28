<?php 
require_once('include/connection.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login!</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css"
    />
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
 
   if(isset($_POST['Register'])){   
     extract($_POST);  
     
     $sql="SELECT * FROM accountant WHERE Aemail='$Email'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
      echo " <script>alert('this Email Already Exist.')</script>";
  }else{
    if(mysqli_query($conn, "INSERT INTO accountant(Aemail, Apassword, ASts) VALUES ('$Email', '$password',1)")){
      $id = mysqli_insert_id($conn);
  $qury2=mysqli_query($conn, "INSERT INTO total_credits(tcr_amount, tcr_creation, Aid) VALUES (0, now(),'$id')");
  $quryset=mysqli_query($conn, "INSERT INTO setting(Aid) VALUES ('$id')");
 
  if ( $qury2 AND $quryset) {
      echo "<meta http-equiv='refresh' content='0;register.php?msgs=Success'>";
  }
    }else{
      alert("Your Registeration is Failed.");
      // echo mysqli_error($conn);
    }
  } 
  }
  ?>
  <body>
    <div class="row no-gutters">
      <div class="col-md-5">
        <div class="application-side">
          <div>
            <div class="brand">
              Accountant
              <div>Registration</div>
            </div>
            <div>
              <h1 class="text-white oddHeading">
                Application <br />
                Register  Now
              </h1>
              <div class="text-white">
                Login or register form here to access
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="my-form pb-2" id="form">
          <form action="" method="post" >
            <div class="login-form">
            <?php 
               if (isset($_GET['msgs'])) {
                  echo " <script>alert(' Registration Completed Please Login')</script>";
                  echo " <script>window.location.href='login.php';</script>";
                  
               }
            ?>
              <div class="form-group"> 
                 
                <label for="">Email</label>  
                <input autocomplete="off"
                  class="form-control"
                  type="email"
                  placeholder="Email.."
                  name="Email" required
                />               
                <label for="">Password</label>
                <input
                  class="form-control"
                  type="password"
                  placeholder="Password"
                  name="password"
                  id="password"
                  required=""
                />
                <label for="">Confirm Password</label>
                <input
                  class="form-control"
                  type="password"
                  placeholder="Password"
                  id="cpassword"
                  required=""
                />
                <button type="submit" name="Register" class="form-btn register">Register</button>
                <button class="form-btn"><a href="login.php">login</a> </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $("#cpassword").change(function (e) { 
        if($("#cpassword").val() != $("#password").val()){
          $("#password").val("");
          $("#cpassword").val("");
          alert("Password Does Not Match");
        }
        
      });
      
    </script>
  </body>
</html>
