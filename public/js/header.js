function changeTheme() {
    var sun = document.getElementById('changeTheme-icon-sun')
    var moon = document.getElementById('changeTheme-icon-moon')
    var body = document.getElementsByTagName('html')[0]

    var theme = body.classList.contains('dark') ? 'dark' : 'light'

    var expire = new Date()
    expire.setTime(new Date().getTime() + 3600000*24*365)

    if (theme === 'dark') {
        sun.classList.add('hidden')
        moon.classList.remove('hidden')
        body.classList.remove('dark')
        body.classList.remove('color-scheme-dark')
        body.classList.add('color-scheme-light')
        document.cookie = 'bcdlab_theme=light;path=/;domain=.bcdlab.xyz;samesite=Lax;expires=' + expire.toGMTString()
    } else {
        sun.classList.remove('hidden')
        moon.classList.add('hidden')
        body.classList.add('dark')
        body.classList.add('color-scheme-dark')
        body.classList.remove('color-scheme-light')
        document.cookie = 'bcdlab_theme=dark;path=/;domain=.bcdlab.xyz;samesite=Lax;expires=' + expire.toGMTString()
    }
}

function openSidemenu() {
    document.getElementById('sidemenu').dataset.sidemenuhidden = 'false';
    document.getElementById('sidemenu-overlay').dataset.sidemenuhidden = 'false';
    // document.getElementsByTagName('html')[0].classList.add('scrollbar-hide');
    
    lockScroll();
}
function closeSidemenu() {
    document.getElementById('sidemenu').dataset.sidemenuhidden = 'true';
    document.getElementById('sidemenu-overlay').dataset.sidemenuhidden = 'true';
    // document.getElementsByTagName('html')[0].classList.remove('scrollbar-hide');
    unlockScroll();
}

function logout() {
    fetch('/login/logout', {credentials: "same-origin"}).then(response => {
        if (response.status === 200) {
            window.location.href = 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/logout?post_logout_redirect_uri=https://bcdlab.xyz&client_id=dashboard';
        }
    });
}