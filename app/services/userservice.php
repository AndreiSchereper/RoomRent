<?php
include_once __DIR__ . '/../repositories/userRepository.php';
require_once __DIR__ . '/../models/user.php';

class UserService
{
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function getAllUsers()
  {
    return $this->userRepository->getAllUsers();
  }
  public function getUserByEmail($email)
  {
    return $this->userRepository->getUserByEmail($email);
  }

  public function getUserById($userId)
  {
    return $this->userRepository->getUserById($userId);
  }

  public function createUser($firstName, $lastName, $email, $password)
  {
    $user = new User();
    $user->setFirstName($firstName);
    $user->setLastName($lastName);
    $user->setEmail($email);
    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
    $user->setRole('user');

    return $user;
  }
  public function updateUser($user)
  {
    return $this->userRepository->updateUser($user);
  }

  public function deleteUser($userId)
  {
    return $this->userRepository->deleteUser($userId);
  }

  public function register($user)
  {
    return $this->userRepository->createUser($user);
  }

  function userExists($email)
  {
      $existingUser = $this->getUserByEmail($email);
      if ($existingUser) {
          return true;
      } else {
          return false;
      }
  }
  function validatePassword($password)
  {
      if ($password != null && strlen($password) >= 8 && strlen($password) <= 20) {
          return true;
      } else {
          return false;
      }
  }
}