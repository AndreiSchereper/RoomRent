<?php

class Reservation implements \JsonSerializable{

        private $reservationId;
        private $userId;
        private $roomId;
        private $startTime;
        private $endTime;
        private $numberOfStudents;

        public function getReservationId()
        {
            return $this->reservationId;
        }
        public function setReservationId($reservationId)
        {
            $this->reservationId = $reservationId;
        }
        public function getUserId()
        {
            return $this->userId;
        }
        public function setUserId($userId)
        {
            $this->userId = $userId;
        }
        public function getRoomId()
        {
            return $this->roomId;
        }
        public function setRoomId($roomId)
        {
            $this->roomId = $roomId;
        }
        public function getStartTime()
        {
            return $this->startTime;
        }
        public function setStartTime($startTime)
        {
            $this->startTime = $startTime;
        }
        public function getEndTime()
        {
            return $this->endTime;
        }
        public function setEndTime($endTime)
        {
            $this->endTime = $endTime;
        }
        public function getNumberOfStudents()
        {
            return $this->numberOfStudents;
        }
        public function setNumberOfStudents($numberOfStudents)
        {
            $this->numberOfStudents = $numberOfStudents;
        }
        public function jsonSerialize():mixed
        {
            $vars=get_object_vars($this);
            return $vars;
        }
}
