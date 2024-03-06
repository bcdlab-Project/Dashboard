<?php
    $session = \Config\Services::session();
    $negotiate = \Config\Services::negotiator();
    $request = \Config\Services::request();

    helper('cookie');
    helper('alternativeLogin');

    if (!get_cookie('theme')) {
        set_cookie('theme', 'dark',path: '/', httpOnly: false, expire: 3600*24*365);
        $theme = 'dark';
    } else {
        $theme = get_cookie('theme');
    }

    if (!$session->has('language')) {
        $session->set('language', $negotiate->language(['en','pt']));
    }

    if (get_cookie('loggedIn') && !$session->get('loggedIn')) {
        if (get_cookie('loggedIn') == 'session') {
            delete_cookie('loggedIn');
        }
        $userModel = model('UserModel');
        $agent = $request->getUserAgent();
        $user = $userModel->getByCookie($agent->getAgentString());
        if ($user) { 
            $user->login();
        }
    }
?>
<!DOCTYPE html>
<html lang="<?=lang('Utilities.language')?>" class="<?=$theme?> color-scheme-<?=$theme?>">
<head>
    <meta charset="UTF-8">
    <title><?=esc($title)?></title>
    <!-- <meta name="description" content="The small framework with powerful features"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>css/styles.css">
    <script src="<?=base_url()?>js/feather.min.js"></script>
    <script src="<?=base_url()?>js/header.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="relative min-h-screen text-black bg-white dark:bg-zinc-800 dark:text-white">
    <header class="absolute top-0 z-10 flex items-center w-full p-2 px-2 text-white md:px-24 xl:px-40 bg-zinc-900">
        <a href="/" class="gap-0 px-1 btn btn-ghost"><span class="text-3xl text-bcdlab-b">b</span><span class="text-3xl">c</span><span class="text-3xl text-bcdlab-d">d</span><span class="text-3xl">lab</span><span> Project</span></a>
        <div class="flex items-center flex-1 ml-5">
            <ul class="items-center justify-center hidden space-x-6 md:flex">
                <li class=" dark:hover:text-slate-400 hover:text-slate-600"><a class="block" href="/"><?=lang('Pages.home')?></a></li>
                <!-- <li class=" dark:hover:text-slate-400 hover:text-slate-600"><a href="javascript:void(0)" class="block" rel="nofollow">Customers</a></li> -->
                <?php if ($session->get('loggedIn')) { ?>
                    <li class=" dark:hover:text-slate-400 hover:text-slate-600"><a class="block" href="/dashboard"><?=lang('Pages.dashboard')?></a></li>
                <?php } else { ?>
                    <li class=" dark:hover:text-slate-400 hover:text-slate-600"><a class="block" href="/Participate"><?=lang('Pages.participate')?></a></li>
                <?php } ?>
                

            </ul>
            <div class="flex items-center justify-end flex-1">
                <a class="btn btn-ghost btn-circle" href="/utilities/changelanguage"><img src="<?=base_url()?>images/<?=lang('Utilities.language')?>.png" class="h-6" alt=""></a>
                <button onclick="changeTheme()" class="btn btn-ghost btn-circle" href="/utilities/changetheme"><i id="changeTheme-icon-sun" class="<?=($theme === 'dark') ? '' : 'hidden'?>" data-lucide="sun"></i><i id="changeTheme-icon-moon" class="<?=($theme === 'dark') ? 'hidden' : ''?>" data-lucide="moon"></i></button>
                <?php if (isset($hasNotification) && esc($hasNotification)) {?>
                    <button class="btn btn-ghost btn-circle" onclick="toggleNotificationmenu()">
                        <div class="relative">
                            <i data-lucide="bell"></i>
                            <span class="absolute w-4 h-4 border-2 rounded-full border-zinc-900 bg-bcdlab-d -right-1 -top-2 dark:border-gray-800"></span>
                        </div>
                    </button>
                <?php } ?>
                <button class="btn btn-ghost btn-circle md:hidden" onclick="openSidemenu()"><i data-lucide="menu"></i></button>
                <div class="hidden md:block">
                    <?php if ($session->get('loggedIn')) { ?>
                        <div class="w-full dropdown">
                            <div role="button" tabindex="0" class="btn btn-ghost btn-circle"><i data-lucide="circle-user-round"></i></div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow rounded-box bg-zinc-300 dark:bg-zinc-950">
                                <li><a class="text-nowrap" href="/profile"><?=lang('CustomTerms.updateProfile')?></a></li>
                                <li class="bg-black dark:bg-white"></li>
                                <li><button class="text-nowrap" type="button" onclick="logout_modal.showModal()"><?=lang('Auth.logout')?></button></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a class="px-1 text-base btn btn-ghost" href="/authentication/login"><?=lang('Auth.login')?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>   
    <section class="px-2 md:px-24 2xl:px-40 min-h-screen <?=(esc($pageMargin)) ? 'pb-10 pt-16' : 'flex' ?>">