<?php 
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $date = $year . '-' . $month . '-' . $day;
        session_start();
        if (!isset($_SESSION["id"])) {
                echo "<script>window.location.href='login.php'</script>";
        }
        $id = $_SESSION["id"];
        require_once("include/head.php");
?>
<body>
        <!-- Header navbar-->
        <?php
                require_once("include/navbar.php");
                $id = $_SESSION["id"];
                $query="SELECT * FROM `total_credits` WHERE Aid= '$id'";
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
                                }
                                else{
                                        echo " <script>alert('Error. job not buy.')</script>";
                                        // echo "error :".$insert_query. "<br>". $conn->error."<br>";
                                        // echo "error :".$update_query. "<br>". $conn->error."<br>";
                                }
                        }
                        else {
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
                                        }
                                        else{
                                                echo " <script>alert('Error. credit not added.')</script>";
                                                //  echo "error :".$insert_query. "<br>". $conn->error."<br>";
                                                //  echo "error :".$update_query. "<br>". $conn->error."<br>";
                                        }
                                }
                                else{
                                        echo "<script> alert('Error. move upload')</script>";
                                }
                        }
                        else {
                                echo "<script> alert('Error. File must be JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif')</script>";
                        }
                }

                $id = $_SESSION["id"];
                if (isset($_POST["submit"])) {
      
                        $crid=$_POST['bcr'];
                        $reson=$_POST["desc"];
                        $yesorno=$_POST['yesorno'];
                        $question=$_POST['question'];
                        $query="SELECT * FROM `refund` WHERE bid='$crid'";
                        $run = mysqli_query($conn,$query);
                        if (mysqli_num_rows($run) > 0) { 
                                echo " <script>alert('You Already request for  Refund of this Job.')</script>";
                        }
                        else{
                                /*$strQuery = "select max(bcr_id) as bcr_id from buy_credit where Aid=".$id;
                                $runBuyCredit = mysqli_query($conn,$strQuery);
                                $rowBuyCredit = mysqli_fetch_array($runBuyCredit);
                                $crid = $rowBuyCredit['bcr_id'];*/
                                $insert_query2= "INSERT INTO `refund`(`requestdate`,`on` ,`RSts`, `bid`,`rdesc`,`rquestion`,`Aid`) VALUES (now(),'$yesorno','0','$crid','$reson','$question',$id)";
                            
                                if (mysqli_query($conn,$insert_query2)) {
                                        echo " <script>alert('Success! Your request submited. It well be Approved soon from the Admin.')</script>";
                                        echo "<meta http-equiv='refresh' content='0;my leads1.php'>";
                                }
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
                <a href="buycredit.php" class="btn creditsBtn">Buy Credits</a>
              </div>
              <hr />
              <div class="contact">
                <div class="contactText">Your contact</div>
                  <?php 
                      
                      $sq="SELECT * FROM `accountant` WHERE Aid='$id'";
                      $runn=mysqli_query($conn,$sq);
                      $roww=mysqli_fetch_array($runn);
                      
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
            <div class="card p0">
                 <?php 
                $sql9 = "SELECT * FROM `advertisement` WHERE status = 1 ORDER BY RAND() LIMIT 1";
                $run9 = mysqli_query($conn,$sql9);
                
                if(mysqli_num_rows($run9)>0)
                {
                        $row9= mysqli_fetch_array($run9);
                        ?>
                        
                
              <img src="./<?php echo $row9['image'] ?>" class="img-fluid" alt="" />
              <div class="paddingAll">
                <div class="cardText">
                 <?php echo $row9['description'] ?>
                </div>
               
              </div>
            
                        <?php
                }
                else{
                        ?>
                        
                
              <div class="paddingAll">
                <div class="cardText">
                 No Ad set
                </div>
               
              </div>
            
                        <?php
                }
                
                
                ?>
            </div>
          </div>
        <div class="col-lg-10 order-lg-0 order-1">
            <div class="mijnLeads">
              <h2 class="leadsHeading">My leads</h2>
              <div class="table-responsive">
                <table class="table mb-0" id="myTable">
                     <?php  
                   $query="SELECT `buy`.*, `job`.*, city.name as cityname FROM `buy`
                   Left JOIN job ON buy.Jid=job.Jid 
                   left join city on city.id=job.Jcity
                   WHERE buy.Aid= '$id'
                   AND buy.bSts=1
                   order by buy.buydate desc";
                   
                   $run = mysqli_query($conn,$query);
               
                  
                   if (mysqli_num_rows($run) > 0) {
                ?>
                  <thead>
                    <tr>
                    
                      <th class="tableHeading" scope="col">Lead#</th>
                      <th class="tableHeading" scope="col">Title</th>
                      <th class="tableHeading" scope="col">Company</th>
                      <th class="tableHeading" scope="col">City</th>
                      <th class="tableHeading" scope="col">Buying Date</th>
                      <th class="tableHeading" scope="col"></th>
                      <th class="tableHeading" scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                       <?php    
                          while ($row = mysqli_fetch_array($run)) {
                        ?>
                    <tr>
                      <td scope="row"><?php echo $row['Jid']?></td>
                      <td><?php echo $row['Jtitle']?></td>
                      <td><?php echo $row['company']?></td>
                      <td><?php echo $row['cityname']?></td>
                      
                      <td><?php echo $row['buydate']?></td>
                      
                       <td class="textColor">
                          <a href="./myLeads2.php?bid=<?php echo $row['bid'] ?>" >
                              Log Book
                          </a>
                      </td>
                       <td >
                        <div class="d-flex">
                          <a href="<?php echo 'leads.php?bid='.$row["bid"]; ?>" class="btn tableBtn">
                            <i class="fa-solid fa-file-pdf"></i>
                          </a>
                          <!-- <button class="btn tableBtn">
                            <i class="fa-solid fa-file-pdf"></i>
                          </button>  
                           -->
                          <button
                            class="btn tableBtn mx-2"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal<?php echo $row['Jid']?>"
                          >
                            <i class="fa-solid fa-triangle-exclamation"></i>
                          </button>
                         
                          <?php
                          /*<a href="jobdetail.php?jddet=<?php echo $row['Jid']?>" class="btn tableBtn" style="margin-left: 12px;">
                            <i class="fa-solid fa-eye"></i>
                          </a>*/
                          ?>
                        </div>
                      </td>
                      
                    </tr>
                    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?php echo $row['Jid']?>" tabindex="-1">
      <div class="modal-dialog modalDialog">
        <div class="modal-content modalContent">
          <div class="modal-header modalHeader">
            <h5 class="modal-title modalTitle" id="exampleModalLabel">
              Refund Request
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <h6 class="modalBodyTopText">
             Job Discription
            </h6>
            <div class="alertBox">
              <p>
                <span
                  ><i
                    class="fa-solid fa-circle-exclamation faCircleExclamation"
                  ></i
                ></span>
                Read Carefuly before Refund
              </p>
            </div>
            <div class="loremBox" id="desc">
            <?php echo $row['jdesAft']?>
            </div>
            <form method="post">
              <input type="number" name="bcr" value="<?php echo $row['bid']?>" style="visibility: hidden;" >
            <div class="textareaBox">
              <label for=""
                >Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Cupiditate earum corporis quo nisi, temporibus culpa eum natus
                rem molestiae voluptates!</label
              >
              <textarea  class="form-control mb-3" name="desc"></textarea>
              <label for=""
                >Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quibusdam, modi?</label
              >
              <textarea class="form-control mb-3" name="question"></textarea>
            </div>
            <div class="form-check form-switch formSwitch">
              <label for="">Offerte ingediend?</label>
              <div>
                <input
                  class="form-check-input formCheckInput"
                  type="checkbox"
                  role="switch"
                  id="flexSwitchCheckChecked"
                  name="yesorno"
                />
              </div>
            </div>
            <div>
              <button class="btn modalBtn" type="submit" name="submit">
                Refund
              </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

               <?php } ?>
                   
                  </tbody>
                   <?php  
                }else{
                   echo "No Data Found.";
                        //die();
                }  
                ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable({
                order: [[4, 'desc']],
        });
} );
</script>
    <script>
      function getdept(id,jdesAft) {
        
      $("#id").val(id);
      $("#desc").val(jdesAft);
      }
      $('input:checkbox[name="yesorno"]').change(function(){

        if ($(this).val() == 'Yes') {
            //true
        }
        else {
            //false
        }
    });
          
  </script>
  </body>
