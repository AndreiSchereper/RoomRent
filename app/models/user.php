<?php

namespace App\Models;

class User implements \JsonSerializable{

  private $id;
  private $email;
  private $password;
  private $name;
        private $role;
        
        public function __construct($id, $email, $password, $name, $role)
        {
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->name = $name;
            $this->role = $role;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($password) {
     
            if(empty($password) || password_needs_rehash($password, PASSWORD_BCRYPT)){
               // echo "the password is empty ";
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->password = $hashedPassword;
            }
            else{
               // echo "the password is not Empty and does not need to be rehashed ";
                $this->password = $password;
            }

        }
  
        public function getUserId()
        {
            return $this->id;
        }  
        public function setUserId($userId)
        {
            $this->id = $userId;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function getName()
        {
            return $this->name;
        }
        public function setName($name)
        {
            $this->name = $name;
        }
        public function getRole()
        {
            return $this->role;
        }
        public function setRole($role)
        {
            $this->role = $role;
        }
        public function jsonSerialize():mixed
        {
            $vars=get_object_vars($this);
            return $vars;
        }
}
