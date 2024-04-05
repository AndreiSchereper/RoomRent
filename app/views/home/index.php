    <?php
    include __DIR__ . '/../header.php';

    if (isset($_SESSION['userId'])) {
        echo "<script>const userId = " . json_encode($_SESSION['userId']) . ";</script>";
    } else {
        echo "<script>const userId = null;</script>";
    }
    ?>
    <script src="js/room.js"></script>
    <main class="flex-shrink-0">
    <div class="container mt-5">
        <div class="filter-options mb-4">
            <label for="roomTypeFilter">Filter by Room Type:</label>
            <select id="roomTypeFilter" class="form-select" onchange="filterRooms()">
                <option value="All">All</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
        </div>

        <h2 class="mb-4">Available Rooms</h2>
        <div class="row" id="roomsContainer">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Room <?php echo htmlspecialchars($room->getRoomNumber()); ?></h5>
                        <p class="card-text">Size: <?php echo htmlspecialchars($room->getRoomType()); ?></p>
                        
                        <?php if (isset($_SESSION['userId'])): ?>
                            <!-- If user is logged in, allow reservation -->
                            <button onclick="displayRoomOnModal('<?= htmlspecialchars(json_encode($room), ENT_QUOTES, 'UTF-8') ?>')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal">Reserve</button>
                        <?php else: ?>
                            <!-- If user is not logged in, disable the button and prompt to log in -->
                            <button class="btn btn-secondary" disabled>Please log in to reserve</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4">Available Rooms</h2>
        <div class="row">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Room <?php echo htmlspecialchars($room->getRoomNumber()); ?></h5>
                        <p class="card-text">Size: <?php echo htmlspecialchars($room->getRoomType()); ?></p>
                        
                        <?php if (isset($_SESSION['userId'])): ?>
                            <!-- If user is logged in, allow reservation -->
                            <button onclick="displayRoomOnModal('<?= htmlspecialchars(json_encode($room), ENT_QUOTES, 'UTF-8') ?>')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal">Reserve</button>
                        <?php else: ?>
                            <!-- If user is not logged in, disable the button and prompt to log in -->
                            <button class="btn btn-secondary" disabled>Please log in to reserve</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    <div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div id="errorMessages"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reserveModalLabel">Reserve a Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div id="reserveContent" class="modal-body">
                </div>
            </div>
        </div>
    </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>