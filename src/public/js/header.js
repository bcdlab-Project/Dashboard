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
        document.cookie = 'theme=light;path=/;samesite=Lax;expires=' + expire.toGMTString()
    } else {
        sun.classList.remove('hidden')
        moon.classList.add('hidden')
        body.classList.add('dark')
        body.classList.add('color-scheme-dark')
        body.classList.remove('color-scheme-light')
        document.cookie = 'theme=dark;path=/;samesite=Lax;expires=' + expire.toGMTString()
    }
}