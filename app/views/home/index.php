    <?php
    include __DIR__ . '/../header.php';
    ?>
    <div class="header-image" style="background-image: url('images/banner2.webp');">
        <div class="arrow-down">
            <i class="fas fa-chevron-down"></i> <!-- Using Font Awesome for the arrow icon -->
        </div>
    </div>

    <main class="flex-shrink-0">
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
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>