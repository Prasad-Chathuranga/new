<?php
        session_start();
        use Dompdf\Dompdf;
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
                $nPaymenID = $row['payment_id'];
                $queryPayment = "select * from payment where id=".$nPaymenID;
                $runPayment = mysqli_query($conn, $queryPayment);
                $rowPayment = mysqli_fetch_array($runPayment);
                $queryAccountant = "select accountant.*, company.vat, city.name as cityname 
                    from accountant 
                    left join city on city.id=accountant.Acity 
                    left join company on company.cid = accountant.cid
                    where Aid=".$id;
                $runAccountant = mysqli_query($conn, $queryAccountant);
                $rowAccountant = mysqli_fetch_array($runAccountant);
        }
        $bPrintFlag = false;
        $protocol = isset($_SERVER['HTTPS']) && \strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
        $hostname = $_SERVER['HTTP_HOST'];
        $path = \dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
        if(isset($_GET['print']) && $_GET['print']=='yes')
        {
                $bPrintFlag = true;
                ob_start();
                require_once 'include/dompdf/autoload.inc.php';
                //require_once '../vendor/autoload.php';
        }
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8" />
                
                <title>Invoice</title>
                <?php
                        //if(!$bPrintFlag)
                        //]]{
                                ?>
                                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen"/>
                                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/minireset.css/0.0.2/minireset.min.css"/>
                                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
                                <link rel="stylesheet" type="text/css" href="<?php echo "{$protocol}://{$hostname}{$path}/css/available leads-style.css?time=".time();?>" />
                                <link rel="stylesheet" type="text/css" href="<?php echo "{$protocol}://{$hostname}{$path}/css/pdf-style.css?time=".time();?>" />
                                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
                                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/minireset.css/0.0.2/minireset.min.css"/>
                                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
                                <link rel="stylesheet" type="text/css" href="<?php echo "{$protocol}://{$hostname}{$path}/css/style_2.css?time=".time();?>" />
                                <?php
                       // }
                ?>
                
                <style>
                        <?php
                                if($bPrintFlag)
                                {
                                        ?>
                                        /*@font-face {
                                                font-family: "Roboto";
                                                font-style: normal;
                                                font-weight: normal;
                                        }

                                        div{ 
                                                font-family: "Roboto";
                                        }*/
                                        @font-face { font-family: 'Roboto Regular'; font-weight: normal; src: url('fonts/Roboto-Regular.ttf') format('truetype'); } 
                                        @font-face { font-family: 'Roboto Bold'; font-weight: bold; src: url('fonts/Roboto-Bold.ttf') format('truetype'); } 
                                        body{ font-family: 'Roboto Regular', sans-serif; font-weight: normal;  }
                                        h1,h2{ font-family: 'Roboto Bold', sans-serif; font-weight: bold; }
                                        <?php
                                }
                        ?>
                        
                        .invoice-box {
                                max-width: 800px;
                                margin: auto;
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
                        @page { margin: 0px; }
                        body { margin: 0px; }


                </style>
        </head>
        <body>
                <?php 
                        if(!$bPrintFlag)
                        {
                                require_once("include/navbar.php");
                        }
                        $strStyle = "width: 70%; margin: auto;";
                        if($bPrintFlag)
                        {
                                $strStyle = "width: 90%; margin: auto;";
                        }
                ?>
                <div id="printableArea" style="<?php echo $strStyle;?>">
                        <div class="ledgerHeader">
                                <table style="width: 100%;">
                                        <tr>
                                                <td colspan="2">
                                                        <div class="ledgerHeader">
                                                                <div class="container">
                                                                        <div class="row">
                                                                                <div class="col-lg-8"><img src="<?php echo "{$protocol}://{$hostname}{$path}/img/new-logos.png";?>" alt="" style="width: 196px;" /><h1 class="mainHeading">Factuur</h1></div>
                                                                                <div class="col-lg-4 mt-4 mt-lg-0 rightCol">
                                                                                        <div class="lightText"><?php /*Grahamstraat 227*/?></div>
                                                                                        <div class="lightText"><?php /*1973 RE IJmuiden*/?></div>
                                                                                        <div class="lightText">
                                                                                                <?php /*<i class="fa-solid fa-phone mr-2"></i> 06-34566680*/?>
                                                                                        </div>
                                                                                        <div class="lightText">
                                                                                                <?php /*<i class="fa-solid fa-envelope mr-2"></i> adm.bc@outlook.com*/?>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td style="width: 60%; padding-left:25px;">
                                                        <div class="col-lg-8">
                                                                <div class="boldText"><?php echo $rowAccountant['Aname']." ".$rowAccountant['surname'];?></div>
                                                                <div class="lightText"><?php echo $rowAccountant['Aaddress'];?></div>
                                                                <div class="lightText"><?php echo $rowAccountant['cityname'];?></div>
                                                        </div>
                                                </td>
                                                <td style="width: 40%; white-space: nowrap;  padding-left: 15px;">
                                                        <table>
                                                                <tr>
                                                                        <td style="padding-right: 3px; white-space: nowrap">
                                                                                <span class="boldText">IBAN</span>
                                                                        </td>
                                                                        <td style="padding-left: 3px; white-space: nowrap;">
                                                                                <span class="lightText"><?php echo $rowPayment['customeraccount'];?></span>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                        <td style="padding-right: 3px; white-space: nowrap">
                                                                                <span class="boldText">Btw-nr</span>
                                                                        </td>
                                                                        <td style="padding-left: 3px; white-space: nowrap;">
                                                                                <span class="lightText"><?php echo $rowAccountant['vat'];?></span>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                        <td style="padding-right: 3px; white-space: nowrap">
                                                                                <span class="boldText">KvK</span>
                                                                        </td>
                                                                        <td style="padding-left: 3px; white-space: nowrap;">
                                                                                <span class="lightText"><?php echo $rowAccountant['kvknumber'];?></span>
                                                                        </td>
                                                                </tr>
                                                        </table>
                                                </td>
                                        </tr>
                                        <tr class="midDetails">
                                                <td>
                                                        <div class="col-lg-6 lgRow" style="width: 80%; padding-top: 20px; padding-left: 25px; white-space: nowrap;">
                                                                <div class="detailsCard">
                                                                        <span class="cardTag">Betaalgegevens</span>
                                                                        <div class="midDet">
                                                                                <span class="lightText">Te betalen</span>
                                                                                <span class="boldText">€ <?php echo number_format((float)$rowPayment['amount'], 2, ",", '');?></span>
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
                                                                                <span class="boldText">Factuur <?php echo $rowPayment['order_id'];?></span>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </td>
                                                <td>
                                                        <div class="col-lg-4 mt-4 mt-lg-0 rightCol" style="padding-top: 20px; padding-left: 15px;  white-space: nowrap; vertical-align: super;">
                                                                <table>
                                                                        <tr>
                                                                                <td style="white-space: nowrap; padding-right: 5px">
                                                                                        <span class="lightText odd">Factuurnummer</span>
                                                                                </td>
                                                                                <td  style="white-space: nowrap; padding-left: 5px">
                                                                                        <span class="boldText"><?php echo $rowPayment['order_id'];?></span>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td style="white-space: nowrap; padding-right: 5px">
                                                                                        <span class="lightText odd" style="padding-right: 5px">Factuurdatum</span>
                                                                                </td>
                                                                                <td style="white-space: nowrap; padding-left: 5px">
                                                                                        <span class="boldText"  style="padding-left: 5px"><?php echo date("d-m-Y", strtotime($rowPayment['created']));?></span>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td style="white-space: nowrap; padding-right: 5px">
                                                                                        <span class="lightText odd">Klantnummer</span>
                                                                                </td>
                                                                                <td style="white-space: nowrap; padding-left: 5px">
                                                                                        <span class="boldText">15</span>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td style="white-space: nowrap; padding-right: 5px">
                                                                                        <span class="lightText odd">Leverdatum</span>
                                                                                </td>
                                                                                <td style="white-space: nowrap; padding-left: 5px">
                                                                                        <span class="boldText"><?php echo date("d-m-Y", strtotime($rowPayment['paidat']));?></span>
                                                                                </td>
                                                                        </tr>
                                                                </table>
                                                        </div>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2" style="padding-top: 20px; white-space: nowrap;">
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
                                                                                                <td><?php echo $row['pkg'];?></td>
                                                                                                <td>1,00</td>
                                                                                                <td><?php echo $row['amount'];?></td>
                                                                                                <td><?php echo number_format((float)$row['amount'], 2, ".", "");?></td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </div>
                                                        </div>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td colspan="2" style=" white-space: nowrap;">
                                                        <div class="multiTables">
                                                        <div class="container">
                                                                <div class="row">
                                                                        <div class="col-lg-4">
                                                                                <?php
                                                                                /*<table class="table">
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
                                                                                                        <td><?php echo number_format((float)$row['amount'], 2, ".", "");?></td>
                                                                                                        <td>0,00</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>9,00</td>
                                                                                                        <td>0,00</td>
                                                                                                        <td>0,00</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <?php
                                                                                                                        $nTax = ((float)$row['amount'] * 9 /100);
                                                                                                                ?>
                                                                                                                <?php echo number_format((float)$nTax, 2, ".", "");?>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <?php echo number_format((float)$row['amount'], 2, ".", "");?>
                                                                                                        </td>
                                                                                                        <td>0,00</td>
                                                                                                </tr>
                                                                                        </tbody>
                                                                                </table>*/
                                                                                ?>
                                                                        </div>
                                                                        <div class="col-lg-4"></div>
                                                                        <div class="col-lg-4 mt-4 mt-lg-0">
                                                                                <table class="table">
                                                                                        <tbody>
                                                                                                <tr>
                                                                                                        <?php
                                                                                                                $nTax = $row['amount'] * 0.21;
                                                                                                        ?>
                                                                                                        <td>Totaal excl. btw</td>
                                                                                                        <td>€</td>
                                                                                                        <td>
                                                                                                                <?php echo number_format((float)$row['amount'], 2, ".", "");?>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>Btw (21%)</td>
                                                                                                        <td>€</td>
                                                                                                        <td><?php echo number_format((float)$nTax, 2, ".", "");?></td>
                                                                                                </tr>
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                                <tr>
                                                                                                        <td>Factuurbedrag</td>
                                                                                                        <td>€</td>
                                                                                                        <td><?php echo number_format((float)$row['amount']+$nTax, 2, ".", "");?></td>
                                                                                                </tr>
                                                                                        </tfoot>
                                                                                </table>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                                </td>
                                        </tr>
                                </table>
                        </div>
                </div>
                <?php
                        if(!$bPrintFlag)
                        {
                                $current_url = sprintf(
                                        '%s://%s/%s',
                                        isset($_SERVER['HTTPS']) ? 'https' : 'http',
                                        $_SERVER['HTTP_HOST'],
                                        $_SERVER['REQUEST_URI']
                                        );
                                ?>
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
                                                /*var printContents = document.getElementById(divName).innerHTML;
                                                var orignalContents = document.body.innerHTML;
                                                document.body.innerHTML=printContents;
                                                window.print();
                                                document.body.innerHTML = orignalContents;*/
                                                //window.location.href = '<?php echo $current_url;?>&print=yes'
                                                window.open('<?php echo $current_url;?>&print=yes');
                                        }
                                </script>
                        </body>
                </html>
                                <?php
                        }
                        else {
                                ?>
                                </body>
                        </html>
                                <?php
                                /*$mpdf = new \Mpdf\Mpdf(['margin-top'=>'2mm']);
                                $stylesheet3 = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
                                $mpdf->WriteHTML($stylesheet3,\Mpdf\HTMLParserMode::HEADER_CSS);
                                $stylesheet4 = file_get_contents('https://cdnjs.cloudflare.com/ajax/libs/minireset.css/0.0.2/minireset.min.css');
                                $mpdf->WriteHTML($stylesheet4,\Mpdf\HTMLParserMode::HEADER_CSS);
                                $stylesheet5 = file_get_contents('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
                                $mpdf->WriteHTML($stylesheet5,\Mpdf\HTMLParserMode::HEADER_CSS);

                                $stylesheet2 = file_get_contents('css/available leads-style.css');
                                $mpdf->WriteHTML($stylesheet2,\Mpdf\HTMLParserMode::HEADER_CSS);
                                $stylesheet = file_get_contents('css/pdf-style.css');
                                //echo $stylesheet;
                                //exit;
                                $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
                                $stylesheet1 = file_get_contents('css/style_2.css');
                                $mpdf->WriteHTML($stylesheet1,\Mpdf\HTMLParserMode::HEADER_CSS);
                                $stylesheet6 = file_get_contents('css/inline.css');
                                $mpdf->WriteHTML($stylesheet6,\Mpdf\HTMLParserMode::HEADER_CSS);
                                $contents = ob_get_contents();
                                ob_end_clean();
                                
                                $mpdf->WriteHTML(trim($contents));
                                $mpdf->Output();*/
                                $contents = ob_get_contents();
                                ob_end_clean();
                                $DOMPDF = new DOMPDF();
                                //$DOMPDF->set_paper('A4', 'portrait');
                                //$DOMPDF->SetFont('Roboto');
                                $DOMPDF->set_option('isRemoteEnabled', true);
                                $DOMPDF->load_html($contents);
                                $DOMPDF->render();
                                $DOMPDF->stream('Filename.pdf', array(
                                        'compress'      => 0,
                                        'Attachment'    => 0
                                ));
                                //echo $contents;
                        }
                ?>
                
