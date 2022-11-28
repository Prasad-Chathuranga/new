<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('connection.php');

// setcookie('lang','de', time() + (10 * 365 * 24 * 60 * 60),'/');

  //////////////////////// insert company type  //////////////////////////////////
if (isset($_POST["savejob"])) {
   
  $query="SELECT * FROM `company` ORDER by cid DESC";
  $run = mysqli_query($conn,$query);
  $row= mysqli_fetch_array($run);
  $lastid =  $row["cid"]+1;
	$checkbox1=$_POST['typeofbusiness']; 
  $descb=mysqli_real_escape_string($conn,$_POST["descBef"]);
    $cname=mysqli_real_escape_string($conn,$_POST["cname"]);
    $flexRadioDefault =mysqli_real_escape_string($conn,$_POST["flexRadioDefault"]);  
	 $gender =mysqli_real_escape_string($conn,$_POST["gender"]); 
	  $firstname =mysqli_real_escape_string($conn,$_POST["firstname"]); 
	   $lastname =mysqli_real_escape_string($conn,$_POST["lastname"]); 
	   $street =mysqli_real_escape_string($conn,$_POST["street"]);
		$postal =mysqli_real_escape_string($conn,$_POST["postal"]);
	$city =mysqli_real_escape_string($conn,$_POST["city"]);
		$phone =mysqli_real_escape_string($conn,$_POST["phone"]);
			$email =mysqli_real_escape_string($conn,$_POST["email"]);
$chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   } 

  // echo "<script> alert('$name/$email/$contact/$address/$desc/$company')</script>";
              $sql2 = ("INSERT INTO `job`(`business_form`,`type of work`,`company`,`JdesBef`,`gender`,`firstname`,`lastname`,`street`,`postal`,`city`,`phone`,`email`) VALUES ('$flexRadioDefault','$chk','$cname','$descb','$gender','$firstname','$lastname','$street','$postal','$city','$phone','$email')");
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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <style>
      .goog-te-banner-frame.skiptranslate {
          display: none !important;
      }
      body {
        top: 0px !important; 
      }
    </style>
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
                <a href="" class="nav-link navLink">JuisteBoekhouder.nl</a>
              </li>
              <li>
                <a href="" class="nav-link navLink">Aanmelden als Boekhouder</a>
              </li>
              <li>
                <a href="" class="nav-link envelope pt-0">
                  <i class="fa-regular fa-envelope"></i>
                </a>
              </li>
            </ul>
            <div id="google_translate_element"></div>
            <!-- <select name="lang" id="lang">
              <option value="en">EN</option>
              <option value="nl">NL</option>
            </select> -->
          </div>
        </div>
      </nav>
    </header>
    <!-- HERO SECTION -->
    <section id="heroSection">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="topLgText">
              DE JUISTE <br />
              BOEKHOUDER <br />
              VINDEN?
            </h1>
            <div class="marginTop">
              <p>
                Dé platform waar u 100% vrijblijvend en gratis een offerte kan
                aanvragen.
              </p>
              <p>
                U ontvangt offertes van boekhouders op basis van uw aanvraag.
              </p>
              <p>Aan u de keuze om de juiste boekhouder te kiezen!</p>
            </div>
            <div>
              <a href="" class="btn lgBtn marginTop"
                >100% Vrijblijvend en gratis offertes <br />
                aanvragen!</a
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
              <h5 class="mb">Waarom heb ik een boekhouder nodig?</h5>
              <div class="listColor">
                <ul>
                  <li>Bijhouden van de administratie</li>
                  <li>Opstellen van facturen</li>
                  <li>Opstellen aangifte omzetbelasting</li>
                  <li>Aangifte van de inkomstenbelasting</li>
                  <li>
                    Opstellen van jaarrekening, balans en winst- en
                    verliesrekening
                  </li>
                  <li>
                    Adviseren over belastingen en financiële bedrijfsvoering
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
                Wat kunnen de voordelen van een boekhouder zijn voor uw
                onderneming:
              </h5>
              <div class="listColor mt0">
                <h6 class="my">Een boekhouder ontzorgt</h6>
                <ul>
                  <li>
                    Een boekhouder zorgt ervoor dat alles gecontroleerd wordt en
                    de aangiftes tijdig en correct worden verwerkt. Een
                    boekhouder kan een heel hoop stress en tijd besparen en kan
                    ervoor zorgen dat u zich kunt focussen waar u goed in bent.
                    Dat is natuurlijk: ondernemen.
                  </li>
                </ul>
                <h6 class="middleText">
                  Een boekhouder kan zichzelf ‘terugverdienen’ met goede
                  adviezen
                </h6>
                <ul>
                  <li>
                    Een goede boekhouder heeft kennis van zaken en is up-to-date
                    over de wet- en regelgeving. Daarnaast weet een goede
                    boekhouder hoe een administratie gevoerd dient te worden en
                    zorgt ervoor dat aangiftes tijdig en correct worden
                    verwerkt. Daarnaast kunt u met een boekhouder sparren over
                    financiële voordelen en de bedrijfsvoering van uw
                    onderneming. Zodoende kunt u adviezen ontvangen die uw
                    onderneming weer een stap verder kan brengen.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h5 class="textCenter">Hoe werkt het?</h5>
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
              <h6>Stap 1</h6>
              <p>
                Vul uw aanvraag zo volledig mogelijk in! Dit is geheel
                vrijblijvend en gratis!
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="step">
              <div>
                <img src="./img/Stap2.png" class="img-fluid" alt="" />
              </div>
              <h6>Stap 2</h6>
              <p>
                Wij zorgen ervoor dat u in contact komt met <br />
                boekhoudkantoren!
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="step">
              <div>
                <img src="./img/Stap3.png" class="img-fluid" alt="" />
              </div>
              <h6>Stap 3</h6>
              <p>
                Na uw contact met de boekhoudkantoren kunt u bepalen welk
                boekhoudkantoor de juiste voor u is en het best bij uw wensen
                past!
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FORM SECTION -->
    <section id="formSection">
      <div class="container">
        <div class="formBg">
          <div class="row">
            <div class="col-lg-9">
              <div>
                <h5>
                  Begin hier uw aanvraag en kom in contact met de juiste
                  Boekhouder!
                </h5>
              </div>
              <form action="" method="post">
                <div class="row mb-5">
                  <div class="col-12">
                    <h6>Uw bedrijfsvorm *</h6>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="Particulier"
                        id="flexRadioDefault1"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault1"
                      >
                        Particulier
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						            value="ZZP/Eenmanszaak"
                        id="flexRadioDefault2"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault2"
                      >
                        ZZP/Eenmanszaak
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="V.O.F"
                        id="flexRadioDefault3"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault3"
                      >
                        V.O.F.
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="B.V"
                        id="flexRadioDefault4"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault4"
                      >
                        B.V.
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="Stichting/Vereniging"
                        id="flexRadioDefault5"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault5"
                      >
                        Stichting/Vereniging
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="flexRadioDefault"
						value="Maatschap"
                        id="flexRadioDefault6"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault6"
                      >
                        Maatschap
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-12">
                    <h6>Type werkzaamheden *</h6>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
						name="typeofbusiness[]"
                        value="Aangifte inkomstenbelasting"
                        id="flexCheckDefault1"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault1"
                      >
                        Aangifte inkomstenbelasting
                      </label>
                    </div>
                    <div class="form-check formCheck mb">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                       	name="typeofbusiness[]"
                        value="Aangifte omzetbelasting btw"
                        id="flexCheckDefault2"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault2"
                      >
                        Aangifte omzetbelasting (btw)
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                         name="typeofbusiness[]"
                        value="Aangifte"
                        id="flexCheckDefault2"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault2"
                      >
                        Aangifte
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                          name="typeofbusiness[]"
                        value="Volledige boekhouding"
                        id="flexCheckDefault3"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault3"
                      >
                        Volledige boekhouding
                      </label>
                    </div>
                    <div class="form-check formCheck mb">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                           name="typeofbusiness[]"
                        value="Toezicht op de boekhouding"
                        id="flexCheckDefault4"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault4"
                      >
                        Toezicht op de boekhouding
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                          name="typeofbusiness[]"
                        value="Jaarrekening"
                        id="flexCheckDefault4"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault4"
                      >
                        Jaarrekening
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check formCheck mb">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                            name="typeofbusiness[]"
                        value="Accountantsverklaring"
                        id="flexCheckDefault5"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault5"
                      >
                        Accountantsverklaring
                      </label>
                    </div>
                    <div class="form-check formCheck mb">
                      <input
                        class="checkboxInput form-check-input"
                        type="checkbox"
                           name="typeofbusiness[]"
                        value="Salarisadministratie"
                        id="flexCheckDefault6"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault6"
                      >
                        Salarisadministratie
                      </label>
                    </div>
                    <div class="form-check formCheck">
                      <input
                        class="formCheckInput checkboxInput form-check-input"
                        type="checkbox"
                          name="typeofbusiness[]"
                        value="Anders Toelichten bij opdrachtbeschrijving"
                        id="flexCheckDefault6"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexCheckDefault6"
                      >
                        Anders (Toelichten bij opdrachtbeschrijving)
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <label for="" class="form-check-label formLabelBold"
                      >Bedrijfsnaam *</label
                    >
                    <input type="text"  name="cname" class="form-control inputBox" />
                  </div> 
			
				  
                  <div class="col-12">
                    <p class="smallText">
                      Private? Fill in here Private to continue with your
                      application!
                    </p>
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-check-label formLabelBold"
                      >Beschrijving van de opdracht *</label
                    >
                    <textarea
                      class="form-control textareaInput"
                      name="descBef"
                      id=""
                      rows="6"
                    ></textarea>
                    <p class="smallText">
                      Geef een korte toelichting over de onderneming en
                      opdracht.
                    </p>
                  </div>
                  <div class="col-12">
                    <h6>Geslacht *</h6>
                    <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="gender"
						value="Male"
                        id="flexRadioDefault7"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault7"
                      >
                        Heer
                      </label>
                    </div>
                    <div class="form-check formCheck mb">
                      <input
                        class="formCheckInput form-check-input"
                        type="radio"
                        name="gender"
						value="Female"
                        id="flexRadioDefault8"
                      />
                      <label
                        class="form-check-label formCheckLabel"
                        for="flexRadioDefault8"
                      >
                        Mevrouw
                      </label>
                    </div>
                  </div>
                  <div class="col-12">
                    <h6 class="mt">Naam *</h6>
                  </div>
                  <div class="col-md-5">
                    <input type="text" name="firstname" class="form-control inputBox" />
                    <p class="smallText">Voornaam</p>
                  </div>
                  <div class="col-md-5">
                    <input type="text" name="lastname" class="form-control inputBox" />
                    <p class="smallText">Achternaam</p>
                  </div>
                  <div class="col-12">
                    <h6>Straat en Huisnummer, Postcode en Plaats *</h6>
                  </div>
                  <div class="col-md-6">
                    <input
                      type="text" name="street"
                      class="form-control inputBox"
                      placeholder="Straat en Huisnummer"
                    />
                  </div>
                  <div class="col-md-2 py-md-0 py-2">
                    <input
                      type="text" name="postal"
                      class="form-control inputBox"
                      placeholder="1234 AB"
                    />
                  </div>
                  <div class="col-md-4">
                    <select name="city" id="city" class="form-control inputBox">
                      <option value="">Select City</option>
                      <?php
                      $city = mysqli_query($conn,"SELECT * FROM city");
                      while($result = mysqli_fetch_assoc($city)){ ?>
                        <option value="<?php echo $result["name"] ?>"><?php echo $result["name"] ?></option>
                      <?php } ?>
                    </select>
                    <!-- <input
                      type="text" name="city"
                      class="form-control inputBox"
                      placeholder="Plaats"
                    /> -->
                  </div>
                  <div class="col-md-4">
                    <h6 class="mt">Telefoonnummer *</h6>
                    <input type="number" name="phone" class="form-control inputBox" />
                    <p class="smallText">Zonder tekens, alleen cijfers</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <h6 class="">E-mailadres *</h6>
                    <input type="email" name="email" class="form-control inputBox" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" name="savejob"  class="btn formSendRequestBtn">
                        Verstuur aanvraag
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FOOTER -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="footerCopyRight">
              <a href="">JuisteBoekhouder.nl</a>
              <a href="">Aanmelden als Boekhouder</a>
              <p>© COPYRIGHT - JUISTEBOEKHOUDER.NL</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"
  integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q=="
  crossorigin=""></script>
