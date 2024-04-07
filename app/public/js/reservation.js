document.addEventListener('DOMContentLoaded', () => {
    loadReservations();
});

async function loadRoom(roomId) 
{
    let url = `http://localhost/api/rooms?roomId=${roomId}`;

    const response = await fetch(url);
    const room = await response.json();
    return room;
}

async function loadReservations() {
    let url = 'http://localhost/api/reservations';

    const response = await fetch(url);
    const reservations = await response.json();

    // Clear previous rooms
    document.getElementById('reservationsContainer').innerHTML = '';

    reservations.forEach(reservation => {
        displayReservation(reservation);
    });
}

async function displayReservation(reservation) {
    const room = await loadRoom(reservation.roomId);
    const reservationsContainer = document.getElementById('reservationsContainer');

    // Convert reservation endTime to a Date object for comparison
    const reservationEndTime = new Date(reservation.endTime);
    const currentTime = new Date();

    // Skip rendering this reservation if the current time is past the reservation's end time
    if(currentTime > reservationEndTime) {
        return; // Skip rendering this reservation as its end time is in the past
    }

    // Proceed with rendering as the reservation is still upcoming or ongoing
    if(room) {
        reservationsContainer.innerHTML += `
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Room ${room.roomNumber}</h5>
                        <p class="card-text">ID of Reservation: ${reservation.reservationId}</p>
                        <p class="card-text">Number of Students: ${reservation.numberOfStudents}</p>
                        <p class="card-text">Start Time: ${reservation.startTime}</p>
                        <p class="card-text">End Time: ${reservation.endTime}</p>
                    </div>
                </div>
            </div>
        `;
    } else {
        console.error('Room data is undefined');
    }
}


let cancelReservationContainer = document.getElementById('cancelReservationId');

async function cancelReservation(clearExisting = false) 
{
    cancelReservationContainer.innerHTML = '';
    if (clearExisting) {
        cancelReservationContainer.innerHTML = '';
    }
    const response = await fetch('http://localhost/api/reservations');
    const reservations = await response.json();
    console.log(reservations);
    reservations.forEach(reservation => {
        cancelReservationContainer.innerHTML += `<option value="${reservation.reservationId}">${reservation.reservationId}</option>`;
    });
}

document.getElementById('btnCancelReservation').addEventListener('click', async () => {
    const reservationId = cancelReservationContainer.value;
    await deleteRoom(reservationId);
});

async function deleteReservation(reservationId)
{
    const response = await fetch(`http://localhost/api/reservations?reservationId=${reservationId}`, {
            method: 'DELETE',
        });
        const cancelMessage = document.getElementById('cancelMessage');
    if (response.ok) {
        cancelMessage.innerText = 'Reservation deleted successfully!';
        cancelMessage.classList.remove('text-danger');
        cancelMessage.classList.add('text-info');
            await cancelReservation(true);

    } else {
        cancelMessage.innerText = 'An error occurred while deleting the reservation';
        cancelMessage.classList.remove('text-info');
        cancelMessage.classList.add('text-danger');
        }
        cancelReservationContainer.innerHTML = '';
    
}