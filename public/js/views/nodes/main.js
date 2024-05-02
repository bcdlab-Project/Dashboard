loadNodesData()

function loadNodesData() {
    fetch('/api/nodes/')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            document.getElementById('nodeTable').innerHTML = '';
            
            data['nodes'].forEach(node => {
                let row = document.createElement('tr');
                row.innerHTML = 
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap">' + node.id + '</td>' +
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap">' + node.alias + '</td>' +
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap">' + (node.status ? '<span class="px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:bg-emerald-400/50 dark:text-green-500">Active</span>' : '<span class="px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-full dark:bg-red-500/50 dark:text-rose-500/85" >Inactive</span>') + '</td>' +
                    '<td class="hidden px-4 py-4 sm:table-cell whitespace-nowrap">' + node.owner_name + '</td>' +
                    '<td class="px-2 text-right sm:px-4 whitespace-nowrap"><a href="/nodes/details/' + node.id + '" class="px-1 font-medium duration-150 rounded-lg text-bcdlab-d btn btn-ghost sm:px-4" rel="nofollow">Details</a><button href="javascript:void()" class="px-1 font-medium leading-none text-red-600 duration-150 rounded-lg btn btn-ghost sm:px-4">Delete</button></td>';
                document.getElementById('nodeTable').appendChild(row);
            });
        }
    });
}