<script src="js/ggds.js"></script>
<script>
var mymap = L.map('map');

mymap.setView([22.297680,70.787460], 6);

var mmr1 = L.marker([22.297680,70.787460]);
mmr1.bindPopup('22.297680,70.787460');
mmr1.addTo(mymap);

var mmr2 = L.marker([22.824200,70.831299]);
mmr2.bindPopup('22.824200,70.831299');
mmr2.addTo(mymap);

var Geodesic = L.geodesic([[mmr1.getLatLng(), mmr2.getLatLng()]], {
      weight: 4,
      opacity: 0.4,
      color: 'red',
      steps: 50
    }).addTo(mymap);
  
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar',
attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mymap);


mmr1.bindPopup('Rajkot');
mmr2.bindPopup('Morbi');


mymap.fitBounds(L.latLngBounds(mmr1.getLatLng(), mmr2.getLatLng()));

Geodesic.update = function () {
  Geodesic.setLatLngs([[mmr1.getLatLng(), mmr2.getLatLng()]]);
};

Geodesic.update();
var dist = mmr1.getLatLng().distanceTo(mmr2.getLatLng()) / 1000;
var e = 0.621371192 * dist;
console.log(dist.toFixed(2) + " km")
// document.getElementById("totaldistancekm").innerHTML = dist.toFixed(2) + " km";
// document.getElementById("totaldistancemiles").innerHTML = e.toFixed(2) + " miles";


