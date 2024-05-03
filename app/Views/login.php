<?php
    helper('cookie');

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
    <title>Login</title>
    <meta name="description" content="Community Hosting: A Collaborative Project by Tech Enthusiasts, for Tech Enthusiasts">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow, noarchive, notranslate, noimageindex">
    <meta name="keywords" content="hosting, community, project, developers, tech enthusiasts, collaborative" />
    <meta name="google-site-verification" content="2LEKDXtQ04UFdiegGRymQBRk6PHqbNhDA98WhLdJb9g">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>css/styles.css">
    <script src="<?=base_url()?>/js/keycloak.min.js"></script>
</head>
<body class="relative min-h-screen text-black bg-white dark:bg-zinc-800 dark:text-white">
    <div itemscope itemtype="https://schema.org/WebSite">
        <meta itemprop="url" content="https://bcdlab.xyz/"/>
        <meta itemprop="name" content="bcdLab Project"/>
        <meta itemprop="alternateName" content="bcdLab"/>
    </div>
    <header class="absolute top-0 z-10 flex items-center w-full p-2 px-2 text-white md:px-24 xl:px-40 bg-zinc-900">
        <a href="https://bcdlab.xyz" class="gap-0 px-1 btn btn-ghost"><span class="text-3xl text-bcdlab-b">b</span><span class="text-3xl">c</span><span class="text-3xl text-bcdlab-d">d</span><span class="text-3xl">lab</span><span> Project</span></a>

    </header>   
    <section class="flex min-h-screen px-2 md:px-24 2xl:px-40">
        <div class="self-center w-full p-6 px-8 mx-auto rounded-lg lg:px-6 lg:w-2/5 h-fit bg-zinc-300/50 dark:bg-zinc-950/50">
            <h1 class="mb-4 text-4xl font-light text-center">Logging In</h1>
            <p class="text-xl font-light text-center">Please wait until the page redirects You!</p>
        </div>
    </section> 
    <footer class="absolute bottom-0 w-full p-2 py-4 text-center text-white bg-zinc-900">
        <a href="https://github.com/bcdlab-Project" target="_blank">Copyright &copy; <?= date('Y')?> bcdlab Project</a>
    </footer>
    <script src=/js/auth/login.js></script>
</body>
</html>