<?php  ?>
<header>
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <a href="" class="navbar-brand p-0">
            <img src="./img/logos.png" alt="" class="img-fluid logo" />
          </a>
          <button
            type="button"
            class="navbar-toggler toggleBtn"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
          >
            <i class="fa-solid fa-bars"></i>
          </button>
          <?php
          /*<div class="navbarRight d-lg-none d-block">
            <span class="navbarRightText">Welcome, <?php echo $_SESSION['name']; ?></span>
            <button class="avatarBtn btn">
              <img src="<?php echo $_SESSION['usimg']; ?>" alt="" />
            </button>
          </div>*/
          ?>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
              <li>
                <a href="./availableleads.php" id="availableleads"class="nav-link navLink">Available leads</a>
              </li>
              <li>
                <a href="./business.php" id="business"class="nav-link navLink">Company</a>
              </li>
              <li>
                <a href="./invoices.php" id="invoices"class="nav-link navLink">Invoices</a>
              </li> 
              <li>
                <a href="./credits.php" id="credits" class="nav-link navLink">Credits</a>
              </li>
              <li>
                <a href="./my leads1.php" id="leads" class="nav-link navLink">My Leads</a>
              </li>
              <li>
                <a href="./refundsRequests.php" id="refunds" class="nav-link navLink"
                  >Refund Requests</a
                >
              </li>
              <li>
                <a href="./setting.php" id="setting" class="nav-link navLink">Settings</a>
              </li>
              <?php
              /*<li>
                <a href="#" class="nav-link navLink translate Dutch " data-lang="Dutch" style="padding-right: 5px;" translate="no">Dutch</a>
              </li>
              <li>
                <a href="#" class="nav-link navLink translate English" data-lang="English" translate="no">English</a>
              </li>*/
              ?>
             <?php
             /* <li>
                  <select name="chLanguage" id="chLanguage" class="form-control inputBox" style="line-height: 1.9em; background-color: #358779; color:#FFFFFF; padding-top: 0.1rem; padding-right: 0.25rem; padding-bottom: 0.1rem; padding-left: 0.25rem;">
                    <option value=""  translate="no">Select Language</option>
                    <option value="Dutch" translate="no">Dutch</option>
                    <option value="English" translate="no">English</option>
                  </select>
                  <div id="google_translate_element" style="visibility: hidden; width: 1px !important; height: 1px !important;"></div>
              </li>*/
              ?>
            </ul>
            <div class="navbarRight d-lg-block d-none dropdown">
              <button
                class="avatarBtn btn"
                type="button"
                id="dropdown"
                data-bs-toggle="dropdown"
              >
              <span class="navbarRightText">
                <!-- <a href="login.php?Logout=logout" style="color:white;"><i class="fa fa-power-off"></i></a> -->
                Welcome, <?php echo $_SESSION['name']; ?>
                <img style="border-radius:20px;" src="<?php echo $_SESSION['usimg']; ?>" alt="" />
               </span>
             </button>
              <!-- <a class="avatarBtn btn"  href="profile.php">
               <img style="border-radius:20px;" src="<?php echo $_SESSION['usimg']; ?>" alt="" />
              </a> -->
              <ul class="dropdown-menu dropdownMenu">
                <li>
                  <a class="dropdown-item dropdownItem" href="profile.php"
                    >Profile</a
                  >
                </li>
                <li>
                  <a class="dropdown-item dropdownItem" href="change_password.php"
                    >Change Password</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item dropdownItem"
                    href="juisteboekhouder.com/terms-and-conditions"
                    >Terms and Conditions</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item dropdownItem"
                    href="juisteboekhouder.com/refund-policy"
                    >Refund Policy</a
                  >
                </li>
                <li>
                  <a class="dropdown-item dropdownItem" href="login.php?Logout=logout">Log out</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <script>
      
      var cUrl=window.location.href;
    var cUrlArr1=cUrl.split("/");
    
    var cUrlArr2=cUrlArr1[5].split(".");
    
    GetUrl(cUrlArr2[0]);
    function GetUrl(id) {
      // alert(id); 
       var element = document.getElementById(id);
       element.classList.add("active");
      
      // alert(cUrlArr2[0]);
      // $("#"+id).classList.add("active");
    }
     
    </script>
      <!-- google transalte script -->
    <script>
    <?php
    /*
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            pageLanguage: 'nl', 
            includedLanguages: 'nl,en',
            autoDisplay: true, 
            multilanguagePage: true,
        }, 'google_translate_element');
    }
 </script> 
 <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> */
 ?>
 <script src="js/jquery-3.2.1.min.js"></script>
 <!-- Flag click handler -->
<?php
/*<script type="text/javascript">
    //$('.translation-links a').click(function() {
    //$('.translate').click(function() {
    $('#chLanguage').change(function(){
      //var lang = $(this).data('lang');
      var lang = $(this).val();
      var $frame = $('.goog-te-menu-frame:first');
      
      //$frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
      $('.goog-te-menu-frame:first').contents().find('.goog-te-menu2-item span.text').each(function(){
        if( $(this).html() == lang )
          $(this).click(); 				
      });
      return false;
    });
</script>
<!--  -->
*/
?>
   