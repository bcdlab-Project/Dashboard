<div class="flex w-full mb-10">
    <div class="relative w-5/6 text-center border border-zinc-200 dark:border-zinc-600">
        <div id="waiting-mask" class="absolute flex items-center justify-center w-full h-full bg-overlay"><span class="animate-bounce"><i class="animate-spin" data-lucide="loader-2" style="width: 50px; height: 50px;"></i></span></div>
        <table class="w-full text-sm text-left border table-auto border-zinc-200 dark:border-zinc-600">
            <thead class="font-medium text-gray-600 border-b dark:text-white dark:bg-zinc-900 dark:bg-opacity-50 bg-zinc-200">
                <tr>
                    <th class="px-2 py-3 sm:px-4">Id</th>
                    <th class="px-2 py-3 sm:px-4">Username</th>
                    <th class="px-2 py-3 sm:px-4">Email</th>
                    <th class="hidden px-4 py-3 sm:table-cell">Role</th>
                    <th class="hidden px-4 py-3 lg:table-cell">GitHub</th>
                    <th class="hidden px-4 py-3 lg:table-cell">Discord</th>
                </tr>
            </thead>
            <tbody id="userTable" class="text-gray-600 divide-y dark:text-zinc-300">
            </tbody>
        </table>
    
    </div>

    <div class="w-1/6 border border-zinc-200 dark:border-zinc-600">
        <div class="p-4 border-b border-zinc-200 dark:border-zinc-600">
            <h1 class="text-2xl font-semibold text-bcdlab-d">Filter</h1>
            <p class="text-lg text-bcdlab-d">Users</p>
        </div>
        <div class="p-4 border-b border-zinc-200 dark:border-zinc-600">
            <form id="searchForm" class="flex flex-col space-y-2">
            <div>
                <label class="font-medium">User ID</label>
                <input class="w-full px-3 py-1 mt-1 border rounded-lg shadow-sm outline-none" type="text" name="search_id" id="search_id" required placeholder="User Id">
            </div>
            <div>
                <label class="font-medium">Username</label>
                <input class="w-full px-3 py-1 mt-1 border rounded-lg shadow-sm outline-none" type="text" name="search_name" id="search_name" required placeholder="User Name">
            </div>
            <div>
                <label class="font-medium">Email</label>
                <input class="w-full px-3 py-1 mt-1 border rounded-lg shadow-sm outline-none" type="email" name="search_email" id="search_email" required placeholder="User Email">
            </div>
            <div>
                <label class="font-medium">Role</label>
                <select class="w-full px-3 py-1 mt-1 border rounded-lg shadow-sm outline-none" name="search_role" id="search_role">
                    <option value="0">Select Role</option>
                    <option value="administrator">Administrator</option>
                    <option value="collaborator">Collaborator</option>
                    <option value="code_reviewer">Code Reviewer</option>
                    <option value="developer">Developer</option>
                </select>
            </div>
            </form>

            <button id="searchButton" class="w-full px-3 py-2 mt-12 text-white rounded-lg bg-bcdlab-d">Search</button>
        </div>
        <div class="p-2 text-center">
            <p class="text-gray-400">Showing 50 Users</p>
        </div>
    </div>
</div>