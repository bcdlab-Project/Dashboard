loadTableData();
    
function loadTableData() {
    fetch('/api/forms/log')
        .then(response => response.json())
        .then(data => {
            let table = document.getElementById('logTable');
            table.innerHTML = '';

            countSubmissions = 0;
            countApproved = 0;
            countRejected = 0;

            data.log.slice(0,15).forEach(row => {
                if (row.action == 'submitted') { countSubmissions++; }
                if (row.action == 'approved') { countApproved++; }
                if (row.action == 'rejected') { countRejected++; }

                let tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="px-2 py-4"><a href="/forms/${row.type}/${row.id}" class="underline">${row.id}</a></td>
                    <td class="px-2 py-4">${row.type.charAt(0).toUpperCase() + row.type.slice(1)}</td>
                    <td class="px-2 py-4">${row.action.charAt(0).toUpperCase() + row.action.slice(1)}</td>
                    <td class="px-2 py-4">${row.datetime}</td>
                `;
                table.appendChild(tr);
            });

            document.getElementById('countSubmission').innerText = countSubmissions;
            document.getElementById('countApproved').innerText = countApproved;
            document.getElementById('countRejected').innerText = countRejected;
        });
}