<?php
    $session = \Config\Services::session();
    $negotiate = \Config\Services::negotiator();
    $request = \Config\Services::request();

    helper('cookie');
    helper('permissions');

    if (!get_cookie('theme')) {
        set_cookie('theme', 'dark',path: '/', httpOnly: false, expire: 3600*24*365, domain: 'bcdlab.xyz');
        $theme = 'dark';
    } else {
        $theme = get_cookie('theme');
    }

?>
<!DOCTYPE html>
<html lang="en" class="<?=$theme?> color-scheme-<?=$theme?> scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title><?=esc($title)?></title>
    <meta name="description" content="Community Hosting: A Collaborative Project by Tech Enthusiasts, for Tech Enthusiasts">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow, noarchive, notranslate, noimageindex">
    <meta name="keywords" content="hosting, community, project, developers, tech enthusiasts, collaborative" />
    <meta name="google-site-verification" content="2LEKDXtQ04UFdiegGRymQBRk6PHqbNhDA98WhLdJb9g">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>css/styles.css">
    <script src="<?=base_url()?>js/header.js"></script>
    <script src="<?=base_url()?>/js/keycloak.min.js"></script>
    <script src="<?=base_url()?>/js/utils.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="relative min-h-screen text-black bg-white dark:bg-zinc-800 dark:text-white">
    <div itemscope itemtype="https://schema.org/WebSite">
        <meta itemprop="url" content="https://bcdlab.xyz/"/>
        <meta itemprop="name" content="bcdLab Project"/>
        <meta itemprop="alternateName" content="bcdLab"/>
    </div>
    <header class="absolute top-0 z-10 flex items-center w-full p-2 px-2 text-white md:px-24 xl:px-40 bg-zinc-900">
        <script src="<?=base_url()?>/js/auth/passive.js"></script>
        <a href="https://bcdlab.xyz" class="gap-0 px-1 btn btn-ghost"><span class="text-3xl text-bcdlab-b">b</span><span class="text-3xl">c</span><span class="text-3xl text-bcdlab-d">d</span><span class="text-3xl">lab</span><span> Project</span></a>
        <div class="flex items-center flex-1 ml-5">
            <ul class="items-center justify-center hidden space-x-6 xl:flex">
                <li class="dark:hover:text-slate-400 hover:text-slate-600"><a class="flex items-center gap-x-2" href="/"><i data-lucide="layout-template"></i>Overview</a></li>
                <li class="dark:hover:text-slate-400 hover:text-slate-600"><a class="flex items-center gap-x-2" href="/projects"><i data-lucide="folder-kanban"></i>Projects</a></li>
                <?php if (admin_Permission() || collaborator_Permission()) { ?><li class="dark:hover:text-slate-400 hover:text-slate-600"><a class="flex items-center gap-x-2" href="/nodes"><i data-lucide="hard-drive"></i>Nodes</a></li><?php } ?>
                <?php if (admin_Permission()) { ?><li class="dark:hover:text-slate-400 hover:text-slate-600"><a class="flex items-center gap-x-2" href="/forms"><i data-lucide="check-circle"></i>Forms Evaluations</a></li><?php } ?>
                <?php if (admin_Permission()) { ?><li class="dark:hover:text-slate-400 hover:text-slate-600"><a class="flex items-center gap-x-2" href="/users"><i data-lucide="users"></i>Users</a></li><?php } ?>
                <li class="dark:hover:text-slate-400 hover:text-slate-600"><a class="flex items-center gap-x-2" href="/request"><i data-lucide="pencil-line"></i>Make a Request</a></li>
                
            </ul>
            <div class="flex items-center justify-end flex-1">
                <button onclick="changeTheme()" class="btn btn-ghost btn-circle" href="/utilities/changetheme"><i id="changeTheme-icon-sun" class="<?=($theme === 'dark') ? '' : 'hidden'?>" data-lucide="sun"></i><i id="changeTheme-icon-moon" class="<?=($theme === 'dark') ? 'hidden' : ''?>" data-lucide="moon"></i></button>
                <button class="btn btn-ghost btn-circle xl:hidden" onclick="openSidemenu()"><i data-lucide="menu"></i></button>
                <div class="hidden xl:block">
                    <div class="w-full dropdown">
                        <div role="button" tabindex="0" class="btn btn-ghost btn-circle"><i data-lucide="circle-user-round"></i></div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow rounded-box bg-zinc-300 dark:bg-zinc-950">
                            <li><a class="text-nowrap" href="/account">Account</a></li>
                            <li class="bg-black dark:bg-white"></li>
                            <li><button class="text-nowrap" type="button" onclick="logout_modal.showModal()">Logout</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>   
    <section class="px-2 md:px-24 2xl:px-40 min-h-screen <?=(esc($pageMargin)) ? 'pb-10 pt-16' : 'flex' ?>">