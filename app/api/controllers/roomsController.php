<?php
require_once __DIR__ . '/../../services/roomService.php';

class RoomsController
{
    private $roomService;

    public function __construct()
    {
        $this->roomService = new RoomService();
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['roomType']) && $_GET['roomType'] !== 'All')
            {
                $rooms = $this->roomService->getRoomsByType($_GET['roomType']);
                header('Content-Type: application/json');
                echo json_encode($rooms);
            } else if (isset($_GET['roomId'])) {
                $roomId = $_GET['roomId'];
                $room = $this->roomService->getRoomById($roomId);
                header('Content-Type: application/json');
                echo json_encode($room);
            } else{
                $rooms = $this->roomService->getAllRooms();
                header('Content-Type: application/json');
                echo json_encode($rooms);
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
             if(!isset($_POST['roomNumber']))
            {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Missing Data']);
                return;
            }
            $room = new Room();
            $room->setRoomNumber($_POST['roomNumber']);
            $room->setRoomType($_POST['roomType']);

            $this->roomService->createRoom($room);

            header('Content-Type: application/json');
            echo json_encode(['message' => 'Room created']);
        }

        if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            try{
                $roomId = $_GET['roomId'];
                $this->roomService->deleteRoom($roomId);
                header('Content-Type: application/json');
                echo json_encode(['success' => 'Room deleted successfully']);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true); // Decode JSON from the input
            if (isset($_GET['roomId'])) {
                $roomId = $_GET['roomId'];
                $room = new Room();
                $room->setRoomId($roomId);
                $room->setRoomNumber($data['roomNumber']);
                $room->setRoomType($data['roomType']);
                $this->roomService->updateRoom($room);
                // Success response
                echo json_encode(['message' => 'Room updated successfully']);
            } else {
                // Error handling
                http_response_code(400); // Bad request
                echo json_encode(['error' => 'Room ID is missing']);
            }
        }
    }
}