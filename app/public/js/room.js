async function displayRoomOnModal(roomString) {
    const room = JSON.parse(decodeURIComponent(roomString));
    const reserveContentId = document.getElementById("reserveContent");
    let maxStudents = 4; // default for a small room

    if (room.roomType === 'Medium') {
        maxStudents = 12;
    } else if (room.roomType === 'Large') {
        maxStudents = 30;
    }

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
        <button id="addReservation" onclick="validateAndAddReservation()"class="btn btn-primary mt-4 w-100">Reserve Room</button>
    `;
}

async function validateAndAddReservation() {
    const nrOfStudents = document.getElementById('nrOfStudents').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;
    const maxStudents = parseInt(document.getElementById('nrOfStudents').max, 10);
    
    // Parse dates and calculate the difference in hours
    const startTimeDate = new Date(startTime);
    const endTimeDate = new Date(endTime);
    const diffHours = (endTimeDate - startTimeDate) / (1000 * 60 * 60);

    // Clear previous error messages
    document.getElementById('errorMessages').innerHTML = '';

    // Check if the number of students exceeds the room capacity
    if (nrOfStudents > maxStudents) {
        displayErrorMessage('The number of students cannot exceed the room capacity.');
        return;
    }

    // Check if the time difference is greater than 3 hours
    if (diffHours > 3) {
        displayErrorMessage('The duration cannot be longer than 3 hours.');
        return;
    }

    // If all checks pass, proceed to add the reservation
    addReservation();
}

function displayErrorMessage(message) {
    const errorMessagesDiv = document.getElementById('errorMessages');
    errorMessagesDiv.innerHTML = ''; // Clears the container
    errorMessagesDiv.innerHTML += `<div class="alert alert-danger">${message}</div>`;
}

