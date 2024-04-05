<?php
    include __DIR__ . '/../header.php';
    ?>
    </div>
    <script src="js/reservation.js"></script>
    <main class="flex-shrink-0">
    <div class="container mt-5">
        <h2 class="mb-4">Your Reservations</h2>
        <div class="row">
        <?php foreach ($reservations as $reservation): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Room <?php echo htmlspecialchars(100+$reservation->getRoomId()); ?></h5>
                        <p class="card-text">Number of Students: <?php echo htmlspecialchars($reservation->getNumberOfStudents()); ?></p>
                        <p class="card-text">Start Time: <?php echo htmlspecialchars($reservation->getStartTime()); ?></p>
                        <p class="card-text">End Time: <?php echo htmlspecialchars($reservation->getEndTime()); ?></p>
                    
                        <button onclick="displayReservationOnModal('<?= htmlspecialchars(json_encode($reservation), ENT_QUOTES, 'UTF-8') ?>')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal">Reserve</button>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>