<?php
  session_start();
if (!isset($_SESSION['id'])) {
  echo "<script>window.location.href='login.php'</script>";
}
require_once("include/head.php");

?>
  <body>
    <!-- Header navbar-->
     <?php require_once("include/navbar.php") ?>
    <!-- main -->
    <main>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="invoices">
              <div class="invoicesHeading">
                <h2>Privacy Policy</h2>
              </div>
               <ul>
                 <li> Lorem ipsum dolor sit amet consectetur adipisicing elit. A temporibus quod autem nesciunt sunt! Commodi doloremque praesentium pariatur architecto fuga rem, nesciunt accusantium culpa nisi blanditiis! Illo cupiditate ut ad.
                 </li>
                 <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit necessitatibus praesentium, laboriosam nulla explicabo fugiat consequuntur ratione sed aut nam molestiae odit qui quidem culpa quis suscipit dolor cum eos?
                 </li>
                 <li> Lorem ipsum dolor sit amet consectetur adipisicing elit. A temporibus quod autem nesciunt sunt! Commodi doloremque praesentium pariatur architecto fuga rem, nesciunt accusantium culpa nisi blanditiis! Illo cupiditate ut ad.
                 </li>
                 <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit necessitatibus praesentium, laboriosam nulla explicabo fugiat consequuntur ratione sed aut nam molestiae odit qui quidem culpa quis suscipit dolor cum eos?
                 </li>
                 <li> Lorem ipsum dolor sit amet consectetur adipisicing elit. A temporibus quod autem nesciunt sunt! Commodi doloremque praesentium pariatur architecto fuga rem, nesciunt accusantium culpa nisi blanditiis! Illo cupiditate ut ad.
                 </li>
                 <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit necessitatibus praesentium, laboriosam nulla explicabo fugiat consequuntur ratione sed aut nam molestiae odit qui quidem culpa quis suscipit dolor cum eos?
                 </li>
 
               </ul>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
