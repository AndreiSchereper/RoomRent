<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/roomservice.php';

class HomeController extends Controller
{
    private $roomService;

    function __construct()
    {
        $this->roomService = new RoomService();
    }
    public function index()
    {
        $rooms = $this->roomService->getAllRooms();
        $this->displayView(['rooms' => $rooms]);
    }

}