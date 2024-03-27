document.getElementById('form').addEventListener('submit', async function(e) {
    e.preventDefault();
    forms.startWaiting();
    let formData = new FormData(this);
    let response = await fetch('/authentication/recoverpassword', {
        method: 'POST',
        body: formData
    });
    let result = await response.json();
    document.getElementById('message').setAttribute('data-ok', result.ok);
    if (result.ok) {
        document.getElementById('message').innerHTML = "Your Password has been recoverd with success!";
        forms.showMessage();
    } else if (result.hasErrors) {
        forms.stopWaiting()
        for (const field of formData.entries()) {
            if (field[0] == "honeypot") { break;};
            if (result[field[0]] !== undefined && result[field[0]] !== null) {
                document.getElementById(field[0] + "-error").innerHTML = result[field[0]];
                document.getElementById(field[0]).classList.add('form-error');
            } else {
                document.getElementById(field[0] + "-error").innerHTML = " ";
                document.getElementById(field[0]).classList.remove('form-error');
            } 
        }
    } else {
        forms.showMessage()
        document.getElementById('message').innerHTML = "Something Went Wrong! Your Password recovery could have expired! Please try again!";
    }
});