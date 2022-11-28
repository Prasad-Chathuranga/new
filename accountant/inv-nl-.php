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
  </head>

  <body>
    
    <?php require_once("include/navbar.php") ?>

    <div class="ledgerHeader">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <img src="./img/logo.png" alt="" />
            <h1 class="mainHeading">Factuur</h1>
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
          </div>
        </div> -->
      </div>
    </div>

    <!-- Details -->
    <div class="details">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="boldText">Elizan Design</div>
            <div class="lightText">Wijk aan Duinerweg 145</div>
            <div class="lightText">1944 TS Beverwijk</div>
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
              <span class="lightText">73677744</span>
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
              <span class="cardTag">Betaalgegevens</span>
              <div class="midDet">
                <span class="lightText">Te betalen</span>
                <span class="boldText">€ 345,00</span>
              </div>
              <div class="midDet">
                <span class="lightText">Naar IBAN</span>
                <span class="boldText">NL95 KNAB 0258 8654 90</span>
              </div>
              <div class="midDet">
                <span class="lightText">Op naam van</span>
                <span class="boldText">Administratiekantoor BC</span>
              </div>
              <div class="midDet">
                <span class="lightText">Omschrijving</span>
                <span class="boldText">Factuur 20210016</span>
              </div>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div>
              <span class="lightText odd">Factuurnummer</span>
              <span class="boldText">20210016</span>
            </div>
            <div>
              <span class="lightText odd">Factuurdatum</span>
              <span class="boldText">11-11-2021</span>
            </div>
            <div class="mt-5">
              <span class="lightText odd">Klantnummer</span>
              <span class="boldText">15</span>
            </div>
            <div>
              <span class="lightText odd">Leverdatum</span>
              <span class="boldText">11-11-2021</span>
            </div>
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
              <th>Omschrijving</th>
              <th>Aantal</th>
              <th>Prijs</th>
              <th>Totaal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Boekhouding Q4</td>
              <td>1,00</td>
              <td>345,00</td>
              <td>345,00</td>
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
                  <th>Btw %</th>
                  <th>Grondslag</th>
                  <th>Bedrag</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>0,00</td>
                  <td>345,00</td>
                  <td>0,00</td>
                </tr>
                <tr>
                  <td>9,00</td>
                  <td>0,00</td>
                  <td>0,00</td>
                </tr>
                <tr>
                  <td>21,00</td>
                  <td>345,00</td>
                  <td>0,00</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-lg-4"></div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <table class="table">
              <tbody>
                <tr>
                  <td>Totaal excl. btw</td>
                  <td>€</td>
                  <td>345,00</td>
                </tr>
                <tr>
                  <td>Totaal btw</td>
                  <td>€</td>
                  <td>0,00</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td>Factuurbedrag</td>
                  <td>€</td>
                  <td>345,00</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
