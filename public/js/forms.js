
class forms {
    static startWaiting() {
        document.getElementById("waiting-mask").classList.remove('hidden')
        document.getElementById("waiting-mask").classList.add('flex')
    }
    
    static stopWaiting() {
        document.getElementById("waiting-mask").classList.remove('flex')
        document.getElementById("waiting-mask").classList.add('hidden')
    }
    
    static showMessage() {
        document.getElementById("init-form").classList.add('hidden')
        document.getElementById("final-message").classList.remove('hidden')
    }
}

