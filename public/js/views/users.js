loadUsersData()

function loadUsersData() {
    utils.startWaiting();
    fetch('/api/users/')
    .then(response => response.json())
    .then(data => {
        if (data['ok']) {
            document.getElementById('userTable').innerHTML = '';
            
            data['users'].forEach(user => {
                let row = document.createElement('tr');
                row.id = user.id;
                row.innerHTML = 
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap">' + user.id +'</td>' +
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap" id="'+user.id+'-username"><i class="animate-spin" data-lucide="loader-2"></i></td>' + // ' + user.username + '
                    '<td class="px-2 py-4 sm:px-4 whitespace-nowrap" id="'+user.id+'-email"><i class="animate-spin" data-lucide="loader-2"></i></td>' + // ' + user.email + '
                    '<td class="hidden px-4 py-4 sm:table-cell whitespace-nowrap" id="'+user.id+'-role"><i class="animate-spin" data-lucide="loader-2"></i></td>' + // ' + NameRole(user.roles[0]) + '
                    '<td class="hidden px-4 py-4 whitespace-nowrap lg:table-cell" id="'+user.id+'-github"><i class="animate-spin" data-lucide="loader-2"></i></td>' + // ' + (user.has_github ? '<span class="px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:bg-emerald-400/50 dark:text-green-500">Connected</span>' : '<span class="px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-full dark:bg-red-500/50 dark:text-rose-500/85" >Disconnected</span>') + '
                    '<td class="hidden px-4 py-4 whitespace-nowrap lg:table-cell" id="'+user.id+'-discord"><i class="animate-spin" data-lucide="loader-2"></i></td>' + // ' + (user.has_discord ? '<span class="px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:bg-emerald-400/50 dark:text-green-500">Connected</span>' : '<span class="px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-full dark:bg-red-500/50 dark:text-rose-500/85">Disconnected</span>') + '
                    '<td class="px-2 text-right sm:px-4 whitespace-nowrap"><a href="/users/details/' + user.id + '" class="px-1 font-medium duration-150 rounded-lg text-bcdlab-d btn btn-ghost sm:px-4" rel="nofollow">Details</a><button href="javascript:void()" class="px-1 font-medium leading-none text-red-600 duration-150 rounded-lg btn btn-ghost sm:px-4">Delete</button></td>';
                document.getElementById('userTable').appendChild(row);
                lucide.createIcons();
            });
            utils.stopWaiting();

            data['users'].forEach(user => {
                fetch('/api/users/' + user.id)
                .then(response => response.json())
                .then(data => {
                    if (data['ok']) {
                        document.getElementById(user.id + '-username').innerHTML = data.username;
                        document.getElementById(user.id + '-email').innerHTML = data.email;
                        document.getElementById(user.id + '-role').innerHTML = utils.NameRole(data.roles[0]);
                        document.getElementById(user.id + '-github').innerHTML = data.has_github ? '<span class="px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:bg-emerald-400/50 dark:text-green-500">Connected</span>' : '<span class="px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-full dark:bg-red-500/50 dark:text-rose-500/85" >Disconnected</span>';
                        document.getElementById(user.id + '-discord').innerHTML = data.has_discord ? '<span class="px-3 py-2 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:bg-emerald-400/50 dark:text-green-500">Connected</span>' : '<span class="px-3 py-2 text-xs font-semibold text-red-600 bg-red-100 rounded-full dark:bg-red-500/50 dark:text-rose-500/85">Disconnected</span>';
                    }
                });
            });
            
        }
    });
    
}