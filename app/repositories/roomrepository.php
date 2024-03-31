<?php

use App\Models\Room;

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/room.php';

class RoomRepository extends Repository
{
  public function getRoomById($roomId)
  {
    try {
      $sql = "SELECT * FROM rooms WHERE roomId = :roomId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomId', $roomId);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Room');
      return $stmt->fetch();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getRoomByType($roomType)
  {
    try {
      $sql = "SELECT * FROM rooms WHERE roomType = :roomType";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomType', $roomType);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Room');
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getRoomByStatus($roomStatus)
  {
    try {
      $sql = "SELECT * FROM rooms WHERE roomStatus = :roomStatus";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomStatus', $roomStatus);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Room');
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  public function getAllRooms()
  {
    try {
      $sql = "SELECT * FROM rooms";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\Room');
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function createRoom(Room $room)
  {
    try {
      $sql = "INSERT INTO rooms (roomNumber, roomType, roomStatus, imagePath) VALUES (:roomNumber, :roomType, :roomStatus, :imagePath)";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomNumber', $room->getRoomNumber());
      $stmt->bindParam(':roomType', $room->getRoomType());
      $stmt->bindParam(':roomStatus', $room->getStatus());
      $stmt->bindParam(':imagePath', $room->getImagePath());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function updateRoom(Room $room)
  {
    try {
      $sql = "UPDATE rooms SET roomNumber = :roomNumber, roomType = :roomType, roomStatus = :roomStatus, imagePath = :imagePath WHERE roomId = :roomId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomId', $room->getRoomId());
      $stmt->bindParam(':roomNumber', $room->getRoomNumber());
      $stmt->bindParam(':roomType', $room->getRoomType());
      $stmt->bindParam(':roomStatus', $room->getStatus());
      $stmt->bindParam(':imagePath', $room->getImagePath());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function deleteRoom($roomId)
  {
    try {
      $sql = "DELETE FROM rooms WHERE roomId = :roomId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomId', $roomId);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}