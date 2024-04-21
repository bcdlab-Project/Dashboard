    </section> 
    <footer class="absolute bottom-0 w-full p-2 py-4 text-center text-white bg-zinc-900">
        <a href="https://github.com/bcdlab-Project" target="_blank">Copyright &copy; <?= date('Y')?> bcdlab Project</a>
    </footer>
    <?php
        if (isset($scripts)) {
            foreach (esc($scripts) as $script) {
                echo '<script src="'.base_url().'js/'.$script.'"></script>';
            }
        }

        if (isset($view)) {
            echo '<script src="'.base_url().'js/views/'.esc($view).'.js"></script>';
        }
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
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/"><i data-lucide="layout-template"></i>Overview</a></li>
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/projects"><i data-lucide="folder-kanban"></i>Projects</a></li>
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/nodes"><i data-lucide="hard-drive"></i>Nodes</a></li>
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/forms"><i data-lucide="check-circle"></i>Forms Evaluations</a></li>
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/users"><i data-lucide="users"></i>Users</a></li>
                    <li><a class="justify-start w-full text-lg btn btn-ghost" href="/request"><i data-lucide="pencil-line"></i>Make a Request</a></li>
                </ul>
                <div>
                    <div class="px-4 py-4 border-t border-black dark:border-white">
                        <div>
                            <?php if(session()->has('user_data')) { ?>
                                <div class="w-full dropdown dropdown-top">
                                    <div role="button" tabindex="0" class="justify-start w-full text-lg btn btn-ghost"><i data-lucide="chevron-up"></i> <?=session()->get('user_data')['username']?></div>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow rounded-box w-full bg-zinc-300 dark:bg-zinc-950">
                                        <li><a href="/account">Account</a></li>
                                        <li class="bg-black dark:bg-white"></li>
                                        <li><button type="button" onclick="logout_modal.showModal()">Logout</button></li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <dialog id="logout_modal" class="modal">
    <div class="modal-box bg-zinc-300 dark:bg-zinc-900">
        <h3 class="text-lg font-bold">Logout</h3>
        <p class="py-4">Are you sure you want to log out?</p>
        <div class="modal-action">
        <form method="dialog">
            <button class="px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700">Cancel</button>
            <button class="px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700" onclick="logout()">Logout</button>
        </form>
        </div>
    </div>
    </dialog>

    <script src="<?=base_url()?>js/scrollLock.js"></script>
    <script>lucide.createIcons();</script>

</body>
</html>