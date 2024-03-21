<?php
helper('permissions');
?>

<div class="w-full">
    <div role="tablist" aria-orientation="horizontal" class="flex items-center w-full overflow-x-auto text-sm border-b border-zinc-200 gap-x-3 dark:border-zinc-600" style="outline: none;">
        <a href="/dashboard" data-state="<?=esc($view) == "dashboard" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="layout-template"></i>Overview
            </div>
        </a>
        <a href="/dashboard/projects" data-state="<?=esc($view) == "projects" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="folder-kanban"></i>Projects
            </div>
        </a>
        <a href="/dashboard/nodes" data-state="<?=esc($view) == "nodes" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="hard-drive"></i>Nodes
            </div>
        </a>
        <a href="/dashboard/form_approvals" data-state="<?=esc($view) == "form_approvals" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="check-circle"></i>Form Approvals
            </div>
        </a>
        <?php if (admin_Permission()) { ?>
        <a href="/dashboard/users" data-state="<?=esc($view) == "users" ? 'active' : 'inactive' ?>" class="group outline-none py-1.5 border-b-2 border-white dark:border-zinc-800 text-gray-500 data-[state=active]:!border-bcdlab-d data-[state=active]:text-bcdlab-d">
            <div class="flex items-center gap-x-2 py-1.5 px-3 rounded-lg duration-150 group-hover:text-bcdlab-d group-hover:bg-gray-50 dark:group-hover:bg-zinc-900 font-medium">
                <i data-lucide="users"></i>Users
            </div>
        </a>
        <?php } ?>
    </div>
</div>