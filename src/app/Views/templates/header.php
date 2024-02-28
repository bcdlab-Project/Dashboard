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
</head>
<body class="bg-white dark:bg-zinc-800 dark:text-white text-black relative min-h-screen">
    <header class="p-2 px-2 md:px-24 xl:px-40 bg-zinc-100 dark:bg-zinc-900 absolute top-0 w-full items-center flex z-10">
        <a href="/" class="btn btn-ghost gap-0 px-1"><span class="text-3xl text-bcdlab-b">b</span><span class="text-3xl">c</span><span class="text-3xl text-bcdlab-d">d</span><span class="text-3xl">lab</span><span> Project</span></a>
        <div class="flex-1 items-center flex ml-5">
            <ul class="justify-center items-center md:flex space-x-6 hidden">
                <li class=" dark:hover:text-slate-400 hover:text-slate-600"><a class="block" href="/"><?=lang('Pages.home')?></a></li>
                <li class=" dark:hover:text-slate-400 hover:text-slate-600">
                    <a href="javascript:void(0)" class="block" rel="nofollow">Customers</a>
                </li>

                <?php if ($session->get('loggedIn')) { ?>
                    <li class=" dark:hover:text-slate-400 hover:text-slate-600"><a class="block" href="/dashboard"><?=lang('Pages.dashboard')?></a></li>
                <?php } else { ?>
                    <li class=" dark:hover:text-slate-400 hover:text-slate-600"><a class="block" href="/Participate"><?=lang('Pages.participate')?></a></li>
                <?php } ?>
                

            </ul>
            <div class="flex-1 items-center justify-end flex">
                <a class="btn btn-ghost btn-circle" href="/utilities/changelanguage"><img src="<?=base_url()?>images/<?=lang('Utilities.language')?>.png" class="h-6" alt=""></a>
                <button onclick="changeTheme()" class="btn btn-ghost btn-circle" href="/utilities/changetheme"><i id="changeTheme-icon-sun" class="<?=($theme === 'dark') ? '' : 'hidden'?>" data-feather="sun"></i><i id="changeTheme-icon-moon" class="<?=($theme === 'dark') ? 'hidden' : ''?>" data-feather="moon"></i></button>
                <?php if (isset($hasNotification) && esc($hasNotification)) {?>
                    <button class="btn btn-ghost btn-circle" onclick="toggleNotificationmenu()">
                        <div class="indicator">
                            <i data-feather="bell"></i>
                            <span class="badge badge-xs badge-primary indicator-item"></span>
                        </div>
                    </button>
                <?php } ?>
                <button class="btn btn-ghost btn-circle md:hidden" onclick="openSidemenu()"><i data-feather="menu"></i></button>
                <div class="md:block hidden">
                    <?php if ($session->get('loggedIn')) { ?>
                        <div class="dropdown w-full">
                            <div role="button" tabindex="0" class="btn btn-ghost btn-circle"><i data-feather="user"></i></div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow rounded-box bg-zinc-300 dark:bg-zinc-950">
                                <li><a class="text-nowrap" href="/profile"><?=lang('CustomTerms.updateProfile')?></a></li>
                                <li class="dark:bg-white bg-black"></li>
                                <li><button type="button" onclick="logout_modal.showModal()"><?=lang('Auth.logout')?></button></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a class="btn btn-ghost text-base px-1" href="/authentication/login"><?=lang('Auth.login')?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>   
    <section class="px-2 md:px-24 xl:px-40 min-h-screen <?=(esc($pageMargin)) ? 'pb-10 pt-16' : 'flex' ?>">