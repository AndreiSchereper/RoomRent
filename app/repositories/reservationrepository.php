<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/reservation.php';

class ReservationRepository extends Repository
{
    public function getReservationById($reservationId)
    {
        try {
            $sql = "SELECT * FROM reservations WHERE reservationId = :reservationId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':reservationId', $reservationId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reservation');
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
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reservation');
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
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reservation');
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

    public function addReservation(Reservation $reservation)
    {
        try {
            $sql = "INSERT INTO reservations (userId, roomId, startTime, endTime, numberOfStudents) VALUES (:userId, :roomId, :startTime, :endTime, :numberOfStudents)";
            $stmt = $this->connection->prepare($sql);
            
            // Assign values to variables before binding them
            $userId = $reservation->getUserId();
            $roomId = $reservation->getRoomId();
            $startTime = $reservation->getStartTime();
            $endTime = $reservation->getEndTime();
            $numberOfStudents = $reservation->getNumberOfStudents();
            
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':roomId', $roomId);
            $stmt->bindParam(':startTime', $startTime);
            $stmt->bindParam(':endTime', $endTime);
            $stmt->bindParam(':numberOfStudents', $numberOfStudents);
            
            $stmt->execute();
        } catch (PDOException $e) {
            // It's generally not a good practice to output errors directly
            // Consider using a logging mechanism and returning or throwing an error
            // echo $e->getMessage();
            error_log($e->getMessage());
            // Optionally throw an exception or return false
        }
    }
}