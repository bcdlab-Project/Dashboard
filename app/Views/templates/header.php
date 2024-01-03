<?php
    $session = \Config\Services::session();

    if (!$session->has('theme')) {
        $session->set('theme', 'dark');
    }

    $theme = $session->get('theme');
?>


<!DOCTYPE html>
<html lang="en" class="<?=$theme?>">
<head>
    <meta charset="UTF-8">
    <title><?=esc($title)?></title>
    <!-- <meta name="description" content="The small framework with powerful features"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>css/styles.css">
    <script src="<?=base_url()?>js/feather.min.js"></script>
</head>
<body class="bg-white dark:bg-zinc-800 dark:text-white relative min-h-screen pb-10">
    <header class="p-2 px-8 md:px-24 xl:px-40 bg-zinc-200 dark:bg-zinc-900 flex justify-between items-center">
        <a href="/"><span class="text-3xl text-bcdlab-b">b</span><span class="text-3xl">c</span><span class="text-3xl text-bcdlab-d">d</span><span class="text-3xl">lab</span><span> Project</span></a>
        <div class="flex ">
            <a class="align-middle me-2" href="/Participate">Participate</a>
            <a class="align-middle me-2" href="/Login">Login</a>
            <a class="align-middle me-2" href="/Main/changetheme"><i data-feather="<?=($theme === 'dark') ? 'sun' : 'moon'?>"></i></a>
        </div>
    </header>   
    <section class="px-8 md:px-24 xl:px-40">
        