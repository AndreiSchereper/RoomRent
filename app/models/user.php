<?php

namespace App\Models;

class User implements \JsonSerializable{

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    private $userId;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $role;
        
        public function __construct($userId, $email, $password, $firstName, $lastName, $role)
        {
            $this->userId = $userId;
            $this->email = $email;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->role = $role;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($password) {
     
            if(empty($password) || password_needs_rehash($password, PASSWORD_BCRYPT)){
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->password = $hashedPassword;
            }
            else{
                $this->password = $password;
            }

        }
  
        public function getUserId()
        {
            return $this->userId;
        }  
        public function setUserId($userId)
        {
            $this->userId = $userId;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function getFirstName()
        {
            return $this->firstName;
        }
        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }
        public function getLastName()
        {
            return $this->lastName;
        }
        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }
        public function getRole()
        {
            return $this->role;
        }
        public function setRole($role)
        {
            $this->role = $role;
        }
        public function getFullName()
        {
            return $this->firstName . ' ' . $this->lastName;
        }
        public function jsonSerialize():mixed
        {
            $vars=get_object_vars($this);
            return $vars;
        }
}
