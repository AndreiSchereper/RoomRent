<?php

class Room implements \JsonSerializable{

    const SMALL = "Small";
    const MEDIUM = "Medium";
    const LARGE = "Large";
    const AVAILABLE = "available";
    const RESERVED = "reserved";
    private $roomId;
    private $roomNumber;
    private $roomType;
    private $status;
    private $imagePath;

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

        public function getImagePath()
        {
            return $this->imagePath;
        }

        public function setImagePath($imagePath)
        {
            $this->imagePath = $imagePath;
        }
        public function jsonSerialize():mixed
        {
            $vars=get_object_vars($this);
            return $vars;
        }
}
