<?php


require __DIR__ . '/repository.php';
require __DIR__ . '/../models/reservation.php';

class RoomRepository extends Repository
{
    public function getReservationById($reservationId)
    {
        try {
            $sql = "SELECT * FROM reservations WHERE reservationId = :reservationId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':reservationId', $reservationId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Reservation');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllReservations()
    {
        try {
            $sql = "SELECT * FROM reservations";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Reservation');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getReservationsByUserId($userId)
    {
        try {
            $sql = "SELECT * FROM reservations WHERE userId = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Reservation');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getReservationsByRoomId($roomId)
    {
        try {
            $sql = "SELECT * FROM reservations WHERE roomId = :roomId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':roomId', $roomId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Reservation');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}