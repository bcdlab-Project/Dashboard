var form = document.getElementById("form");

const submitting = async () => {
    let formData = new FormData(form);
    let response = await fetch('/login', {
        method: 'POST',
        body: formData
    });
    if (response.status === 200) {
        window.location.href = '/';
    } else {
        document.getElementById('error').classList.remove('hidden');
    }
}

form.addEventListener('submit', function(event) {
    event.preventDefault();
    event.stopPropagation()
    submitting();
})

window.addEventListener('storage', function(event) {
    if (event.key === 'externalGithubPageDone' && event.newValue === 'true') {
        if (localStorage.getItem('loginSuccess') === '1') {
            console.log('login success');
            window.location.href = '/dashboard';
        } else {
            console.log('login failed');
            window.location.href = '/';
        }

        localStorage.removeItem('loginSuccess');
        localStorage.removeItem('waitingForUpdate');
        localStorage.removeItem('externalGithubPageDone');
    }
});


function loginGithub() {
    fetch('/api/integration/github/login')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            localStorage.setItem('waitingForUpdate', 'true');
            window.open(data['url'], '_blank');
        }
    });
}