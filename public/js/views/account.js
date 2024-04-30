loadGithubData();
loadDiscordData();

// ------------------------ Update Page ------------------------ //
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

// ------------------------ Load Connections Data ------------------------ //

// ------------ Load GitHub Data ------------ //
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

// ------------ Load Discord Data ------------ //
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

// ------------------------ Connect Connections ------------------------ //

// ------------ Connect GitHub ------------ //
document.getElementById('connectGithub').addEventListener('click', function() {
    fetch('/api/integration/github/connect')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            localStorage.setItem('waitingForUpdate', 'true');
            window.open(data['url'], '_blank');
        }
    });
});

// ------------ Connect Discord ------------ //
document.getElementById('connectDiscord').addEventListener('click', function() {
    fetch('/api/integration/discord/connect')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            localStorage.setItem('waitingForUpdate', 'true');
            window.open(data['url'], '_blank');
        }
    });
});

// ------------------------ Disconnect Connections ------------------------ //

// ------------ Init Disconnect Modal ------------ //
function loadDisconnectModal(type) {
    document.getElementById('disconnect_modal_name').innerHTML = "Disconnect " + type + "?";
    localStorage.setItem('disconnectType', type);
    document.getElementById('disconnect_modal').showModal();
}

// ------------ Disconnect GitHub ------------ //
document.getElementById('disconnectGithub').addEventListener('click', function() { loadDisconnectModal('Github') });

// ------------ Disconnect Discord ------------ //
document.getElementById('disconnectDiscord').addEventListener('click', function() { loadDisconnectModal('Discord') });

// ------------ Disconnect Modal ------------ //
document.getElementById('disconnect_modal_button').addEventListener('click', function() {
    var type = localStorage.getItem('disconnectType');
    localStorage.removeItem('disconnectType');

    fetch('/api/integration/'+type+'/disconnect')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            switch (type) {
                case 'Github':
                    loadGithubData();
                    break;
                case 'Discord':
                    loadDiscordData();
                    break;
            }
            document.getElementById('disconnect_modal').close();
        }
    });
});

// ------------------------ Update Account ------------------------ //

// ------------ Update Username ------------ //
document.getElementById('updateEmailForm').addEventListener('submit', function(e) {
    e.preventDefault();        
    forms.startMultipleWaiting();
    fetch('/api/users/me/email', {
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
            document.getElementById('email-error').innerText = data.messages.error;
        }
    });
});

// ------------ Update Password ------------ //
document.getElementById('updatePassword').addEventListener('click', function() {
    fetch('/api/users/me/password', { method: 'POST' })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            alert('An Email has been sent to You to change Your Password.');
        } else {
            alert('An Error has occurred, please try again later.');
        }
    });
});