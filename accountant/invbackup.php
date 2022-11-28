<?php
session_start();

require_once("include/connection.php");

if (!isset($_SESSION["id"])) {
 echo "<script>window.location.href='login.php'</script>";
}
$id=$_SESSION["id"];

if (isset($_GET["inc"])) {
    $bcid=$_GET["inc"];
    $query="SELECT * FROM `buy_credit`
                   JOIN accountant ON buy_credit.Aid=accountant.Aid
                   WHERE buy_credit.Aid='$id' AND buy_credit.bcr_id='$bcid'";
    $run = mysqli_query($conn,$query);
    $row= mysqli_fetch_array($run);

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/minireset.css/0.0.2/minireset.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/available leads-style.css" />
    <link rel="stylesheet" href="./css/pdf-style.css" />
    <style>
      .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 10px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
      }

      .invoice-box table td {
        padding: 5px;
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }

      /** RTL **/
      .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      }

      .invoice-box.rtl table {
        text-align: right;
      }

      .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
      }
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
  </head>

  <body>
    
    <?php require_once("include/navbar.php") ?>
    <div id="printableArea">

    <div class="ledgerHeader">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <!-- <img src="./img/logo.png" alt="" /> -->
            <img src="./img/logos.png" class="img-fluid " style=" height: 100px; width: 200px; margin-top:30px; border-radius:16px;" alt="img" />
            <h1 class="mainHeading">Invoice</h1>
          </div>
          <!-- <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="lightText">Grahamstraat 227</div>
            <div class="lightText">1973 RE IJmuiden</div>
            <div class="lightText">
              <i class="fa-solid fa-phone mr-2"></i> 06-34566680
            </div>
            <div class="lightText">
              <i class="fa-solid fa-envelope mr-2"></i> adm.bc@outlook.com
            </div>
          </div> -->
       
    
    

    <!-- Details -->
    <div class="details">
      <div class="container">
      
  
       
          <div class="col-8">
            <div class="boldText"><?php echo $row["Aname"];?></div>
            <div class="lightText"><?php echo $row["Aemail"];?></div>
            <div class="lightText"><?php echo $row["Aaddress"];?></div>
            <!-- <div class="lightText">1944 TS Beverwijk</div> -->
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div>
              <span class="boldText">IBAN</span>
              <span class="lightText">NL95 KNAB 0258 8654 90</span>
            </div>
            <div>
              <span class="boldText">Btw-nr</span>
              <span class="lightText">NL002203077B53</span>
            </div>
            <div>
              <span class="boldText">KvK</span>
              <span class="lightText"><?php echo $row["kvknumber"];?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

    <!-- Mid Details -->
    <div class="midDetails">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="detailsCard">
              <span class="cardTag">Payment Details</span>
              <div class="midDet">
                <span class="lightText">To pay</span>
                <span class="boldText">€ <?php echo $row["amount"];?></span>
              </div>
              <div class="midDet">
                <span class="lightText">To IBAN</span>
                <span class="boldText">NL95 KNAB 0258 8654 90</span>
              </div>
              <div class="midDet">
                <span class="lightText">In name of</span>
                <span class="boldText">Administratiekantoor BC</span>
              </div>
              <div class="midDet">
                <span class="lightText">Description</span>
                <span class="boldText">Invoice #<?php echo $row["bcr_id"];?></span>
              </div>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div>
              <span class="lightText odd">Inoice nummer</span>
              <span class="boldText"><?php echo $row["bcr_id"];?></span>
            </div>
            <div>
              <span class="lightText odd">Invoice date</span>
              <span class="boldText"><?php echo $row["bcr_date"];?></span>
            </div>
            <div class="mt-5">
              <span class="lightText odd">Client number</span>
              <span class="boldText"><?php echo $row["Aphone"];?></span>
            </div>
            <!-- <div>
              <span class="lightText odd">Delivery date</span>
              <span class="boldText">11-11-2021</span>
            </div> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Table Details -->
    <div class="tableDetails">
      <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th>Package title</th>
              <!-- <th>Number of</th> -->
              <th>Credit</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $row["pkg"];?></td>
              <!-- <td>1,00</td> -->
              <td><?php echo $row["credits"];?></td>
              <td><?php echo $row["amount"];?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Multi Tables -->
    <div class="multiTables">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <table class="table">
              <thead>
                <tr>
                  <th>VAT %</th>
                  <th>Credits</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>0,00</td>
                  <td><?php echo $row["credits"];?></td>
                  <td><?php echo $row["amount"];?></td>
                </tr>
                <!-- <tr>
                  <td>9,00</td>
                  <td>0,00</td>
                  <td>0,00</td>
                </tr>
                <tr>
                  <td>21,00</td>
                  <td>345,00</td>
                  <td>0,00</td>
                </tr> -->
              </tbody>
            </table>
          </div>
          <div class="col-lg-4"></div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <table class="table">
              <tbody>
                <tr>
                  <td>Total excl. VAT</td>
                  <td>€</td>
                  <td><?php echo $row["amount"];?></td>
                </tr>
                <tr>
                  <td>Total VAT</td>
                  <td>€</td>
                  <td>0,00</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td>Invoice amount</td>
                  <td>€</td>
                  <td><?php echo $row["amount"];?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    <center>
       <input type="button" value="Print" onclick="printDiv('printableArea')" class="btn btn-primary btn-md">
    </center>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
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
