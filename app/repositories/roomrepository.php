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
  public function getRooms()
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
  public function createRoom($room)
  {
    try {
      $sql = "INSERT INTO rooms (roomName, roomType, roomPrice, roomStatus) VALUES (:roomName, :roomType, :roomPrice, :roomStatus)";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomName', $room->getRoomName());
      $stmt->bindParam(':roomType', $room->getRoomType());
      $stmt->bindParam(':roomPrice', $room->getRoomPrice());
      $stmt->bindParam(':roomStatus', $room->getRoomStatus());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function updateRoom($room)
  {
    try {
      $sql = "UPDATE rooms SET roomName = :roomName, roomType = :roomType, roomPrice = :roomPrice, roomStatus = :roomStatus WHERE roomId = :roomId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomName', $room->getRoomName());
      $stmt->bindParam(':roomType', $room->getRoomType());
      $stmt->bindParam(':roomPrice', $room->getRoomPrice());
      $stmt->bindParam(':roomStatus', $room->getRoomStatus());
      $stmt->bindParam(':roomId', $room->getRoomId());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  
}