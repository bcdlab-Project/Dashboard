<?php $actual = explode('/',esc($view))[1]; ?>
<div class="w-full">
    <div role="tablist" aria-orientation="horizontal" class="flex items-center w-full overflow-x-auto text-sm border-b border-zinc-200 gap-x-3 dark:border-zinc-600" style="outline: none;">
        <a href="/forms" data-state="<?=$actual == "overview" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="layout-template"></i>Overview
            </div>
        </a>
        <a href="/forms/participation" data-state="<?=$actual == "participation" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="message-circle-question"></i>Participation Forms
            </div>
        </a>
        <a href="/forms/project" data-state="<?=$actual == "project" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="folder-kanban"></i>Project Forms
            </div>
        </a>
        <a href="/forms/collaboration" data-state="<?=$actual == "collaboration" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="hand-helping"></i>Collaboration Forms
            </div>
        </a>
        <a href="/forms/other" data-state="<?=$actual  == "other" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="clipboard-list"></i>Other Forms
            </div>
        </a>
    </div>
</div>