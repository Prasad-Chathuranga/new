<?php
session_start();
$id = $_SESSION["id"];
if(!isset($id)){
  header('Location:login.php?Logout=logout');
}
require_once("include/connection.php");
$query = mysqli_query($conn,'SELECT * FROM `buy` INNER JOIN job ON buy.Jid=job.Jid INNER JOIN credit_logs ON credit_logs.Jid = buy.Jid WHERE buy.Aid= '.$id.'');
$row = mysqli_fetch_assoc($query);
// echo "<pre>";print_r($row);die;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lead</title>
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
    <link rel="stylesheet" href="css/available leads-style.css" />
    <link rel="stylesheet" href="./css/pdf2-style.css" />
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
  </head>

  <body>
    <?php require_once("include/navbar.php") ?>
    <div class="leadHeader">
      <div class="container">
        <div class="leaderHead">
          <img class="headLogo" src="./img/logo.png" alt="" />
          <div class="innerLeadHead">
            <div class="leftSide">
              <h1 class="mainHeading">WRKD B.V</h1>
              <div class="blackText">Vogt 21</div>
              <div class="blackText">6422 RK</div>
              <div class="blackText">Heerlen</div>
            </div>
            <div class="rightSIde">
              <div class="lightText">info@wrkd.nl</div>
              <div class="lightText">+31(0)43 2003090</div>
              <div class="lightText">www.krkd.com</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Lead Body -->
    <div class="leadBody">
      <div class="container">
        <div class="phoneText">
          <i class="fa-solid fa-square-phone"></i>
          Klusbedrijf uit IJmuiden zoekt een kantoor om mee samen te werken
        </div>
        <div class="grayText">#8439 &nbsp; - &nbsp; IJmuiden</div>
        <div>
          <div class="leadHeading">Bedrijf</div>
          <div class="row">
            <div class="col-lg-6 detailsBody">
              <div class="leadDetails">
                <div class="darkText">Naam</div>
                <div class="lightText">Rodriguez Solutions</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">E-mail</div>
                <div class="lightText">rodriguezsolutions@ziggo.nl</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">Telefoon</div>
                <div class="lightText">0636114259</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">Adres</div>
                <div class="lightText">Zandhaver 16 IJmuiden 1974 VH</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">Website</div>
                <div class="lightText">---</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">Bedrijfstype</div>
                <div class="lightText">Eenmanszaak</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">Sector</div>
                <div class="lightText">Boekhouder</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">Meer industrieën</div>
                <div class="lightText">Accountant, Boekhouder</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">KVK</div>
                <div class="lightText">73626457</div>
              </div>
              <div class="leadDetails">
                <div class="darkText">Jaarlijkse omzet</div>
                <div class="lightText">---</div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="leadHeading mt-4">Contactpersonen</div>
          <table class="table leadTable">
            <thead>
              <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Telefoon</th>
                <th>Alternatief</th>
                <th>telefoonnummer</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Rodriguez Perez,</td>
                <td>Rrodriguezsolutions@ziggo.nl</td>
                <td>0636114259</td>
                <td>-</td>
                <td><i class="fa-solid fa-phone"></i></td>
              </tr>
              <tr>
                <td>Donaldo</td>
                <td></td>
                <td></td>
                <td></td>
                <td><i class="fa-solid fa-envelope"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div>
          <div class="leadHeading">Beschrijving</div>
          <p class="mainText">
            De klant is enkele jaren geleden gestart met zijn onderneming. Het
            betreft een eenmanszaak actief als klusbedrijf. Hij voert
            werkzaamheden uit in onderaanneming zoals sloopwerkzaamheden en alle
            voorkomende klussen in de bouw. Daarnaast neemt hij diverse klussen
            aan bij particulieren. Het betreft een fulltime onderneming voor de
            klant.
          </p>
          <p class="mainText">
            De administratie wordt bijgehouden in Excel. De klant laat zich
            graag informeren over het gebruik van een boekhoudprogramma voor het
            bijhouden van de administratie. De samenwerking met de huidige
            boekhouder verloopt niet meer zo soepel de laatste tijd. De klant
            heeft meermaals aangegeven met een boekhoudprogramma te willen
            starten maar dat is tot op heden nog niet gebeurd. In verhouding tot
            de geleverde diensten vindt hij de kosten aan de hoge kant. De klant
            zelf spreekt gebrekkig Nederlands dus alle communicatie verloopt via
            de partner die ook de administratie bijhoudt. Het verwerken van de
            facturen doet hij zelf.
          </p>
          <p class="mainText">
            De totale jaaromzet bedraagt €45.000,- met minder dan 10 te
            verwerken mutaties per maand.
          </p>
          <p class="mainText oddText">
            De volgende aspecten worden uitbesteed voor de eenmanszaak:
          </p>
          <p class="mainText oddText">- Controleren van de administratie;</p>
          <p class="mainText oddText">- OB-aangifte per kwartaal;</p>
          <p class="mainText oddText">- IB-aangifte;</p>
          <p class="mainText oddText">- Opstellen van het jaaroverzicht;</p>
          <p class="mainText">- Advies.</p>
          <p class="mainText">
            De klant zoekt een kantoor met een persoonlijke en pro actieve
            aanpak binnen een maximale rijafstand van 30 kilometer vanuit
            IJmuiden.
          </p>
        </div>
        <div class="grayText bottomText">
          KVK: 71176810 &nbsp; &nbsp; &nbsp; BTW: NL858610036B01
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
