<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>
    <div class="container mt-5">
        <h2 class="mb-4">Available Rooms</h2>
        <div class="row">
            <!-- Room Card 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="room_image.jpg" class="card-img-top" alt="Room Image">
                    <div class="card-body">
                        <h5 class="card-title">Room 101</h5>
                        <p class="card-text">This is a small study room, perfect for group discussions. Fits 4-6 people.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <!-- More room cards can be added here following the same structure -->
        </div>
    </div>
    <?php
    include __DIR__ . '/../footer.php';
    ?>