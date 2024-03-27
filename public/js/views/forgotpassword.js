document.getElementById('form').addEventListener('submit', async function(e) {
    e.preventDefault();
    forms.startWaiting();
    let formData = new FormData(this);
    let response = await fetch('/authentication/forgotpassword', {
        method: 'POST',
        body: formData
    });
    let result = await response.json();
    if (result.ok) {
        forms.showMessage();
    } else {
        document.getElementById("email-error").innerHTML = result["email"];
        document.getElementById("email").classList.add('form-error');
        forms.stopWaiting()
    }
});