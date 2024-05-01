class utils {
    static NameRole(role) {
        switch (role) {
            case 'administrator':
                return 'Administrator';
            case 'collaborator':
                return 'Collaborator';
            case 'code_reviewer':
                return 'Code Reviewer';
            case 'developer':
                return 'Developer';
            default:
                return false;
        }
    }

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
}