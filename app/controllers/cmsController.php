<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/userService.php';
require __DIR__ . '/../services/roomService.php';

class CmsController extends Controller
{
    private $userService;
    private $roomService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->roomService = new RoomService();
    }

    public function index()
    {
        $this->displayView($this);
    }

}