<?php
 
class Booking
{
 
    private $dbh;
 
    private $bookingsTableName = 'bookings';
 
    public function __construct()
    {
    
            $this->dbh = new PDO ('sqlite:Database\Takterassen.db');

    }

    public function index()
{
    $statement = $this->dbh->query('SELECT * FROM ' . $this->bookingsTableName);
    return $statement->fetchAll(PDO::FETCH_ASSOC);

}

public function add(DateTimeImmutable $bookingDate)
{
    $userid = $_SESSION['user_id'];
    $statement = $this->dbh->prepare(
        'INSERT INTO ' . $this->bookingsTableName . ' (booking_date, User_id) VALUES (:bookingDate, :userid)'
    );
 
    if (false === $statement) {
        throw new Exception('Invalid prepare statement');
    }
 
    if (false === $statement->execute([
            ':bookingDate' => $bookingDate->format('Y-m-d'),
            ':userid' => $userid
        ])) {
        throw new Exception(implode(' ', $statement->errorInfo()));
    }
}

public function delete($id)
{
    $statement = $this->dbh->prepare(
        'DELETE from ' . $this->bookingsTableName . ' WHERE id = :id'
    );
    if (false === $statement) {
        throw new Exception('Invalid prepare statement');
    }
    if (false === $statement->execute([':id' => $id])) {
        throw new Exception(implode(' ', $statement->errorInfo()));
    }
}



}