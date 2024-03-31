<?php

use App\Models\Reservation;

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

    public function getReservations()
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
    public function createReservation($reservation)
    {
        try {
            $sql = "INSERT INTO reservations (roomId, userId, checkInDate, checkOutDate, totalAmount) VALUES (:roomId, :userId, :checkInDate, :checkOutDate, :totalAmount)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':roomId', $reservation->getRoomId());
            $stmt->bindParam(':userId', $reservation->getUserId());
            $stmt->bindParam(':checkInDate', $reservation->getCheckInDate());
            $stmt->bindParam(':checkOutDate', $reservation->getCheckOutDate());
            $stmt->bindParam(':totalAmount', $reservation->getTotalAmount());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateReservation($reservation)
    {
        try {
            $sql = "UPDATE reservations SET roomId = :roomId, userId = :userId, checkInDate = :checkInDate, checkOutDate = :checkOutDate, totalAmount = :totalAmount WHERE reservationId = :reservationId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':roomId', $reservation->getRoomId());
            $stmt->bindParam(':userId', $reservation->getUserId());
            $stmt->bindParam(':checkInDate', $reservation->getCheckInDate());
            $stmt->bindParam(':checkOutDate', $reservation->getCheckOutDate());
            $stmt->bindParam(':totalAmount', $reservation->getTotalAmount());
            $stmt->bindParam(':reservationId', $reservation->getReservationId());
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}