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
    
    public function getReservationById($reservationId)
    {
        return $this->reservationRepository->getReservationById($reservationId);
    }
    
    public function getReservations()
    {
        return $this->reservationRepository->getReservations();
    }
    
    public function getReservationsByUserId($userId)
    {
        return $this->reservationRepository->getReservationsByUserId($userId);
    }

    public function getReservationsByRoomId($roomId)
    {
        return $this->reservationRepository->getReservationsByRoomId($roomId);
    }

    public function createReservation($userId, $roomId, $checkInDate, $checkOutDate)
    {
        $reservation = new Reservation();
        $reservation->setUserId($userId);
        $reservation->setRoomId($roomId);
        $reservation->setCheckInDate($checkInDate);
        $reservation->setCheckOutDate($checkOutDate);
    
        return $reservation;
    }
    
    public function updateReservation($reservation)
    {
        return $this->reservationRepository->updateReservation($reservation);
    }
    
    public function deleteReservation($reservationId)
    {
        return $this->reservationRepository->deleteReservation($reservationId);
    }
}