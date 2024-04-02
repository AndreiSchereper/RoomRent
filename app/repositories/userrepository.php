<?php

require_once __DIR__ . '/../../app/models/user.php';
require_once __DIR__ . '/../../app/repositories/repository.php';

class UserRepository extends Repository
{

    public function getAllUsers()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetchAll();
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
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUserByEmail($email)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createUser($user)
    {
        try {
            $sql = "INSERT INTO users (email, password, firstName, lastName, role) VALUES (:email, :password, :firstName, :lastName, :role)";
            $stmt = $this->connection->prepare($sql);
            $email = $user->getEmail();
            $password = $user->getPassword();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $role = $user->getRole();
            
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            return $this->getUserByEmail($user->getEmail());
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
      return $this->getUserById($user->getUserId());
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function deleteUser($userId)
  {
    try {
      $sql = "DELETE FROM users WHERE userId = :userId";
      $stmt = $this->connection->prepare($sql);
      $stmt->bindParam(':userId', $userId);
      $stmt->execute();
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}