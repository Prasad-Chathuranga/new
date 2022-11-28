<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Dank je!</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/translate.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            .thankyou-page ._header {
                background-color: #e9f6ff;
                padding: 100px 30px;
                text-align: center;
                
            }

            .thankyou-page ._header .logo {
                max-width: 200px;
                margin: 0 auto 50px;
                padding: 4em 0;
            }

            .thankyou-page ._header .logo img {
                width: 100%;
            }

            .thankyou-page ._header h1 {
                font-size: 65px;
                font-weight: 800;
                color: #1c62d3;
                margin: 0;
            }

            .thankyou-page ._body {
                margin: -70px 0 30px;
            }

            .thankyou-page ._body ._box {
                margin: auto;
                max-width: 80%;
                padding: 50px;
                background: white;
                border-radius: 3px;
                box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
                -moz-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
                -webkit-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
            }
            .thankyou-page ._body ._box h2 {
                font-size: 32px;
                font-weight: 600;
                color: #4ab74a;
            }

            .thankyou-page ._footer {
                text-align: center;
                padding: 50px 30px;
            }

            .thankyou-page ._footer .btn {
                background: #4ab74a;
                color: white;
                border: 0;
                font-size: 14px;
                font-weight: 600;
                border-radius: 0;
                letter-spacing: 0.8px;
                padding: 20px 33px;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <!-- HEADER -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a href="" class="navbar-brand p-0">
                        <img src="./img/Leegruimte_Logo.png" class="headerLogo" alt="" />
                    </a>
                    <button class="navbar-toggler navbarToggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span><i class="fa-solid fa-bars"></i>MENU</span>
                    </button>
                    <div class="collapse navbar-collapse navbarCollapse" id="navbarNav">
                        <ul class="navbar-nav navbarNav ms-auto">
                            <li style="margin-top: 0.4em">
                                <a href="index.php" class="nav-link navLink">JuisteBoekhouder.nl</a>
                            </li>
                            <li style="margin-top: 0.4em">
                                <a href="./accountant/login.php" class="nav-link navLink">Aanmelden als Boekhouder</a>
                            </li>
                            <?php
                            /*<li>
                                <a href="#" class="nav-link navLink translate Dutch" data-lang="Dutch" style="padding-right: 5px;" translate="no">Dutch</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link navLink translate English" data-lang="English" style="padding-right: 5px;" translate="no">English</a>
                            </li>*/
                            ?>
                            <li style="margin-top: 0.4em">
                                <a href="" class="nav-link envelope pt-0">
                                    <i class="fa-regular fa-envelope"></i>
                                </a>
                            </li>
                            <?php
                                /*<li>
                                    <select name="chLanguage" id="chLanguage" class="form-control inputBox">
                                        <option value="">Select Language</option>
                                        <option value="Dutch" translate="no">Dutch</option>
                                        <option value="English" translate="no">English</option>
                                    </select>
                                </li>*/
                            ?>
                        </ul>
                        <!-- Use CSS to replace link text with flag icons -->
                        <!-- Code provided by Google -->
                        <?php /*<div id="google_translate_element" style="visibility: hidden"></div>*/ ?>
                        <!-- <select name="lang" id="lang">
                            <option value="en">EN</option>
                            <option value="nl">NL</option>
                        </select> -->
                    </div>
                </div>
            </nav>
        </header>
        <!-- HERO SECTION -->
        <div class="thankyou-page">
            <div class="_header">
                <div class="logo">
                    <!--img src="https://codexcourier.com/images/banner-logo.png" alt="">-->
                </div>
                <h1>Dank je!</h1>
            </div>
            <div class="_body">
                <div class="_box">
                    <h2>
                        <strong>Uw aanvraag is succesvol ingediend. We nemen zo snel mogelijk contact met je op</strong>
                    </h2>
                </div>
            </div>
            <div class="_footer">
                <a class="btn" href="index.php">Terug naar de startpagina</a>
                <p style="margin-top: 5.0em">&nbsp;</p>
                <p><br>&nbsp;<br></p>
            </div>
        </div>
        <!-- FOOTER -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footerCopyRight">
                            <a href="index.php">JuisteBoekhouder.nl</a>
                            <a href="">Aanmelden als Boekhouder</a>
                            <p>© COPYRIGHT - JUISTEBOEKHOUDER.NL</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="accountant/js/jquery-3.2.1.min.js"></script>
        <!-- Flag click handler -->
    </body>
</html>