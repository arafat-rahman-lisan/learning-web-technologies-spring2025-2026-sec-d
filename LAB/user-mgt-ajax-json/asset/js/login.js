document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    let user = {
        username: document.getElementById('username').value,
        password: document.getElementById('password').value
    };

    let data = JSON.stringify(user);

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/loginCheck.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            let result = JSON.parse(this.responseText);

            document.getElementById('msg').innerHTML = result.message;

            if (result.success === true) {
                window.location.href = result.redirect;
            }
        }
    };

    xhttp.send('user=' + encodeURIComponent(data));
});
