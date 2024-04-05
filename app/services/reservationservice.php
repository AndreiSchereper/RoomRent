<?php
include_once __DIR__ . '/../repositories/reservationrepository.php';
require_once __DIR__ . '/../models/reservation.php';

class ReservationService
{
    private $reservationRepository;
    
    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository();
    }
    
    public function getReservationsByUserId($userId)
    {
        return $this->reservationRepository->getReservationsByUserId($userId);
    }

    public function getALlReservations()
    {
        return $this->reservationRepository->getAllReservations();
    }
    
    public function addReservation($reservation)
    {
        return $this->reservationRepository->addReservation($reservation);
    }
}