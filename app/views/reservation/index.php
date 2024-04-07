<?php
    include __DIR__ . '/../header.php';
?>
<script src="js/reservation.js"></script>
<main class="flex-shrink-0">
    <div class="container mt-5">
        <h2 class="mb-4">Your Reservations</h2>
        <div id="reservationsContainer" class="row row-cols-1 row-cols-md-3 g-4">

        </div>
    </div>

    <div class="modal fade" id="cancelReservationModal" tabindex="-1" aria-labelledby="cancelReservationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelReservationModalLabel">Cancel Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="cancelReservation">Select an Id:</label>
                                <select class="form-control" name="cancelReservationId" id="cancelReservationId">

                                </select>
                            </div>
                            <div>
                                <button id="btnCancelReservation" type="button" class="crud-btn-style">Cancel</button>
                            </div>
                            <p id="cancelMessage"></p>
                        </div>

                    </div>
                </div>
            </div>
</main>
<?php
    include __DIR__ . '/../footer.php';
?>
