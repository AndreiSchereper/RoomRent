<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InHolland Room Reservation</title>
    <link rel="icon" type="image/x-icon" href="images/favicon2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="d-flex flex-column h-100">
<?php
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_unset();
    session_destroy();
}
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f06292;">
    <a class="navbar-brand" href="/home">InHolland Room Reservation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/reservation">Reservations</a>
            </li>
        </ul>
        <?php if(!isset($_SESSION['user'])): ?>
        <div class="ms-auto">
            <a class="btn btn-light me-2" href="/login">Login</a>
            <a class="btn btn-light" href="/register">Register</a>
        </div>
        <?php else: ?>
        <div class="ms-auto">
            <a class="btn btn-light me-2" href="/home?logout=true">Logout</a>
        <?php endif; ?>
    </div>
</nav>