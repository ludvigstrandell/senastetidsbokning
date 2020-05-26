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
    include 'db.php';
    $userid = $_SESSION['user_id'];
    $statement = $db->prepare("SELECT id FROM bookings WHERE User_id = :user_id");
    $statement->bindParam(':user_id', $userid);
    $statement->execute();
    $found = $statement->fetchColumn();
    if( $found ) 
    {
        $statement = $this->dbh->prepare(
            'DELETE from ' . $this->bookingsTableName . ' WHERE id = :id '
        );
        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }
        if (false === $statement->execute([
            ':id' => $id
            ])) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }
    } 
    else 
    {
        
    }
}



}