<?php
    $session = \Config\Services::session();
?>

<div onclick="closeSidemenu()" id="sidemenu-overlay" class="transition duration-700 fixed top-0 right-0 w-screen h-screen bg-overlay translate-x-full data-[sidemenuhidden='false']:-translate-x-0" data-sidemenuhidden="true">

</div>

<nav id="sidemenu" class="z-10 fixed block transition duration-700 top-0 right-0 w-2/3 h-full bg-zinc-100 dark:bg-zinc-900 dark:text-white text-black sm:w-64 translate-x-full data-[sidemenuhidden='false']:-translate-x-0" data-sidemenuhidden="true">
    <div class="flex flex-col h-full">
        <div class="p-2 px-5 clear-right">
            <button class="btn btn-ghost btn-circle float-right" onclick="closeSidemenu()"> <i data-feather="x"></i> </button>
        </div>
        <div class="flex-1 flex flex-col h-full overflow-auto">
            <ul class="px-4 flex-1">
                <li><a class="btn btn-ghost w-full justify-start text-lg" href="/"><i data-feather="home"></i> <?=lang('Pages.home')?></a></li>
                <?php if ($session->get('loggedIn')) { ?>
                    <li><a class="btn btn-ghost w-full justify-start text-lg" href="/dashboard"><i data-feather="activity"></i> <?=lang('Pages.dashboard')?></a></li>
                <?php } else { ?>
                    <li><a class="btn btn-ghost w-full justify-start text-lg" href="/Participate"><i data-feather="edit-3"></i> <?=lang('Pages.participate')?></a></li>
                <?php } ?>
                
            </ul>
            <div>
                <div class="py-4 px-4 border-t dark:border-white border-black">
                    <div>
                        <?php if ($session->get('loggedIn')) { ?>
                            <div class="dropdown dropdown-top w-full">
                                <div role="button" tabindex="0" class="btn btn-ghost w-full justify-start text-lg"><i data-feather="chevron-up"></i> <?=$session->get('user_data')['username']?></div>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow rounded-box w-full bg-zinc-300 dark:bg-zinc-950">
                                    <li><a href="/profile"><?=lang('CustomTerms.updateProfile')?></a></li>
                                    <li class="dark:bg-white bg-black"></li>
                                    <li><button type="button" onclick="logout_modal.showModal()"><?=lang('Auth.logout')?></button></li>
                                </ul>
                            </div>
                            
                        <?php } else { ?>
                            <a class="btn btn-ghost w-full justify-start text-lg" href="/authentication/login"><i data-feather="user"></i> <?=lang('Auth.login')?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<dialog id="logout_modal" class="modal">
  <div class="modal-box bg-zinc-300 dark:bg-zinc-900">
    <h3 class="font-bold text-lg"><?=lang('Auth.logout')?></h3>
    <p class="py-4"><?=lang('Auth.confirmLogout')?></p>
    <div class="modal-action">
      <form method="dialog">
        <button class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 shadow"><?=lang('CustomTerms.cancel')?></button>
        <button class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 shadow" onclick="logout()"><?=lang('Auth.logout')?></button>
      </form>
    </div>
  </div>
</dialog>

<script src="<?=base_url()?>js/sidemenu.js"></script>
<script>feather.replace();</script>