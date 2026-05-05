window.onload = function () {
    loadUsers();
};

function ajaxRequest(method, url, body, callback) {
    let xhttp = new XMLHttpRequest();
    xhttp.open(method, url, true);

    if (method === 'POST') {
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    }

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            let result = JSON.parse(this.responseText);
            callback(result);
        }
    };

    xhttp.send(body);
}

function loadUsers() {
    ajaxRequest('GET', '../controller/userController.php?action=list', null, function (result) {
        if (result.success !== true) {
            showMessage(result.message);
            return;
        }

        let tableBody = document.getElementById('userTableBody');
        tableBody.innerHTML = '';

        for (let i = 0; i < result.users.length; i++) {
            let user = result.users[i];

            tableBody.innerHTML += `
                <tr>
                    <td>${user.id}</td>
                    <td>${escapeHtml(user.username)}</td>
                    <td>${escapeHtml(user.email)}</td>
                    <td>
                        <button onclick="showDetails(${user.id})">Details</button>
                        <button onclick="showEditForm(${user.id})">Edit</button>
                        <button class="danger" onclick="deleteUser(${user.id})">Delete</button>
                    </td>
                </tr>
            `;
        }
    });
}

function showDetails(id) {
    ajaxRequest('GET', '../controller/userController.php?action=get&id=' + id, null, function (result) {
        if (result.success !== true) {
            showMessage(result.message);
            return;
        }

        let user = result.user;
        let detailsBox = document.getElementById('detailsBox');

        detailsBox.classList.remove('hidden');
        detailsBox.innerHTML = `
            <h2>User Details</h2>
            <p><b>ID:</b> ${user.id}</p>
            <p><b>Username:</b> ${escapeHtml(user.username)}</p>
            <p><b>Email:</b> ${escapeHtml(user.email)}</p>
            <button onclick="hideDetailsBox()">Close</button>
        `;
    });
}

function showEditForm(id) {
    ajaxRequest('GET', '../controller/userController.php?action=get&id=' + id, null, function (result) {
        if (result.success !== true) {
            showMessage(result.message);
            return;
        }

        let user = result.user;

        document.getElementById('editId').value = user.id;
        document.getElementById('editUsername').value = user.username;
        document.getElementById('editEmail').value = user.email;

        document.getElementById('editBox').classList.remove('hidden');
    });
}

function hideEditBox() {
    document.getElementById('editBox').classList.add('hidden');
}

function hideDetailsBox() {
    document.getElementById('detailsBox').classList.add('hidden');
}

document.getElementById('editForm').addEventListener('submit', function (event) {
    event.preventDefault();

    let user = {
        id: document.getElementById('editId').value,
        username: document.getElementById('editUsername').value,
        email: document.getElementById('editEmail').value
    };

    let data = JSON.stringify(user);

    ajaxRequest('POST', '../controller/userController.php?action=update', 'user=' + encodeURIComponent(data), function (result) {
        showMessage(result.message);

        if (result.success === true) {
            hideEditBox();
            loadUsers();
        }
    });
});

function deleteUser(id) {
    let confirmDelete = confirm('Are you sure you want to delete this user?');

    if (!confirmDelete) {
        return;
    }

    ajaxRequest('POST', '../controller/userController.php?action=delete', 'id=' + encodeURIComponent(id), function (result) {
        showMessage(result.message);

        if (result.success === true) {
            loadUsers();
            hideDetailsBox();
            hideEditBox();
        }
    });
}

function showMessage(message) {
    document.getElementById('msg').innerHTML = message;
}

function escapeHtml(value) {
    return String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}
