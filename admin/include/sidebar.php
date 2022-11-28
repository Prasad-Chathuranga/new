<div class="sideMenu">
        <div class="sideMenuHeader">
          <a href="#" class="brand">
             Admin Panel
            <div> <?php echo $_SESSION['name']; ?></div>
          </a>
          <?php
          /*<center>
            <div id="google_translate_element"></div>
          </center>*/
          ?>
        </div>
        <a href="accountant.php" id="accountant" class="sideMenuLink"
          ><i class="fas fa-users"></i>Accountants</a>
           <a href="add.php" id="accountant" class="sideMenuLink"
          ><i class="fas fa-rectangle-ad"></i>Advertisement</a>

          <!-- <a href="accountantRequest.php" id="accountantRequest" class="sideMenuLink"
          ><i class="fas fa-users"></i>Accountants Request</a> -->

          <a href="job.php"  id="job" class="sideMenuLink"
          ><i class="fa fa-briefcase"></i>Jobs</a>

          <a href="Packages.php"  id="Packages" class="sideMenuLink"
          ><i class="fa fa-briefcase"></i>Packages</a>
           
          <!-- <a href="jobrequest.php" id="jobrequest" class="sideMenuLink"
          ><i class="fas fa-briefcase"></i>Jobs Bought Request</a> -->

          <a href="jobhistory.php" id="jobhistory" class="sideMenuLink"
          ><i class="fas fa-briefcase"></i>Jobs Bought History</a>

          <!-- <a href="creditsrequest.php" id="creditsrequest" class="sideMenuLink"
          ><i class="fas fa-euro-sign"></i>Credits Request</a> -->

          <a href="creditshistory.php" id="creditshistory" class="sideMenuLink"
          ><i class="fas fa-euro-sign"></i>Credits History</a>

          <a href="refundrequest.php" id="refundrequest" class="sideMenuLink"
          ><i class="fas fa-euro-sign"></i>Refund Request</a>

          <a href="refundhistory.php" id="refundhistory" class="sideMenuLink"
          ><i class="fas fa-euro-sign"></i>Refund history</a>

          <a href="company.php" id="company" class="sideMenuLink"
          ><i class="fas fa-building"></i>Company</a>

          <!-- <a href="companytype.php" id="company" class="sideMenuLink"
          ><i class="fas fa-building"></i>Company Type</a> -->
            <?php 
                if (isset($_SESSION['type']) && $_SESSION['type']=='admin') {
                  
                }else {
              
                
             ?>
          <a href="admins.php" id="admins" class="sideMenuLink"
          ><i class="fas fa-users"></i>All Admins</a>
            <?php } ?>
          <a href="adminaccount.php" id="adminaccount" class="sideMenuLink"
          ><i class="fas fa-user"></i>Admin Account</a>
          
          <a href="login.php?Logout=logout" class="sideMenuLink"
          ><i class="fas fa-power-off"></i>Logout</a>
      </div>


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
   <?php
   /* <script>
    function googleTranslateElementInit() {
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
        document.getElmentsByClass("")
    }
 </script> 
 <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> */
 ?>

<!--  -->