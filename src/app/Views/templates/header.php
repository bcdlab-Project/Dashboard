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
        $agent = $request->getUserAgent();
        $userModel = model('UserModel');
        $user = $userModel->getByCookie($agent->getAgentString());
        if ($user) { 
            $user->login();
        }
    }
?>
<!DOCTYPE html>
<html lang="en" class="<?=$theme?> color-scheme-<?=$theme?>">
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
    <header class="p-2 px-2 md:px-24 xl:px-40 bg-zinc-200 dark:bg-zinc-900 absolute top-0 w-full">
        <a href="/" class="btn btn-ghost gap-0 px-0 "><span class="text-3xl text-bcdlab-b">b</span><span class="text-3xl">c</span><span class="text-3xl text-bcdlab-d">d</span><span class="text-3xl">lab</span><span> Project</span></a>
        <div class="float-right flex">
            <a class="btn btn-ghost btn-circle" href="/utilities/changelanguage"><img src="<?=base_url()?>images/<?=lang('Utilities.language')?>.png" class="h-6" alt=""></a>
            <button onclick="changeTheme()" class="btn btn-ghost btn-circle" href="/utilities/changetheme"><i id="changeTheme-icon-sun" class="<?=($theme === 'dark') ? '' : 'hidden'?>" data-feather="sun"></i><i id="changeTheme-icon-moon" class="<?=($theme === 'dark') ? 'hidden' : ''?>" data-feather="moon"></i></button>
            <button class="btn btn-ghost btn-circle" onclick="openSidemenu()">
                <div class="indicator">
                    <i data-feather="menu"></i>
                    <?php if ($session->get('loggedIn')) { ?>
                        <span class="badge badge-xs badge-primary indicator-item"></span>
                    <?php } ?>
                </div>
            </button>
        </div>
    </header>   
    <section class="px-2 md:px-24 xl:px-40 min-h-screen <?=(esc($centerContent)) ? 'flex flex-col justify-center' : 'pb-12 pt-16' ?>">