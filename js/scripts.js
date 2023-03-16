// custom client-side scripts
function confirmDelete() {
    return confirm('Are you sure you want to delete this?');
}

// password comparison
function comparePasswords() {
    let pw1 = document.getElementById('password').value;
    let pw2 = document.getElementById('confirm').value;
    let pwMsg = document.getElementById('pwMsg');

    if (pw1 != pw2) {
        pwMsg.innerText = 'Passwords do not match';
        return false;
    }
    else {
        pwMsg.innerHTML = '';
        return true;
    }
}

// toggle password visibility on register page
function showHide() {
    let pwInput = document.getElementById('password');
    let img = document.getElementById('imgShowHide');

    if (pwInput.type === 'password') {
        pwInput.type = 'text';
        img.src = 'img/hide.png';
    }
    else {
        pwInput.type = 'password';
        img.src = 'img/show.png';
    }
}