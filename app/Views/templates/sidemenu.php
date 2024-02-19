<?php
    $session = \Config\Services::session();
?>

<div onclick="closeSidemenu()" id="sidemenu-overlay" class="transition duration-700 fixed top-0 right-0 w-screen h-screen bg-overlay translate-x-full data-[sidemenuhidden='false']:-translate-x-0" data-sidemenuhidden="true">

</div>

<nav id="sidemenu" class="fixed block transition duration-700 top-0 right-0 w-2/4 h-full bg-zinc-200 dark:bg-zinc-900 dark:text-white text-black sm:w-64 translate-x-full data-[sidemenuhidden='false']:-translate-x-0" data-sidemenuhidden="true">
    <div class="flex flex-col h-full">
        <div class="p-2 px-5 clear-right">
            <?php if ($session->get('isLoggedIn')) { ?>
                <button class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <i data-feather="bell"></i>
                        <span class="badge badge-xs badge-primary indicator-item"></span>
                    </div>
                </button>
            <?php } ?>
            <button class="btn btn-ghost btn-circle float-right" onclick="closeSidemenu()"> <i data-feather="x"></i> </button>
        </div>
        <div class="flex-1 flex flex-col h-full overflow-auto">
            <ul class="px-4 flex-1">
                <li><a class="btn btn-ghost w-full justify-start text-lg" href="/"><i data-feather="home"></i> <?=lang('Pages.home')?></a></li>
                <?php if ($session->get('isLoggedIn')) { ?>
                <?php } else { ?>
                    <li><a class="btn btn-ghost w-full justify-start text-lg" href="/Participate"><i data-feather="edit-3"></i> <?=lang('Pages.participate')?></a></li>
                <?php } ?>
                
            </ul>
            <div>
                <!-- <ul class="px-4 pb-4 ">
                    <li>
                        <a class="btn btn-ghost w-full" href="/Participate"><?=lang('Pages.participate')?></a>
                    </li>
                </ul> -->
                <div class="py-4 px-4 border-t dark:border-white border-black">
                    <div>
                        <?php if ($session->get('isLoggedIn')) { ?>
                            <div class="dropdown dropdown-top w-full">
                                <div role="button" tabindex="0" class="btn btn-ghost w-full justify-start text-lg" href="/Login"><i data-feather="chevron-up"></i> <?=$session->get('user_data')['username']?></div>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow rounded-box w-full bg-zinc-300 dark:bg-zinc-950">
                                    <li><a><?=lang('CustomTerms.updateProfile')?></a></li>
                                    <li class="dark:bg-white bg-black"></li>
                                    <li><a><?=lang('Auth.logout')?></a></li>
                                </ul>
                            </div>
                            
                        <?php } else { ?>
                            <a class="btn btn-ghost w-full justify-start text-lg" href="/Login"><i data-feather="user"></i> <?=lang('Auth.login')?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script src="<?=base_url()?>js/sidemenu.js"></script>
<script>feather.replace();</script>