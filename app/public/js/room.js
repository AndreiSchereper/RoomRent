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
        <button id="addReservation" onclick="addReservation"class="btn btn-primary mt-4 w-100">Reserve Room</button>
    `;
}

async function addReservation() {
    const room = JSON.parse(decodeURIComponent(roomString));
    const numberOfStudents = document.getElementById("nrOfStudents").value;
    const startTime = document.getElementById("startTime").value;
    const endTime = document.getElementById("endTime").value;

    const reservation = {
        roomId: room.roomId,
        startTime,
        endTime,
        numberOfStudents
    };

    const response = await fetch('/api/reservations', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(reservation),
    });

    if (response.ok) {
        window.location.replace('/reservations');
    } else {
        alert('Failed to add reservation');
    }
}