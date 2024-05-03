<div class="flex w-full mb-10">
    <div class="relative w-5/6 text-center border border-zinc-200 dark:border-zinc-600">
        <div id="waiting-mask" class="absolute flex items-center justify-center w-full h-full bg-overlay"><span class="animate-bounce"><i class="animate-spin" data-lucide="loader-2" style="width: 50px; height: 50px;"></i></span></div>
        <table class="w-full text-sm text-left table-auto">
            <thead class="font-medium text-gray-600 border-b dark:text-white dark:bg-zinc-900 dark:bg-opacity-50 bg-zinc-200">
                <tr>
                    <th class="px-2 py-3">Form Id</th>
                    <th class="px-2 py-3">Username</th>
                    <th class="px-2 py-3">Email</th>
                    <th class="px-2 py-3">Status</th>
                    <th class="flex px-2 py-3">Date/Time <i class="pl-1" data-lucide="chevron-down"></i></th>
                </tr>
            </thead>
            <tbody id="formTable" class="text-gray-600 divide-y dark:text-zinc-300">
            </tbody>
        </table>
    </div>

    <div class="w-1/6 border border-zinc-200 dark:border-zinc-600">
        <div class="p-4 border-b border-zinc-200 dark:border-zinc-600">
            <h1 class="text-2xl font-semibold text-bcdlab-d">Filter</h1>
            <p class="text-lg text-bcdlab-d">Submissions</p>
        </div>
        <div class="py-4 border-b border-zinc-200 dark:border-zinc-600">
            <div role="tablist" aria-orientation="vertical" class="flex flex-col w-full text-sm items-left gap-y-2" style="outline: none;">
                <button id="show-all" data-state="active" class="group outline-none px-1.5 border-l-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
                    <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                        <i data-lucide="layout-template"></i>Show All
                    </div>
                </button>
                <button id="show-pending" data-state="inactive" class="group outline-none px-1.5 border-l-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
                    <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                        <i data-lucide="circle-help"></i>Pending Evaluation
                    </div>
                </button>
                <button id="show-approved" data-state="inactive" class="group outline-none px-1.5 border-l-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
                    <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                        <i data-lucide="circle-check"></i>Approved
                    </div>
                </button>
                <button id="show-rejected" data-state="inactive" class="group outline-none px-1.5 border-l-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
                    <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                        <i data-lucide="circle-x"></i>Rejected
                    </div>
                </button>
            </div>
        </div>
        <!-- <div class="p-4 border-b border-zinc-200 dark:border-zinc-600">
            <div>
                <label class="font-medium">Form ID</label>
                <input class="w-full px-3 py-1 mt-1 border rounded-lg shadow-sm outline-none" type="text" name="search_id" id="search_id" required placeholder="Form Id">
            </div>
        </div> -->
        <div class="p-2 text-center">
            <p class="text-gray-400">Only submissions with verified email shown!</p>
            <p class="text-gray-400">Showing last 50 submissions</p>
        </div>
    </div>
</div>