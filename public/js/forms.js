
class forms {
    static startWaiting() {
        document.getElementById("waiting-mask").classList.remove('hidden')
        document.getElementById("waiting-mask").classList.add('flex')
    }
    
    static stopWaiting() {
        document.getElementById("waiting-mask").classList.remove('flex')
        document.getElementById("waiting-mask").classList.add('hidden')
    }

    static startMultipleWaiting() {
        for (let i = 0; i < document.getElementsByClassName("waiting-mask").length; i++) {
            document.getElementsByClassName("waiting-mask")[i].classList.remove('hidden')
            document.getElementsByClassName("waiting-mask")[i].classList.add('flex')
        }
    }
    
    static stopMultipleWaiting() {
        for (let i = 0; i < document.getElementsByClassName("waiting-mask").length; i++) {
            document.getElementsByClassName("waiting-mask")[i].classList.remove('flex')
            document.getElementsByClassName("waiting-mask")[i].classList.add('hidden')
        }
    }
    
    static showMessage() {
        document.getElementById("init-form").classList.add('hidden')
        document.getElementById("final-message").classList.remove('hidden')
    }
}

