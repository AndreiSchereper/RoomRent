<?php
    include __DIR__ . '/../header.php';
    enum RoomType: string {
        case Small = "Small";
        case Medium = "Medium";
        case Large = "Large";
    }
    ?>
    </div>
    <main class="flex-shrink-0">
    <div class="form-container">
    <div class="col-sm-12 col-md-6 col-lg-6">
                <p class="text-color">Add a New Room</p>
                <form id="roomForm">
                    <div class="mb-3">
                        <label for="roomNumberAdd" class="form-label">Room Number</label>
                        <input type="number" class="form-control" id="roomNumberAdd" name="roomNumberAdd">
                    </div>
                    <div class="mb-3">
                    <label for="roomTypeAdd" class="form-label">Room Type</label>
                    <select class="form-control" id="roomTypeAdd" name="roomTypeAdd">
                        <?php foreach (RoomType::cases() as $case): ?>
                            <option value="<?= $case->value ?>"><?= $case->value ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <button onclick="addRoom()" type="button" class="crud-btn-style">Add</button>
                    <button onclick="loadAndDisplayRoom(true)" type="button" class="crud-btn-style" data-bs-toggle="modal" data-bs-target="#updateRoomModal">
                        Update
                    </button>
                    <button onclick="loadAndDisplayRoom(false)" type="button" class="crud-btn-style" data-bs-toggle="modal" data-bs-target="#deleteRoomModal">
                        Delete
                    </button>
                    <p id="roomMessageAdd"></p>
                </form>
            </div>
            <div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="deleteRoomModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteRoomModalLabel">Delete a Room</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="roomDelete">Select an Id:</label>
                                <select class="form-control" name="roomDelete" id="roomIdDelete">

                                </select>
                            </div>
                            <div>
                                <button id="btnDeleteRoom" type="button" class="crud-btn-style">Delete</button>
                            </div>
                            <p id="roomMessageDelete"></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="updateRoomModal" tabindex="-1" aria-labelledby="updateRoomModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateRoomModalLabel">Update a Room</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label" for="roomsUpdate">Select an Id:</label>
                                    <select class="form-control" name="roomsUpdate" id="roomIdUpdate">

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="roomNumberUpdate" class="form-label">Room Number:</label>
                                    <input type="number" class="form-control" id="roomNumberUpdate" name="roomNumberUpdate" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="roomTypeUpdate" class="form-label">Room Type:</label>
                                    <select class="form-control" id="roomTypeUpdate" name="roomTypeUpdate" disabled>
                                        <?php foreach (RoomType::cases() as $case): ?>
                                            <option value="<?= $case->value ?>"><?= $case->value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button onclick="updateRoom()" id="btnUpdateRoom" type="button" class="crud-btn-style" disabled>Update</button>
                                <p id="updateConfirmMessage"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="js/cms.js"></script>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>