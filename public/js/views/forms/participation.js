loadData()
    
function loadData(status = false) {
    utils.startWaiting();
    var url = '/api/forms/participation';

    if (status) {
        url += '?status=' + status;
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (!data.ok) {
                alert('Error loading data! Try again later.');
                console.error(data);
                return;
            }
            let table = document.getElementById('formTable');
            table.innerHTML = '';
            data.forms.forEach(form => {
                if (form.email_verified) {
                    let row = document.createElement('tr');
                    row.id = form.id;
                    row.classList.add('cursor-pointer', 'hover:bg-gray-50', 'dark:hover:bg-zinc-900');
                    row.addEventListener('click', () => {
                        window.location.href = '/forms/participation/' + form.id;
                    });
                    row.innerHTML = `
                        <td class="px-2 py-3">${form.id}</td>
                        <td class="px-2 py-3">${form.username}</td>
                        <td class="px-2 py-3">${form.email}</td>
                        <td class="px-2 py-3">${form.status.charAt(0).toUpperCase() + form.status.slice(1)}</td>
                        <td class="px-2 py-3">${form.created_at}</td>
                    `;
                    table.appendChild(row);
                }
            });
            utils.stopWaiting();
        });
}

function clearSelection() {
    document.getElementById('show-all').dataset.state = 'inactive';
    document.getElementById('show-pending').dataset.state = 'inactive';
    document.getElementById('show-approved').dataset.state = 'inactive';
    document.getElementById('show-rejected').dataset.state = 'inactive';
}

document.getElementById('show-all').addEventListener('click', () => {
    clearSelection();
    document.getElementById('show-all').dataset.state = 'active';
    loadData();
});

document.getElementById('show-pending').addEventListener('click', () => {
    clearSelection();
    document.getElementById('show-pending').dataset.state = 'active';
    loadData('pending')
});

document.getElementById('show-approved').addEventListener('click', () => {
    clearSelection();
    document.getElementById('show-approved').dataset.state = 'active';
    loadData('approved')
});

document.getElementById('show-rejected').addEventListener('click', () => {
    clearSelection();
    document.getElementById('show-rejected').dataset.state = 'active';
    loadData('rejected')
});