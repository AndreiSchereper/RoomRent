<?php
require_once __DIR__ . '/../../services/reservationservice.php';

class ReservationsController
{
    private $reservationService;

    public function __construct()
    {
        $this->reservationService = new ReservationService();
    }

    public function index()
    {
        $loggedInUserId = null;

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_SESSION['userId'])) {
                $loggedInUserId = $_SESSION['userId'];
            } else {
                $_SESSION['errorMessage'] = 'You need to log in first.';
                header('Location: /login');
                exit();
            }

            $reservations = $this->reservationService->getReservationsByUserId($loggedInUserId);

            header('Content-Type: application/json');
            echo json_encode($reservations);
        }

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $this->handleReservationRequest('POST');
        }

    }

    public function handleReservationRequest($request_type)
    {
        $body = file_get_contents('php://input');
        $object = json_decode($body);

        if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid JSON']);
            return;
        }

        $reservation = new Reservation();
        $reservation->setUserId($object->userId);
        $reservation->setRoomId($object->roomId);
        $reservation->setStartTime($object->startTime);
        $reservation->setEndTime($object->endTime);
        $reservation->setNumberOfStudents($object->numberOfStudents);

        if ($request_type == 'POST') {
            $this->reservationService->addReservation($reservation);
            $message = 'Reservation added';

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'reservation' => $reservation]);
        }

        if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            try{
                $reservationId = $_GET['reservationId'];
                $this->reservationService->deleteReservation($reservationId);
                header('Content-Type: application/json');
                echo json_encode(['success' => 'Reservation deleted successfully']);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }
}