<?php

require_once __DIR__ . '/controller.php';
require __DIR__ . '/../models/user.php';
require __DIR__ . '/../services/userService.php';

class RegisterController extends Controller
{
    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function index()
    {
        $this->register();

        $this->displayView($this);

    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check for empty fields
            if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['errorMessage'] = "All fields are required";
                header('Location: /register');
                exit;
            } else {
                // Sanitize input to prevent XSS attacks
                $firstName = htmlspecialchars($_POST['firstName']);
                $lastName = htmlspecialchars($_POST['lastName']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                // Check if the user already exists
                if ($this->userService->userExists($email)) {
                    $_SESSION['errorMessage'] = "User already exists";
                } elseif (!$this->userService->validatePassword($password)) { // Validate password
                    $_SESSION['errorMessage'] = "Password must be between 8 and 20 characters";
                } else {
                    // Create a new user
                    $user = $this->userService->createUser($firstName, $lastName, $email, $password);
                    $this->userService->register($user);

                    // Set a success message and redirect to the login page
                    $_SESSION['successMessage'] = "You have successfully registered!\nYou can now log in.";
                    sleep(1); // Optional: Sleep to simulate processing time

                    header('Location: /login');
                    exit;
                }
                header('Refresh: 2; URL=/signup');
                return;
            }
        }
    }
}
