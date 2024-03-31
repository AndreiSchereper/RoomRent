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
    
    public function getRooms()
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

    public function createRoom($roomName, $roomType, $roomPrice, $roomStatus)
    {
        $room = new Room();
        $room->setRoomName($roomName);
        $room->setRoomType($roomType);
        $room->setRoomPrice($roomPrice);
        $room->setRoomStatus($roomStatus);

        $room = $this->roomRepository->createRoom($room);
    
        return $room;

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