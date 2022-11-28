<?php 
// session_start();
include("../connection.php"); 
  
  //  $id=$_SESSION['id'];
  //  $name=$_SESSION['name'];
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
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="css/available leads-style.css" />
    <link rel="stylesheet" href="css/refunds-style.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    
    <title>Feedback</title>
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
      .inlineList {
    display: flex;
    flex-direction: row;
    /* Below sets up your display method: flex-start|flex-end|space-between|space-around */
    justify-content: flex-start; 
    /* Below removes bullets and cleans white-space */
    list-style: none;
    padding: 0;
    padding-right: 5ps;
    /* Bonus: forces no word-wrap */
    white-space: nowrap;
  }
    </style>
    <!-- google transalte style -->
  </head>