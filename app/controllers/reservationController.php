<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/reservationService.php';

class ReservationController extends Controller
{
    private $reservationService;

    function __construct()
    {
        $this->reservationService = new ReservationService();
    }
    public function index()
    {
        $reservations = $this->reservationService->getReservationsByUserId($_SESSION['userId']);
        $this->displayView(['reservations' => $reservations]);
    }

}