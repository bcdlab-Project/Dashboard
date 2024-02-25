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
    fetch('/authentication/logout', {credentials: "same-origin"});
    window.location.href = '/';
    //give success message
}