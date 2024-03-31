<?php

namespace App\Models;

class Room implements \JsonSerializable{

        const SMALL = "small";
        const MEDIUM = "medium";
        const LARGE = "large";
        const AVAILABLE = "available";
        const RESERVED = "reserved";
        private $roomId;
        private $roomNumber;
        private $roomType;
        private $status;

        public function __construct($roomId, $roomNumber, $roomType, $status)
        {
            $this->roomId = $roomId;
            $this->roomNumber = $roomNumber;
            $this->roomType = $roomType;
            $this->status = $status;
        }
        public function getRoomId()
        {
            return $this->roomId;
        }
        public function setRoomId($roomId)
        {
            $this->roomId = $roomId;
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
