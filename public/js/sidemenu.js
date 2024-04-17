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
    fetch('/logout/auto', {credentials: "same-origin"}).then(response => {
        if (response.status === 200) {
            window.location.href = 'https://auth.bcdlab.xyz/realms/bcdlab/protocol/openid-connect/logout';
        }
    })

}