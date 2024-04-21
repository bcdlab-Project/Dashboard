loadGithubData();
loadDiscordData();

// Update Page when back from Github or Discord
window.addEventListener('storage', function(event) {
    if (event.key === 'externalGithubPageDone' && event.newValue === 'true') {
        loadGithubData()

        localStorage.removeItem('waitingForUpdate');
        localStorage.removeItem('externalGithubPageDone');
    }
    if (event.key === 'externalDiscordPageDone' && event.newValue === 'true') {
        loadDiscordData()

        localStorage.removeItem('waitingForUpdate');
        localStorage.removeItem('externalDiscordPageDone');
    }
});

function loadGithubData() {
    fetch('/api/users/me/github')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            [...document.querySelectorAll('[data-githubconnected]')].forEach(function (el){
                el.setAttribute('data-githubconnected', Boolean(data['id']))
            });
            document.getElementById('github-username').innerText = data['username'];
        }
    });
}

function loadDiscordData() {
    fetch('/api/users/me/discord')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            [...document.querySelectorAll('[data-discordconnected]')].forEach(function (el){
                el.setAttribute('data-discordconnected', Boolean(data['id']))
            });
            document.getElementById('discord-username').innerText = data['username'];
        }
    });
}

function disconnectGithub() {
    fetch('/api/integration/github/disconnect')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            loadGithubData();
            document.getElementById('disconnect_modal').close();
        }
    });
}

function connectGithub() {
    fetch('/api/integration/github/connect')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            localStorage.setItem('waitingForUpdate', 'true');
            window.open(data['url'], '_blank');
        }
    });
}

function disconnectDiscord() {
    fetch('/api/integration/discord/disconnect')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            loadDiscordData();
            document.getElementById('disconnect_modal').close();
        }
    });
}

function connectDiscord() {
    fetch('/api/integration/discord/connect')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            localStorage.setItem('waitingForUpdate', 'true');
            window.open(data['url'], '_blank');
        }
    });
}

function loadDisconnectModal(type) {
    document.getElementById('disconnect_modal_name').innerHTML = "Disconnect " + type + "?";
    document.getElementById('disconnect_modal_button').setAttribute('onclick', 'disconnect' + type + '()');
    document.getElementById('disconnect_modal').showModal();
}

document.getElementById('updateUsernameForm').addEventListener('submit', function(e) {
    e.preventDefault();        
    forms.startMultipleWaiting();
    fetch('/profile/updateUsername', {
        method: 'POST',
        body: new FormData(document.getElementById("updateUsernameForm"))
    })
    .then(response => response.json())
    .then(data => {
        forms.stopMultipleWaiting();
        if (data.ok) {
            document.getElementById("username-error").innerHTML = " "
            document.getElementById("username").classList.remove('form-error')
            alert('Username Updated Successfully');
        } else {
            document.getElementById("username").classList.add('form-error')
            document.getElementById('username-error').innerText = data.username;
        }
    });
});

document.getElementById('updateEmailForm').addEventListener('submit', function(e) {
    e.preventDefault();        
    forms.startMultipleWaiting();
    fetch('/profile/updateEmail', {
        method: 'POST',
        body: new FormData(document.getElementById("updateEmailForm"))
    })
    .then(response => response.json())
    .then(data => {
        forms.stopMultipleWaiting();
        if (data.ok) {
            document.getElementById("email-error").innerHTML = " "
            document.getElementById("email").classList.remove('form-error')
            alert('Email Updated Successfully');
        } else {
            document.getElementById("email").classList.add('form-error')
            document.getElementById('email-error').innerText = data.username;
        }
    });
});

document.getElementById('updatePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();        
    forms.startMultipleWaiting();
    fetch('/profile/updatePassword', {
        method: 'POST',
        body: new FormData(document.getElementById("updatePasswordForm"))
    })
    .then(response => response.json())
    .then(data => {
        forms.stopMultipleWaiting();

        document.getElementById("password").classList.remove('form-error');
        document.getElementById('password-error').innerText = " ";
        document.getElementById("confpassword").classList.remove('form-error');
        document.getElementById('confpassword-error').innerText = " ";

        if (data.ok) {
            document.getElementById("password").value = "";
            document.getElementById("confpassword").value = "";
            alert('Password Updated Successfully');
        } else {
            if (data.password) {
                document.getElementById("password").classList.add('form-error');
                document.getElementById('password-error').innerText = data.password;
            }
            if (data.confpassword) {
                document.getElementById("confpassword").classList.add('form-error');
                document.getElementById('confpassword-error').innerText = data.confpassword;
            }
        }
    });
});

