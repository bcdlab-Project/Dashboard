<?php
    $session = \Config\Services::session();
    $negotiate = \Config\Services::negotiator();

    if (!$session->has('theme')) {
        $session->set('theme', 'dark');
    }

    if (!$session->has('language')) {
        $session->set('language', $negotiate->language(['en','pt']));
    }

    $theme = $session->get('theme');
?>
<!DOCTYPE html>
<html lang="en" class="<?=$theme?> color-scheme-<?=$theme?>">
<head>
    <meta charset="UTF-8">
    <title><?=esc($title)?></title>
    <!-- <meta name="description" content="The small framework with powerful features"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>css/styles.css">
    <script src="<?=base_url()?>js/feather.min.js"></script>
</head>
<body class="bg-white dark:bg-zinc-800 dark:text-white text-black relative min-h-screen">
    <header class="p-2 px-8 md:px-24 xl:px-40 bg-zinc-200 dark:bg-zinc-900 flex justify-between items-center absolute top-0 w-full">
        <a href="/"><span class="text-3xl text-bcdlab-b">b</span><span class="text-3xl">c</span><span class="text-3xl text-bcdlab-d">d</span><span class="text-3xl">lab</span><span> Project</span></a>
        <div class="flex ">
            <a class="align-middle me-2" href="/utilities/changelanguage"><img src="<?=base_url()?>images/<?=lang('Utilities.language')?>.png" class="h-6" alt=""></a>
            <a class="align-middle me-2" href="/Participate"><?=lang('CustomTerms.participate')?></a>
            <a class="align-middle me-2" href="/Login"><?=lang('Auth.login')?></a>
            <a class="align-middle me-2" href="/utilities/changetheme"><i data-feather="<?=($theme === 'dark') ? 'sun' : 'moon'?>"></i></a>
        </div>
    </header>   
    <section class="px-8 md:px-24 xl:px-40 min-h-screen <?=(esc($centerContent)) ? 'flex flex-col justify-center' : 'pb-12 pt-16' ?>">
        