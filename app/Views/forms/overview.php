<div class="flex w-full mb-10">
    <div class="w-1/3 border border-zinc-200 dark:border-zinc-600">
        <div class="p-4 pb-6 text-center border-b border-zinc-200 dark:border-zinc-600">
            <h1 id="countSubmission" class="font-extrabold text-9xl text-bcdlab-d">0</h1>
            <p class="text-lg text-bcdlab-d">New Submissions</p>
        </div>
        <div class="flex justify-center p-4 border-b border-zinc-200 dark:border-zinc-600">
            <p><span id="countApproved">0</span> - Approved</p>
            <p class="px-2">|</p>
            <p><span id="countRejected">0</span> - Rejected</p>
        </div>
        <div class="p-2 text-center">
            <p class="text-gray-400">Counts relative to the actions shown!</p>
            <p class="text-gray-400">Showing last 15 actions</p>
        </div>
    </div>

    <div class="w-2/3 text-center border border-zinc-200 dark:border-zinc-600">
        <table class="w-full text-sm text-left table-auto">
            <thead class="font-medium text-gray-600 border-b dark:text-white dark:bg-zinc-900 dark:bg-opacity-50 bg-zinc-200">
                <tr>
                    <th class="px-2 py-3">Form Id</th>
                    <th class="px-2 py-3">Form Type</th>
                    <th class="px-2 py-3">Action</th>  
                    <th class="flex px-2 py-3">Date/Time <i class="pl-1" data-lucide="chevron-down"></i></th>
                </tr>
            </thead>
            <tbody id="logTable" class="text-gray-600 divide-y dark:text-zinc-300">
            </tbody>
        </table>
    </div>
</div>