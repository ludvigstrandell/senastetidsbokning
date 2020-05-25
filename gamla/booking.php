<?php
 

    date_default_timezone_set('Europe/Stockholm');

    $dbh = new PDO ('sqlite:C:\Users\nilsn\tidsbokningg\senastetidsbokning\Database\Takterassen.db');

    $bookings = 'bookings';

    $bookingDate = date();
    
 
    function index()
    {
        $statement = $this->dbh->query('SELECT * FROM ' . $this->bookings);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function add($bookingDate)
{
    $statement = $this->dbh->prepare(
        'INSERT INTO ' . $this->bookings . ' (booking_date) VALUES (:bookingDate)'
    );
 
    // if (false === $statement) {
    //     throw new Exception('Invalid prepare statement');
    // }
 
    // if (false === $statement->execute([
    //         ':bookingDate' => $bookingDate->format('Y-m-d'),
    //     ])) {
    //     throw new Exception(implode(' ', $statement->errorInfo()));
    // }
}

function delete($id)
{
    $statement = $this->dbh->prepare(
        'DELETE from ' . $this->bookings . ' WHERE id = :id'
    );
    // if (false === $statement) {
    //     throw new Exception('Invalid prepare statement');
    // }
    // if (false === $statement->execute([':id' => $id])) {
    //     throw new Exception(implode(' ', $statement->errorInfo()));
    // }
}