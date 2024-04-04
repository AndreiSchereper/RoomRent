<?php
require_once __DIR__ . '/../services/reservationservice.php';

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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handleReservationRequest('add');
        }

        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->handleReservationRequest('delete');
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

####
        $recipe_title = $this->favoriteService->getFavRecipeTitle($object->recipe_id);

        if ($request_type == 'POST') {
            if (!$this->reservationService->existsInFavorites($favorite)) {
                $this->favoriteService->addToFavorites($favorite);
                $message = $recipe_title. ' was added to favorites';
            }else{
                $message = $recipe_title.' already exists in favorites';
            }
        }

        if ($request_type == 'DELETE') {
            $this->favoriteService->removeFromFavorites($favorite);
            $message = $recipe_title.' was removed from favorites';
        }

        header('Content-Type: application/json');
        echo json_encode(['message' => $message, 'favorite' => $favorite ]);
    }
}