<?php
require_once __DIR__ . '/../services/roomService.php';

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
            $rooms = $this->roomService->getAllRooms();
            header('Content-Type: application/json');
            echo json_encode($rooms);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $roomId = isset($_POST['roomId']) ? (int) $_POST['roomId'] : 0;
            $roomNumber = isset($_POST['roomNumber']) ? htmlspecialchars($_POST['roomNumber']) : '';
            $roomType = isset($_POST['roomType']) ? htmlspecialchars($_POST['roomType']) : '';
            $status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : '';
            $imagePath = isset($_POST['imagePath']) ? htmlspecialchars($_POST['imagePath']) : '';

            if (!empty($_FILES['image']['name'])) {
                $uploadedImage = $_FILES['image'];
                $imagePath = '/../public/images/' . basename($uploadedImage['name']);
                move_uploaded_file($uploadedImage['tmp_name'], 'images/' . $uploadedImage['name']);
            }

            $room = new Room();
            $room->setRoomId($roomId);
            $room->setRoomNumber($roomNumber);
            $room->setRoomType($roomType);
            $room->setStatus($status);
            $room->setImagePath($imagePath);

            if ($roomId === 0) {
                if ($this->roomService->createRoom($room)) {
                    $message ='Room '. $room->getRoomNumber() . ' was added successfully';
                } else {
                    $message ='Room '. $room->getRoomNumber() . ' was not added';
                }
            } else {
                if ($this->roomService->updateRoom($room)) {
                    $message ='Room '. $room->getRoomNumber() . ' was updated successfully';
                } else {
                    $message ='Room '. $room->getRoomNumber() . ' was not updated';
                }
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'room' => $room]);

        }
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($this->roomService->deleteRoom($object->id)) {
                $message = $object->title . ' was deleted';
            } else {
                $message = $object->title . ' was not deleted';
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'recipe' => $object]);
        }
    }
}