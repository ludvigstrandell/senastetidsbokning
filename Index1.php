<html>
<head>
    <link href="calendar.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php

include 'Calendar.php';
include 'Booking.php';
include 'BookableCell.php';
 
 
$booking = new Booking();
 
$bookableCell = new BookableCell($booking);
 
$calendar = new calendar();
 
$calendar->attachObserver('showCell', $bookableCell);
 
$bookableCell->routeActions();
 
echo $calendar->show();
?>
</body>
</html>