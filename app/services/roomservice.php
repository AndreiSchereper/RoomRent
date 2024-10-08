<?php
include_once __DIR__ . '/../repositories/roomRepository.php';
require_once __DIR__ . '/../models/room.php';

class RoomService
{
    private $roomRepository;
    
    public function __construct()
    {
        $this->roomRepository = new RoomRepository();
    }
    
    public function getRoomById($roomId)
    {
        return $this->roomRepository->getRoomById($roomId);
    }
    
    public function getAllRooms()
    {
        return $this->roomRepository->getAllRooms();
    }
    
    public function getRoomByType($roomType)
    {
        return $this->roomRepository->getRoomByType($roomType);
    }

    public function getRoomByStatus($roomStatus)
    {
        return $this->roomRepository->getRoomByStatus($roomStatus);
    }

    public function createRoom($room)
    {
        return $this->roomRepository->createRoom($room);
    }
    

    public function updateRoom($room)
    {
        return $this->roomRepository->updateRoom($room);
    }
    
    public function deleteRoom($roomId)
    {
        return $this->roomRepository->deleteRoom($roomId);
    }
}