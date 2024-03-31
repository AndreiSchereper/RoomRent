<?php
include_once __DIR__ . '/../repositories/userrepository.php';
require_once __DIR__ . '/../models/user.php';

class UserService
{
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function getUserByEmail($email)
  {
    return $this->userRepository->getUserByEmail($email);
  }

  public function getUserById($userId)
  {
    return $this->userRepository->getUserById($userId);
  }

  function create_user($name, $email, $password)
  {
      $user = new User();
      $user->setName($name);
      $user->setEmail($email);
      $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
      $user->setRole(User::USER);

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

  public function login($email, $password)
  {
    $userRepository = new UserRepository();
    $user = $userRepository->getUserByEmail($email);
    if ($user && password_verify($password, $user->getPassword())) {
      return $user;
    }
    return null;
  }

  public function register($user)
  {
    $userRepository = new UserRepository();
    $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
    $userRepository->createUser($user);
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