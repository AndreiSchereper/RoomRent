<?php

namespace App\Models;

class Room implements \JsonSerializable{

        private $id;
        private $roomNumber;
        private $roomType;
        private $capacity;
        private $status;

        public function __construct($id, $roomNumber, $roomType, $capacity, $status)
        {
            $this->id = $id;
            $this->roomNumber = $roomNumber;
            $this->roomType = $roomType;
            $this->capacity = $capacity;
            $this->status = $status;
        }
        public function getRoomId()
        {
            return $this->id;
        }
        public function setRoomId($roomId)
        {
            $this->id = $roomId;
        }
        public function getRoomNumber()
        {
            return $this->roomNumber;
        }
        public function setRoomNumber($roomNumber)
        {
            $this->roomNumber = $roomNumber;
        }
        public function getRoomType()
        {
            return $this->roomType;
        }
        public function setRoomType($roomType)
        {
            $this->roomType = $roomType;
        }
        public function getCapacity()
        {
            return $this->capacity;
        }
        public function setCapacity($capacity)
        {
            $this->capacity = $capacity;
        }
        public function getStatus()
        {
            return $this->status;
        }
        public function setStatus($status)
        {
            $this->status = $status;
        }
        
        public function jsonSerialize():mixed
        {
            $vars=get_object_vars($this);
            return $vars;
        }
}
