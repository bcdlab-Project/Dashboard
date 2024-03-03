loadGithubData()
loadDiscordData()

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
    fetch('/api/users/' + dataPass["userId"] + '/github')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            [...document.querySelectorAll('[data-githubconnected]')].forEach(function (el){
                el.setAttribute('data-githubconnected', Boolean(data['id']))
            });
            document.getElementById('github-username').innerText = data['username'];
            document.getElementById('github-last-login').innerText = data['last_loggedin'] == null ? 'Never' : data['last_loggedin'];
            document.getElementById('github-connected-at').innerText = data['created_at'];
        }
    });
}

function loadDiscordData() {
    fetch('/api/users/' + dataPass["userId"] + '/discord')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            [...document.querySelectorAll('[data-discordconnected]')].forEach(function (el){
                el.setAttribute('data-discordconnected', Boolean(data['id']))
            });
            document.getElementById('discord-username').innerText = data['username'];
            document.getElementById('discord-connected-at').innerText = data['created_at'];
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
    document.getElementById('disconnect_modal_name').innerHTML = dataPass["disconnect"] + " " + type + "?";
    document.getElementById('disconnect_modal_button').setAttribute('onclick', 'disconnect' + type + '()');
    document.getElementById('disconnect_modal').showModal();
}