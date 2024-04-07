<?php

class Room implements \JsonSerializable{

    const SMALL = "Small";
    const MEDIUM = "Medium";
    const LARGE = "Large";
    private $roomId;
    private $roomNumber;
    private $roomType;

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
        public function jsonSerialize():mixed
        {
            $vars=get_object_vars($this);
            return $vars;
        }
}
