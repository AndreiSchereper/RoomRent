let roomNumberInput = document.getElementById('roomNumberAdd');
let roomTypeInput = document.getElementById('roomTypeAdd');
let roomMessageFeedback = document.getElementById('roomMessageAdd');

async function addRoom() {

    const formData = getRoomFormData();
    
    if (!formData) {
        return;
    }
    const response = await fetch('http://localhost/api/rooms', {
        method: 'POST',
        body: formData,
        
    });
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }

    handleAddRoomResponse(response);
}

function getRoomFormData() 
{
    let formData = new FormData();
    if(validateRoomForm())
    {
        roomMessageFeedback.innerText = '';
        roomMessageFeedback.innerText = 'Please fill in all fields';
        roomMessageFeedback.classList.add('alert-danger');
        return null;
    }
    formData.append('roomNumber', roomNumberInput.value);
    formData.append('roomType', roomTypeInput.value);
    return formData;
}

function validateRoomForm()
{
    if (!roomNumberInput || !roomTypeInput) {
        console.error('One or more form elements are missing.');
        return true; 
    }
    return roomNumberInput.value.trim() === '' || roomTypeInput.value.trim() === '';
}

function clearAllRoomFields()
{
    roomNumberInput.value = '';
    roomTypeInput.value = '';
}

function handleAddRoomResponse(response)
{
    if (response.ok)
    {
        roomMessageFeedback.innerText = 'Room added successfully';
        roomMessageFeedback.classList.remove('text-danger');
        roomMessageFeedback.classList.add('alert-success');
        clearAllRoomFields();
    }
    else
    {
        roomMessageFeedback.innerText = 'An error occurred while adding the room';
        roomMessageFeedback.classList.remove('text-success');
        roomMessageFeedback.classList.add('alert-danger');
    }
}

let roomContainerDelete = document.getElementById('roomIdDelete');
let roomContainerUpdate = document.getElementById('roomIdUpdate');

async function loadAndDisplayRoom(btn, clearExisting = false) {
    roomContainerDelete.innerHTML = '';
    roomContainerUpdate.innerHTML = '';
    if (clearExisting) {
        roomContainerUpdate.innerHTML = '';
        roomContainerDelete.innerHTML = '';
    }
    const response = await fetch('http://localhost/api/rooms');
    const rooms = await response.json();
    rooms.forEach(room => {
        if (btn === true) {
            roomContainerUpdate.innerHTML += `<option value="${room.roomId}">${room.roomId}</option>`;
        } else if (btn === false) {
            roomContainerDelete.innerHTML += `<option value="${room.roomId}">${room.roomId}</option>`;
        }
    });
}

roomContainerUpdate.addEventListener('change', async (room) => {
    // get the target element 
    const selectedOption = room.target.options[room.target.selectedIndex];
    console.log(selectedOption.value);
    await updateDisplay(selectedOption.value);
    const updateButton = document.getElementById('btnUpdateRoom');
    updateButton.dataset.roomId = selectedOption.value;
});

async function updateDisplay(roomId) {
    const response = await fetch(`http://localhost/api/rooms?roomId=${roomId}`);
    const room = await response.json();
    displayRoom(room);
}

function displayRoom(room) {
    document.getElementById('roomNumberUpdate').value = room.roomNumber;
    document.getElementById('roomTypeUpdate').value = room.roomType;
    document.getElementById('roomNumberUpdate').removeAttribute('disabled');
    document.getElementById('roomTypeUpdate').removeAttribute('disabled');
    document.getElementById('btnUpdateRoom').removeAttribute('disabled');
}

async function updateRoom() {
    const formData = getUpdateRoomData();
    if (!formData) {
        return;
    }
    const roomId = document.getElementById('btnUpdateRoom').dataset.roomId;
    const response = await updateUpdatedRoom(roomId, formData);
    handleUpdateResponse(response);
}

function getUpdateRoomData() {
    const roomNumber = document.getElementById('roomNumberUpdate').value;
    const roomType = document.getElementById('roomTypeUpdate').value;

    const formData = new FormData();
    formData.append('roomNumber', roomNumber);
    formData.append('roomType', roomType);

    return formData;
}

async function updateUpdatedRoom(roomId, formData) {
    // Convert FormData to a plain object
    let object = {};
    formData.forEach((value, key) => { object[key] = value; });

    // Fetch call with JSON
    return await fetch(`http://localhost/api/rooms?roomId=${roomId}`, {
        method: 'PUT', // Make sure it's PUT
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(object), // Convert the object to JSON string
    });
}

function handleUpdateResponse(response)
{
    const updateConfirmMessage = document.getElementById('updateConfirmMessage');
    if (response.ok) {
        clearUpdateFormFields();
        updateConfirmMessage.innerText = 'Room is updated successfully';
        updateConfirmMessage.classList.add('text-info');
    } else {
        console.error('Failed to update room');
    }
}

function clearUpdateFormFields() {
    document.getElementById('roomNumberUpdate').value = '';
    document.getElementById('roomTypeUpdate').value = '';
}


    document.getElementById('btnDeleteRoom').addEventListener('click', async () => {
        const roomId = roomContainerDelete.value;
        await deleteRoom(roomId);
    });
    
    async function deleteRoom(roomId) {
        const response = await fetch(`http://localhost/api/rooms?roomId=${roomId}`, {
            method: 'DELETE',
        });
        const roomMessageFeedback = document.getElementById('roomMessageDelete');
        if (response.ok) {
            roomMessageFeedback.innerText = 'Room deleted successfully!';
            roomMessageFeedback.classList.remove('text-danger');
            roomMessageFeedback.classList.add('text-info');

            await loadAndDisplayRoom(false, true);

        } else {
            roomMessageFeedback.innerText = 'An error occurred while deleting the room';
            roomMessageFeedback.classList.remove('text-info');
            roomMessageFeedback.classList.add('text-danger');
        }
        roomContainerDelete.innerHTML = '';
    }