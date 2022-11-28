<?php 
include('connection.php');


  //////////////////////// insert company type  //////////////////////////////////
if (isset($_POST["savejob"])) {
   
  $query="SELECT * FROM `company` ORDER by cid DESC";
  $run = mysqli_query($conn,$query);
  $row= mysqli_fetch_array($run);
  $lastid =  $row["cid"]+1;
  $name=mysqli_real_escape_string($conn,$_POST["name"]);
  $salary=mysqli_real_escape_string($conn,$_POST["salary"]);
  $dist=mysqli_real_escape_string($conn,$_POST["distance"]);
  $city=mysqli_real_escape_string($conn,$_POST["city"]);
  $sdate=mysqli_real_escape_string($conn,$_POST["sdate"]);
  $ldate=mysqli_real_escape_string($conn,$_POST["ldate"]);
  $descb=mysqli_real_escape_string($conn,$_POST["descBef"]);
  $email=mysqli_real_escape_string($conn,$_POST["email"]);
  $web=mysqli_real_escape_string($conn,$_POST["website"]);
  $address=mysqli_real_escape_string($conn,$_POST["address"]);
  $cname=mysqli_real_escape_string($conn,$_POST["cname"]);
  // echo "<script> alert('$name/$email/$contact/$address/$desc/$company')</script>";
              $sql2 = ("INSERT INTO `job`(`Jtitle`, `Jsalary`, `JdesBef`,`Jcity`, `distanceKm`, `Jcredits`, `startDate`, `endDate`,`company`, `address`, `email`, `website`) VALUES ('$name','$salary','$descb','$city','$dist','0','$sdate','$ldate','$cname','$address','$email','$web')");
                if (mysqli_query($conn,$sql2)) {

                  // $sts=1;
                  // $subject = "New Jobs uploaded;";
                  // $body= "job Title: ".$name;
                  // $sender= "";
                  // $run = accFun($conn,$sts);
                  
                  //     while ($row = mysqli_fetch_array($run)) {  
                  //         $emai=$row['Aemail'];
                  //         mail($emai,$subject,$body,$sender);
                  //     }
                      echo "<script> 
                      alert('Your Job have been Submitted.');
                        </script>";
                echo "<meta http-equiv='refresh' content='0;index.php'>" ;
                }else {
                  // echo "<script> alert('Error. Data not Saved')</script>";
                  
                  echo "error :".$sql2. "<br>". $conn->error;
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
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <link rel="stylesheet" href="./css/mystyle.css" />
    <title>Home</title>
  </head>
  <body>
    <!-- HEADER -->
    <header>
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a href="" class="navbar-brand p-0">
            <img src="./img/Leegruimte_Logo.png" class="headerLogo" alt="" />
          </a>
          <button
            class="navbar-toggler navbarToggler"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
          >
            <span><i class="fa-solid fa-bars"></i>MENU</span>
          </button>
          <div class="collapse navbar-collapse navbarCollapse" id="navbarNav">
            <ul class="navbar-nav navbarNav ms-auto">
              <li>
                <a href="#heroSection" class="nav-link navLink">JuisteBoekhouder.nl</a>
              </li>
              <li>
                <a href="accountant" class="nav-link navLink">ACCOUNTANT LOGIN</a>
              </li>
              <li>
                <a href="" class="nav-link envelope">
                  <i class="fa-regular fa-envelope"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- HERO SECTION -->
    <section id="heroSection">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="topLgText">FIND THE RIGHT ACCOUNTANT?</h1>
            <div class="marginTop">
              <p>
              The platform where you can request a quote 100% 
              without obligation and free of charge.
              </p>
              <p>
              You will receive quotes from accountants based on your request.              </p>
              <p>The choice is yours to choose the right accountant!</p>
            </div>
            <div>
              <a href="" class="btn lgBtn marginTop"
                >Request 100% without obligation and <br />
                free quotes!</a
              >
            </div>
          </div>
          <div class="col-lg-6">
            <img src="./img/hero-img.png" alt="" class="img-fluid heroImg" />
          </div>
        </div>
      </div>
    </section>
    <!-- SECTION 2 -->
    <section id="section2">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="mx">
              <h5 class="mb">Why do I need a bookkeeper?</h5>
              <div class="listColor">
                <ul>
                
                  <li>Keeping records</li>
                  <li>Drafting invoices
</li>
                  <li>Prepare sales tax return
</li>
                  <li>Income tax return
</li>
                  <li>
                  Preparation of annual accounts, balance sheet and profit and loss account

                  </li>
                  <li>
                  Advising on taxes and financial management
                  </li>
                </ul>
              </div>
              <div class="mt-5">
                <img src="./img/img1.png" class="img-fluid" alt="" />
              </div>
            </div>
          </div>
          <div class="col-lg-6 pt">
            <div class="mx">
              <h5>
              What can the benefits of an accountant be for your company:
              </h5>
              <div class="listColor mt0">
                <h6 class="my">A bookkeeper takes care of everything</h6>
                <ul>
                  <li>
                  An accountant ensures that everything is checked and that the declarations are processed correctly and on time. A bookkeeper can save a lot of stress and time and 
                  allow you to focus on what you do best. That, of course, is entrepreneurship.
                  </li>
                </ul>
                <h6 class="middleText">
                An accountant can 'pay for itself' with good advice

                </h6>
                <ul>
                  <li>
                  A good bookkeeper is knowledgeable and up-to-date on legislation and regulations. 
                  In addition, a good bookkeeper knows how to keep an administration and ensures that
                   declarations are processed correctly and on time. In addition, you can spar with an
                    accountant about financial benefits and the operational management of your company. 
                  This way you can receive advice that can take your company one step further.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h5 class="textCenter">How does it work?</h5>
          </div>
        </div>
      </div>
    </section>
    <!-- SECTION 3 -->
    <section id="section3">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-4">
            <div class="step">
              <div>
                <img src="./img/Stap1.png" class="img-fluid" alt="" />
              </div>
              <h6>Step 1</h6>
              <p>
              Fill in your application as completely as possible! 
              This is completely non-binding and free!
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="step">
              <div>
                <img src="./img/Stap2.png" class="img-fluid" alt="" />
              </div>
              <h6>Step 2</h6>
              <p>
              We make sure that you get in touch with accounting offices!            
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="step">
              <div>
                <img src="./img/Stap3.png" class="img-fluid" alt="" />
              </div>
              <h6>Step 3</h6>
              <p>
              After your contact with the accounting offices, you can determine
               which accounting office is the right one for you and best suits your needs!
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FORM SECTION -->
    <section id="formSection">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          <form action="" method="post">
              <h5 class="boldText">Post A Job</h5>
              <div class="formPadding">
                <div>
                  <input
                    type="text"
                    class="form-control"
                    id="jobTitle"
                    placeholder="Enter Job Title"
                    name="name" required
                  />
                </div>
                <div class="row g-0">
                  <div class="col-lg-6">
                    <label for="" class="form-label">Select Job Salary</label>
                    <select name="salary" required id="inputSalary" class="form-select">
                        <option  disabled value="" Selected> Select Job Salary</option> 
                        <option value="Unknown">Unknown</option>
                        <option value="€0.00-€50.000">€0.00-€50.000</option>
                        <option value="€50.000-€100.000">€50.000-€100.000</option>
                        <option value="€100.00-€250.000">€100.00-€250.000</option>
                        <option value="€250.00-€500.000">€250.00-€500.000</option>
                        <option value="€500.000+">€500.000+</option>
                    </select>
                  </div>
                  <div class="col-lg-5 mx-auto">
                    <label for="" class="form-label">Job City</label>
                    <input
                      type="text"
                      class="form-control"
                      id="jobCity"
                      placeholder="Enter Job City"
                      name="city" required

                    />
                  </div>
                </div>
                <div class="row g-0">
                  <div class="col-lg-6">
                    <input
                      type="number"
                      class="form-control"
                      id="jobDistance"
                      placeholder="Enter Job Distance From City."
                      name="distance" required
                    />
                  </div>
                  
                </div>
                <div class="row g-0">
                  <div class="col-lg-6">
                    <label for="" class="form-label">Start date of job</label>
                    <input
                      type="date"
                      class="form-control"
                      id="startDateJob"
                      placeholder="Enter Job City"
                      name="sdate" required
                    />
                  </div>
                  <div class="col-lg-5 mx-auto">
                    <label for="" class="form-label">End date of job</label>
                    <input
                      type="date"
                      class="form-control"
                      id="endDateJob"
                      placeholder="Enter Job City"
                      name="ldate" required
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <label for="" id="beforeJobBought" class="form-label"
                      >Description</label>
                    <textarea name="descBef" required class="form-control" rows="5"></textarea>
                  </div>
                </div>
                <div class="row g-0">
                  <div class="col-lg-6">
                    <input
                      type="text"
                      class="form-control"
                      id="inputTypeText"
                      placeholder="Company Name"
                      name="cname" required
                    />
                  </div>
                  <div class="col-lg-5 mx-auto">
                    <input
                      type="email"
                      class="form-control"
                      id="inputTypePhoneNumber"
                      placeholder="Company Email"
                      name="email" required
                    />
                  </div>
                  <div class="col-lg-6">
                    <input
                      type="text"
                      class="form-control"
                      id="inputTypeEmail"
                      placeholder="Company Address"
                      name="address" required
                    />
                  </div>
                  <div class="col-lg-5 mx-auto">
                    <input
                      type="text"
                      class="form-control"
                      id="inputTypeAddress"
                      placeholder="Company website"
                      name="website" required
                    />
                  </div>
            
                </div>

              
                <div class="row">
                  
                  <div class="col-lg-12">
                    <div>
                      <button type="submit" name="savejob" class="btn saveBtn">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- FOOTER -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="footerCopyRight border-top">
              <a href="heroSection">CORRECTBOEKHOUDER.NL</a>
              <a href="accountant">REGISTER AS AN ACCOUNTANT</a>
              <p>© COPYRIGHT - JUISTEBOEKHOUDER.NL</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
