<?php 
include 'Databaseinfo.php';
session_start();
if ( isset( $_SESSION['user_id'] ) ) 
{
	
} 
else 
{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAKTERASSEN</title>
    <link rel="stylesheet" type="text/css" href="mainpagestyle.css">
    <link href="calendar.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="MainPage.js"></script>
</head>
<body>
    <div id="container">
        <div class="header">
            <h1>TAKTERASSEN</h1>
        </div>
        <div class="topnav">
            <a class="home" href="#home">Home</a>
            <a href="#profile">Profile</a>
            <a href="Logout.php">Log Out</a>
          </div>
          <div class="row">

            
              <div class="col-lg-6">
<<<<<<< HEAD:Mainpage.html

                <script>jQuery('#window').load('index1.php'); </script>
=======
                  <?php
              include 'Calendar.php';
include 'Booking.php';
include 'BookableCell.php';
 
 
$booking = new Booking(
    'tutorial',
    'localhost',
    'root',
    ''
);
 
$bookableCell = new BookableCell($booking);
 
$calendar = new Calendar();
 
$calendar->attachObserver('showCell', $bookableCell);
 
$bookableCell->routeActions();
 
echo $calendar->show();
?>
>>>>>>> eaa1c509a8e7668c25c1fc1dbc8d9f05cd5265db:Mainpage.php

              </div>

            
              </div>
             
            </div>
              

          
</body>
</html>