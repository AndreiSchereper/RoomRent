document.addEventListener('DOMContentLoaded', () => {
    loadRooms();

    document.getElementById('roomTypeFilter').addEventListener('change', function() {
        loadRooms(this.value);
    });
});
async function loadRooms(filter = 'All') {
    let url = 'http://localhost/api/rooms';
    if (filter !== 'All') {
        url += `?roomType=${filter}`; 
    }

    const response = await fetch(url);
    const rooms = await response.json();

    // Clear previous rooms
    document.getElementById('roomsContainer').innerHTML = '';

    rooms.forEach(room => {
        displayRoom(room);
    });
}

async function displayRoom(room)
{
    const roomsContainer = document.getElementById('roomsContainer');
    roomsContainer.innerHTML += `
    <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Room ${room.roomNumber}</h5>
                        <p class="card-text">Size: ${room.roomType}</p>
                        ${userId ?
            `<button onclick="displayRoomOnModal('${encodeURIComponent(JSON.stringify(room))}')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal">Reserve</button>` :
            `<button class="btn btn-secondary" disabled>Please log in to reserve</button>`
        }
                    </div>
                </div>
            </div>
    `;
}


async function displayRoomOnModal(roomString) {
    const room = JSON.parse(decodeURIComponent(roomString));
    const reserveContentId = document.getElementById("reserveContent");
    let maxStudents = 4; // default for a small room

    if (room.roomType === 'Medium') {
        maxStudents = 12;
    } else if (room.roomType === 'Large') {
        maxStudents = 30;
    }

    const roomId = room.roomId;
    reserveContentId.innerHTML = `
        <h5><span class="fw-bold">Room Number:</span> ${room.roomNumber}</h5>
        <p><span class="fw-bold">Room Type:</span> ${room.roomType}</p>
        <div class="mb-3">
            <label for="nrOfStudents" class="form-label fw-bold">Enter number of students:</label>
            <input type="number" id="nrOfStudents" class="form-control" min="1" max="${maxStudents}" />
        </div>
        <div class="mb-3">
            <label for="startTime" class="form-label fw-bold">Enter Start Time:</label>
            <input type="datetime-local" id="startTime" class="form-control"/>
        </div>
        <div class="mb-3">
            <label for="endTime" class="form-label fw-bold">Enter End Time:</label>
            <input type="datetime-local" id="endTime" class="form-control"/>
        </div>
        <button id="addReservation" class="btn btn-primary mt-4 w-100">Reserve Room</button>
    `;

    document.getElementById("addReservation").addEventListener("click", function () {
        validateAndAddReservation(roomId); // Now passing both userId and room
    });
}

async function validateAndAddReservation(roomId) {
    const nrOfStudents = document.getElementById('nrOfStudents').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;
    
    // Validate if fields are empty
    if (!nrOfStudents || !startTime || !endTime) {
        displayErrorMessage('All fields are required.');
        return;
    }
    
    const maxStudents = parseInt(document.getElementById('nrOfStudents').max, 10);
    
    const startTimeDate = new Date(startTime);
    const endTimeDate = new Date(endTime);
    const diffMinutes = (endTimeDate - startTimeDate) / (1000 * 60);

    // Clear previous error messages
    document.getElementById('errorMessages').innerHTML = '';

    if (nrOfStudents > maxStudents) {
        displayErrorMessage('The number of students cannot exceed the room capacity.');
        return;
    }

    if (diffMinutes < 15) {
        displayErrorMessage('The duration must be at least 15 minutes.');
        return;
    }

    addReservation(roomId);
}

function displayErrorMessage(message) {
    const errorMessagesDiv = document.getElementById('errorMessages');
    errorMessagesDiv.innerHTML = ''; // Clears the container
    errorMessagesDiv.innerHTML += `<div class="alert alert-danger">${message}</div>`;
}

async function addReservation(roomId) {
    if (!userId) {
        alert('You must be logged in to make a reservation.');
        return;
    }

    const reservationData = {
        userId: userId,
        roomId: roomId,
        startTime: document.getElementById('startTime').value,
        endTime: document.getElementById('endTime').value,
        numberOfStudents: document.getElementById('nrOfStudents').value
    };

    fetch('http://localhost/api/reservations', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(reservationData),
    })
    .then(response => response.json())
    .then(data => {
        if(data.message) {
            window.location.href = '/reservation';
        } 
    })
    .catch((error) => {
        console.error('Error:', error);
        displayErrorMessage('An error occurred while adding the reservation.');
    });
}
