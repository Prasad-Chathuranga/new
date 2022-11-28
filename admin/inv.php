<?php  
session_start();
if (!isset($_SESSION["id"])) {
  echo "<script>window.location.href='login.php'</script>";
 }
     include("include/head.php");  
     include("function/creditFun.php");  
     if (isset($_GET["inc"])) {
      $bcid=$_GET["inc"];
      $query="SELECT * FROM `buy_credit`
                     JOIN accountant ON buy_credit.Aid=accountant.Aid
                     WHERE buy_credit.bcr_id='$bcid'";
      $run = mysqli_query($conn,$query);
      $row= mysqli_fetch_array($run);
  
  }
?>

  <body>
    <!-- Page Parent -->
    <div class="pageParent">
      <!-- Side Menu -->
      <?php  include("include/sidebar.php"); ?>
      <!-- Page Contents -->
      <div class="pageContents" style="margin-top:-30px;">
      <div class="container" style="width:60%">
        
        <div id="printableArea">
             <table style="width:100%">
                 <tr>
                     <td style="width:70%">
                          <h2><img src="../accountant/img/logos.png" class="img-fluid " 
                              style=" height: 150px; width: 300px; margin-top:30px; border-radius:16px;" alt="img" />
                              </h2>
                               <center><h1 style="font-size:32px;">  Invoice</h1></center>
                               <br>  
                                
                              <table style=" padding:10px; margin-left:30px;">
                                      <tr style="height:40px;font-size:18px;" >
                                          <td style="width:25%;" >Name.</td>
                                          <th style="width:25%;"><?php echo $row["Aname"];?></th>
                                          <td style="width:25%;">Invoice No.</td>
                                         <th style="width:25%;"><?php echo $row["bcr_id"];?></th>
                                      </tr>
                                      <tr style="height:40px;font-size:18px;">
                                          <td style="width:25%;">Email.</td>
                                          <th style="width:25%;"><?php echo $row["Aemail"];?></th>
                                          <td style="width:25%;"> Date.</td>
                                          <th style="width:25%;"><?php echo $row["bcr_date"];?></th>
                                      </tr style="height:40px">
                                      <tr>
                                          <td style="width:25%;">Contact.</td>
                                          <th style="width:25%;"><?php echo $row["Aphone"];?></th>
                                          <td style="width:25%;">KvK.</td>
                                  <th style="width:25%;"><?php echo $row["kvknumber"];?></th>
                                      </tr>
                                      <br>
                                      <tr style="height:40px;font-size:18px;">
                                          <td >Address.</td>
                                          <th><?php echo $row["Aaddress"];?></th>
                                      </tr>
                                  
                              <!-- </div> -->
                     </td>

                              
                          </table> 
                     </td>
                 </tr>
             </table>

           <br>
              <table class="table">
                  <thead style="background-color:lightgray;">
                      <tr>
                          <th class="w-75">Package title</th>
                          <th>Credit</th>
                          <th>Amount</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td><?php echo $row["pkg"];?></td>
                          <td><?php echo $row["credits"];?></td>
                          <td><i class="fa fa-euro"></i> <?php echo $row["amount"];?></td>
                      </tr>
                  </tbody>
              </table>
               <!-- <div class="row">
                   <div class="col-md-4">

                   </div>
                   <div class="col-md-4"></div>
                   <div class="col-md-4"></div>
               </div> -->
              <table style="width:100%; margin-top:100px;">
                <tr>
                    <td style="width:70%">
                    
                    </td>
                    <td style="width:30%">
                          <table class="table">
                             
                             <tr >
                                        <th  style="padding-left:0px; width:58%">Total Credits.</th>
                                        <!-- <th ></th> -->
                                        <th style="padding-left:8px"><?php echo $row["credits"];?></th>
                                    </tr>
                                    <tr>
                                        <th style="padding-left:0px">Invoice Amount.</th>
                                        <!-- <th><i class="fa fa-euro"></i></th> -->
                                        <th><i class="fa fa-euro"></i> <?php echo $row["amount"];?></th>
                                   </tr>
                          </table>
                    </td>
                </tr>
                               
              </table>
      </div>
      <center>
         <input type="button" value="Print" onclick="printDiv('printableArea')" class="btn btn-primary btn-md">
      </center>
</div>
      </div>
    </div>
     <?php include("include/footer.php"); ?>
    
       <!-- Edit Modal  -->
  <!-- <div class="modal fade" id="editModal" role="dialog" >
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <!-- <div class="modal-content" style="background-color: lightgray;">
        
        <div class="modal-body">
        </div>
           <div class="form-group" >
                   <img id="image" class="img-fluid" style="height: 300px; width: 100%;">
           </div>
         </div>
      </div>
    </div>
  </div> --> -->
<!-- <script>
     function getdept(id) {

$("#image").attr("src",id);
}

</script> -->
<script>
         // print code 
         function printDiv(divName)
                {
                    var printContents = document.getElementById(divName).innerHTML;
                    var orignalContents = document.body.innerHTML;
                    document.body.innerHTML=printContents;
                    window.print();
                    document.body.innerHTML = orignalContents;
                }
      </script>
  </body>
</html>
