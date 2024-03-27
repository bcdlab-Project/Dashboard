var form = document.getElementById("form");

const submitting = async () => {
    if (document.getElementById("second").classList.contains('hidden')) {
        await goNext();
    } else if (await validate('second')) {
        forms.startWaiting();

        var formDT = new FormData(document.getElementById("form"))
        var response = await fetch('/participate', {
            method: 'POST',
            body: formDT
        })

        if (response.status == 200) {
            forms.showMessage();
        } else {
            console.log(response)
        }
    }
}

form.addEventListener('submit', function(event) {
    event.preventDefault();
    event.stopPropagation()
    submitting();
})

document.getElementById("Next").onclick=async() => {
    await goNext();
};

document.getElementById("Back").onclick=async() => {
    await goBack();
};

async function goBack() {
    var first = document.getElementById("first");
    var second = document.getElementById("second");

    first.classList.remove('hidden')
    second.classList.add('hidden')
}

async function goNext() {
    if (await validate('first')) {
        var first = document.getElementById("first");
        var second = document.getElementById("second");

        first.classList.add('hidden')
        second.classList.remove('hidden')
    }
}

async function validate(part) {
    var formDT = new FormData(document.getElementById("form"))
    var response = await fetch('/participate/validate/' + part, {
    method: 'POST',
    body: formDT
    })

    var resp = await response.json()

    var endResu = true;

    for (const field of formDT.entries()) {
        if (field[0] == "honeypot") { break;};
        if (resp[field[0]] !== undefined && resp[field[0]] !== null) {
            endResu = false;
            document.getElementById(field[0] + "-error").innerHTML = resp[field[0]]
            document.getElementById(field[0]).classList.add('form-error')
        } else {
            document.getElementById(field[0] + "-error").innerHTML = " "
            document.getElementById(field[0]).classList.remove('form-error')
        } 
    }

    return endResu;
}