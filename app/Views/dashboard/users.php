<table class="w-full text-sm text-left table-auto">
    <thead class="font-medium text-gray-600 border-b dark:text-white dark:bg-zinc-900 dark:bg-opacity-50 bg-zinc-200">
        <tr>
            <th class="px-2 py-3 sm:px-4">Id</th>
            <th class="px-2 py-3 sm:px-4">Username</th>
            <th class="px-2 py-3 sm:px-4">Email</th>
            <th class="hidden px-4 py-3 sm:table-cell">Role</th>
            <th class="hidden px-4 py-3 lg:table-cell">GitHub</th>
            <th class="hidden px-4 py-3 lg:table-cell">Discord</th>
            <th class="px-2 py-3 sm:px-4"></th>
        </tr>
    </thead>
    <tbody id="userTable" class="text-gray-600 divide-y dark:text-zinc-300">
    </tbody>
</table>

<script>
loadUsersData()

function loadUsersData() {
    fetch('/api/users/')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            document.getElementById('userTable').innerHTML = '';
            
            data['users'].forEach(user => {
                console.log(user)
                let row = document.createElement('tr');
                row.innerHTML = 
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap">' + user.id +'</td>' +
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap">' + user.username + '</td>' +
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap">' + user.email + '</td>' +
                    '<td class="hidden px-4 py-4 sm:table-cell whitespace-nowrap">' + user.role['name'] + '</td>' +
                    '<td class="hidden px-4 py-4 whitespace-nowrap lg:table-cell">' + (user.has_github ? '<span class="px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:bg-emerald-400/50 dark:text-green-500">Connected</span>' : '<span class="px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-full dark:bg-red-500/50 dark:text-rose-500/85" >Disconnected</span>') + '</td>' +
                    '<td class="hidden px-4 py-4 whitespace-nowrap lg:table-cell">' + (user.has_discord ? '<span class="px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:bg-emerald-400/50 dark:text-green-500">Connected</span>' : '<span class="px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-full dark:bg-red-500/50 dark:text-rose-500/85">Disconnected</span>') + '</td>' +
                    '<td class="px-2 text-right sm:px-4 whitespace-nowrap"><a href="javascript:void()" class="px-1 font-medium duration-150 rounded-lg text-bcdlab-d btn btn-ghost sm:px-4" rel="nofollow">Details</a><button href="javascript:void()" class="px-1 font-medium leading-none text-red-600 duration-150 rounded-lg btn btn-ghost sm:px-4">Delete</button></td>';
                document.getElementById('userTable').appendChild(row);
            });
        }
    });
}
</script>