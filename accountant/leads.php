<?php
        require_once("include/connection.php");
        session_start();
        $id = $_SESSION["id"];
        if(!isset($id)){
                header('Location:login.php?Logout=logout');
        }
        if(isset($_GET["bid"])){
                $bid = $_GET["bid"];
                /*$strQuery = "SELECT buy.*, job.company, job.email as comemail, job.Jtitle, job.phone as cphone, job.address as caddress,
                        job.website as cwebsite, job.business_form, job.`type of work` as type_of_work, job.kvk_number_customer, job.Jsalary, job.JdesBef,
                        job.firstname as cfirstname, job.lastname as clastname,
                        accountant.* 
                        FROM `buy` 
                        INNER JOIN job ON buy.Jid=job.Jid 
                        INNER JOIN credit_logs ON credit_logs.Jid = buy.Jid 
                        INNER JOIN accountant ON accountant.Aid=buy.Aid 
                        WHERE credit_logs.Jid IS NOT NULL AND buy.Aid= '.$id.'";*/
                $strQuery = "SELECT `buy`.*, `job`.*, city.name as cityname FROM `buy`
                   Left JOIN job ON buy.Jid=job.Jid 
                   left join city on city.id=job.Jcity
                   WHERE buy.bid= '$bid'";
                //echo $strQuery;
                //exit;
                $query = mysqli_query($conn,$strQuery);
                $row = mysqli_fetch_assoc($query);
                // echo "<pre>";print_r($row);die;
                
        }
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Ledger</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/minireset.css/0.0.2/minireset.min.css"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
                <link rel="stylesheet" href="css/available leads-style.css" />
                <link rel="stylesheet" href="./css/leads.css" />
                <link rel="stylesheet" href="./css/translate.css" />
                <link rel="stylesheet" href="./css/style_3.css" />
        </head>
        <body>
                <?php require_once("include/navbar.php") ?>
                <div id="printableArea" style="width: 60%; margin: auto;">
                        <div class="leadHeader">
                                <div class="container">
                                        <div class="leaderHead">
                                                <img class="headLogo" src="./img/new-logos.png" alt=""  style="width: 196px;" />
                                                <div class="innerLeadHead">
                                                        <?php
                                                        /*<div class="leftSide">
                                                                <h1 class="mainHeading">WRKD B.V</h1>
                                                                <div class="blackText">Vogt 21</div>
                                                                <div class="blackText">6422 RK</div>
                                                                <div class="blackText">Heerlen</div>
                                                        </div>
                                                        <div class="rightSIde">
                                                                <div class="lightText">info@wrkd.nl</div>
                                                                <div class="lightText">+31(0)43 2003090</div>
                                                                <div class="lightText">www.krkd.com</div>
                                                        </div>*/
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="leadBody">
                                <div class="container">
                                        <div class="phoneText">
                                                <i class="fa-solid fa-square-phone"></i>
                                                <?php 
                                                        echo $row['Jtitle'];
                                                ?>
                                        </div>
                                        <div class="grayText"> <?php 
                                                        echo $row['Jid'];
                                                ?> &nbsp; - &nbsp; <?php 
                                                echo $row['city'];
                                        ?></div>
                                        <div>
                                                <div class="leadHeading">Bedrijf</div>
                                                <div class="row">
                                                        <div class="col-lg-6 detailsBody">
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Naam</div>
                                                                        <div class="lightText">
                                                                                <?php 
                                                                                        echo $row['company'];
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">E-mail</div>
                                                                        <div class="lightText">
                                                                                <?php
                                                                                        echo $row['email'];
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Telefoon</div>
                                                                        <div class="lightText">
                                                                                <?php 
                                                                                        echo $row['phone'];
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Adres</div>
                                                                        <div class="lightText">
                                                                                <?php 
                                                                                        echo $row['street'] . ' ' . $row['city'] .' '. $row['postal'];
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Website</div>
                                                                        <div class="lightText">
                                                                                <?php 
                                                                                        echo $row['website'];
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Bedrijfstype</div>
                                                                        <div class="lightText"><?php echo $row['business_form'];?></div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText"> BTW</div>
                                                                        <div class="lightText">
                                                                                NL858610036B01
                                                                        </div>
                                                                </div>
                                                                <?php
                                                                /*<div class="leadDetails">
                                                                        <div class="darkText">Sector</div>
                                                                        <div class="lightText"><?php echo $row['business_form'];?></div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Meer industrieën</div>
                                                                        <div class="lightText">
                                                                                <?php echo $row['type of work'];?>
                                                                        </div>
                                                                </div>*/
                                                                ?>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">KVK</div>
                                                                        <div class="lightText">
                                                                                <?php echo $row['kvk_number_customer'];?>
                                                                        </div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Jaarlijkse omzet</div>
                                                                        <div class="lightText">
                                                                                <?php
                                                                                        if($row['Jsalary']=='0')
                                                                                        {
                                                                                                echo "Unknown";
                                                                                        }
                                                                                        else if($row['Jsalary']=='1')
                                                                                        {
                                                                                                echo "€0.00-€50.000";
                                                                                        }
                                                                                        else if($row['Jsalary']=='2')
                                                                                        {
                                                                                                echo "€50.000-€100.000";
                                                                                        }
                                                                                        else if($row['Jsalary']=='3')
                                                                                        {
                                                                                                echo "€100.00-€250.000";
                                                                                        }
                                                                                        else if($row['Jsalary']=='4')
                                                                                        {
                                                                                                echo "€250.00-€500.000";
                                                                                        }
                                                                                        else if($row['Jsalary']=='5')
                                                                                        {
                                                                                                echo "€500.000+";
                                                                                        }
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                                <div class="leadDetails">
                                                                        <div class="darkText">Gekocht datum</div>
                                                                        <div class="lightText">
                                                                                <?php echo $row['buydate'];?>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div>
                                                <div>
                                                    <br>
                                                    <div class="leadHeading">Beschrijving</div>
                                                    <p class="mainText">
                                                            <?php
                                                                    echo $row['JdesBef'];
                                                            ?>
                                                    </p><br>
                                            </div>
                                                <div class="leadHeading mt-4">Contactpersonen</div>
                                                <table class="table leadTable">
                                                        <thead>
                                                                <tr>
                                                                        <th>Naam</th>
                                                                        <th>E-mail</th>
                                                                        <th>Telefoon</th>
                                                                        <?php
                                                                        /*<th>Alternatief</th>
                                                                        <th>telefoonnummer</th>*/
                                                                        ?>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                                <tr>
                                                                        <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                                                                        <td><?php echo $row['email'];?></td>
                                                                        <td><?php echo $row['phone'];?></td>
                                                                        <?php
                                                                        /*<td>-</td>
                                                                        <td><i class="fa-solid fa-phone"></i></td>*/?>
                                                                </tr>
                                                                <?php
                                                                /*<tr>
                                                                        <td>Donaldo</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><i class="fa-solid fa-envelope"></i></td>
                                                                </tr>*/
                                                                ?>
                                                        </tbody>
                                                </table>
                                        </div>
                                        <?php
                                        /*<div class="grayText bottomText" id="kvkbottom">
                                                KVK: <?php echo $row['kvk_number_customer'];?>
                                        </div>*/
                                        ?>
                                </div>
                        </div>
                </div>
                <center>
                        <input type="button" value="Print" onclick="printDiv('printableArea')" class="btn btn-primary btn-md">
                </center>
                <?php
                /*<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>*/
                ?>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/index.js"></script>
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