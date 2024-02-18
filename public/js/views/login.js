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