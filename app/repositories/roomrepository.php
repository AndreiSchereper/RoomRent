<?php

require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/room.php';

class RoomRepository extends Repository
{
  public function getAllRooms()
  {
    try {
      $sql = "SELECT * FROM rooms";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Room');
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getRoomById($roomId)
  {
    try {
      $sql = "SELECT * FROM rooms WHERE roomId = :roomId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomId', $roomId);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Room');
      return $stmt->fetch();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  
  public function getRoomsByType($roomType)
  {
    try {
      $sql = "SELECT * FROM rooms WHERE roomType = :roomType";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomType', $roomType);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Room');
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function createRoom(Room $room)
  {
      try {
          // Note: Removed the trailing comma in the VALUES list
          $sql = "INSERT INTO rooms (roomNumber, roomType) VALUES (:roomNumber, :roomType)";
          $stmt = $this->connection->prepare($sql);
          
          // Assign values to variables before binding them
          $roomNumber = $room->getRoomNumber();
          $roomType = $room->getRoomType();
          
          $stmt->bindParam(':roomNumber', $roomNumber);
          $stmt->bindParam(':roomType', $roomType);
          
          $stmt->execute();
      } catch (PDOException $e) {
          // Logging the error to PHP's system logger instead of echoing it
          error_log($e->getMessage());
          // Optionally, you can throw an exception or return a value indicating failure
      }
  }


  public function updateRoom($room)
  {
    try {
      $sql = "UPDATE rooms SET roomNumber = :roomNumber, roomType = :roomType WHERE roomId = :roomId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':roomNumber', $room->getRoomNumber());
      $stmt->bindParam(':roomType', $room->getRoomType());
      $stmt->bindParam(':roomId', $room->getRoomId());
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