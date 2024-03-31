<?php

use App\Models\user;

require_once __DIR__ . '/../../app/models/user.php';
require_once __DIR__ . '/../../app/repositories/repository.php';

class UserRepository extends Repository
{
  public function getUserByEmail($email)
  {
    try {
      $sql = "SELECT * FROM users WHERE email = :email";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');
      return $stmt->fetch();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getUserById($userId)
  {
    try {
      $sql = "SELECT * FROM users WHERE userId = :userId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':userId', $userId);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');
      return $stmt->fetch();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getUsers()
  {
    try {
      $sql = "SELECT * FROM users";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  public function createUser($user)
  {
    try {
      $sql = "INSERT INTO users (email, password, firstName, lastName, role) VALUES (:email, :password, :firstName, :lastName, :role)";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':email', $user->getEmail());
      $stmt->bindParam(':password', $user->getPassword());
      $stmt->bindParam(':firstName', $user->getFirstName());
      $stmt->bindParam(':lastName', $user->getLastName());
      $stmt->bindParam(':role', $user->getRole());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function updateUser($user)
  {
    try {
      $sql = "UPDATE users SET email = :email, password = :password, firstName = :firstName, lastName = :lastName, role = :role WHERE userId = :userId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':email', $user->getEmail());
      $stmt->bindParam(':password', $user->getPassword());
      $stmt->bindParam(':firstName', $user->getFirstName());
      $stmt->bindParam(':lastName', $user->getLastName());
      $stmt->bindParam(':role', $user->getRole());
      $stmt->bindParam(':userId', $user->getUserId());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function deleteUser($userId)
  {
    try {
      $sql = "DELETE FROM users WHERE userId = :userId";
      $stmt = $this->connection->prepare($sql);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}