</script> -->
 <script>
    function googleTranslateElementInit() {
        console.log("ASd")
        new google.translate.TranslateElement({
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            pageLanguage: 'nl', 
            includedLanguages: 'nl,en',
            autoDisplay: true, 
            multilanguagePage: true,
        }, 'google_translate_element');
        var a = document.querySelector("#google_translate_element select");
        a.selectedIndex=1;
        a.dispatchEvent(new Event('change'));
    }
 </script> 
 <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 

<script type="text/javascript">
  window.addEventListener('load', function() {
    document.getElementsByClassName("skiptranslate")[0].style.display = 'none !important';
  });
  // document.addEventListener('DOMContentLoaded', function() {
  //   console.log("ASDASS")
  //   document.getElementsByClassName("goog-close-link")[0].click();
  // })
  function distanceCalculate(lat1, lon1, lat2, lon2, unit="K") {
    if ((lat1 == lat2) && (lon1 == lon2)) {
        return 0;
    } else {
        var radlat1 = Math.PI * lat1/180;
        var radlat2 = Math.PI * lat2/180;
        var theta = lon1-lon2;
        var radtheta = Math.PI * theta/180;
        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        if (dist > 1) {
            dist = 1;
        }
        dist = Math.acos(dist);
        dist = dist * 180/Math.PI;
        dist = dist * 60 * 1.1515;
        if (unit=="K") { dist = dist * 1.609344 }
        if (unit=="N") { dist = dist * 0.8684 }
        return dist.toFixed(2);
    }
}
// console.log(distanceCalculate(22.297680,70.787460,22.824200,70.831299))
</script>
  </body>
</html>
