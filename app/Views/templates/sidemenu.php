<?php
    $session = \Config\Services::session();
?>

<div onclick="closeSidemenu()" id="sidemenu-overlay" class="transition duration-700 fixed top-0 right-0 w-screen h-screen bg-overlay translate-x-full data-[sidemenuhidden='false']:-translate-x-0" data-sidemenuhidden="true">

</div>

<nav id="sidemenu" class="z-10 fixed block transition duration-700 top-0 right-0 w-2/3 h-full bg-zinc-100 dark:bg-zinc-900 dark:text-white text-black sm:w-64 translate-x-full data-[sidemenuhidden='false']:-translate-x-0" data-sidemenuhidden="true">
    <div class="flex flex-col h-full">
        <div class="clear-right p-2 px-5">
            <button class="float-right btn btn-ghost btn-circle" onclick="closeSidemenu()"> <i data-lucide="x"></i> </button>
        </div>
        <div class="flex flex-col flex-1 h-full overflow-auto">
            <ul class="flex-1 px-4">
                <li><a class="justify-start w-full text-lg btn btn-ghost" href="/"><i data-lucide="home"></i> <?=lang('Pages.home')?></a></li>
                <?php if ($session->get('loggedIn')) { ?>
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/dashboard"><i data-lucide="activity"></i> <?=lang('Pages.dashboard')?></a></li>
                <?php } else { ?>
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/Participate"><i data-lucide="pen-line"></i> <?=lang('Pages.participate')?></a></li>
                <?php } ?>
                
            </ul>
            <div>
                <div class="px-4 py-4 border-t border-black dark:border-white">
                    <div>
                        <?php if ($session->get('loggedIn')) { ?>
                            <div class="w-full dropdown dropdown-top">
                                <div role="button" tabindex="0" class="justify-start w-full text-lg btn btn-ghost"><i data-lucide="chevron-up"></i> <?=$session->get('user_data')['username']?></div>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow rounded-box w-full bg-zinc-300 dark:bg-zinc-950">
                                    <li><a href="/profile"><?=lang('CustomTerms.updateProfile')?></a></li>
                                    <li class="bg-black dark:bg-white"></li>
                                    <li><button type="button" onclick="logout_modal.showModal()"><?=lang('Auth.logout')?></button></li>
                                </ul>
                            </div>
                            
                        <?php } else { ?>
                            <a class="justify-start w-full text-lg btn btn-ghost" href="/authentication/login"><i data-lucide="user"></i> <?=lang('Auth.login')?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<dialog id="logout_modal" class="modal">
  <div class="modal-box bg-zinc-300 dark:bg-zinc-900">
    <h3 class="text-lg font-bold"><?=lang('Auth.logout')?></h3>
    <p class="py-4"><?=lang('Auth.confirmLogout')?></p>
    <div class="modal-action">
      <form method="dialog">
        <button class="px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700"><?=lang('CustomTerms.cancel')?></button>
        <button class="px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700" onclick="logout()"><?=lang('Auth.logout')?></button>
      </form>
    </div>
  </div>
</dialog>

<script src="<?=base_url()?>js/sidemenu.js"></script>
<script>feather.replace();</script>