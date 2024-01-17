    <?php 
        $request = \Config\Services::request();
        if (esc($error))  {
            ?>
            <div class="w-4/5 flex items-center justify-center mx-auto my-8 p-8 bg-opacity-50 bg-red-300 rounded-lg animate-pulse">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                </svg>
            </span>
                <p><?= lang('Auth.badAttempt')?></p> 
            </div>   
            <?php
        }
    ?>

    <div class="w-80 mx-auto p-6 bg-opacity-50 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950 rounded-lg">
        <h1 class="text-3xl font-light mb-2 text-center"><?=lang('Auth.login')?></h1>
        <form action="" method="post">
            <div class="mb-4">
                <label class="block font-semibold" for="username"><?=lang('Auth.username')?></label>
                <input class="shadow appearance-none border dark:border-bg-dark-color-scheme rounded w-full py-2 px-3 leading-tight focus:outline-none" type="text" name="username" id="username" placeholder="<?=lang('Auth.username')?>" value="<?=$request->getPost('username')?>">
            </div>
            <div class="mb-1">
                <label class="block font-semibold" for="password"><?=lang('Auth.password')?></label>
                <input class="shadow appearance-none border dark:border-bg-dark-color-scheme rounded w-full py-2 px-3 leading-tight focus:outline-none" type="password" name="password" id="password" placeholder="******************">
            </div>
            <div class="mb-4">
                <a class="text-blue-500 hover:text-blue-800 font-medium align-baseline inline-block" href="Login/forgotpassword"><?=lang('Auth.forgotPassword')?></a>
            </div>
            <div class="flex justify-between items-stretch ">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow"><?=lang('Auth.login')?></button>
                <a href="" class="bg-github hover:bg-neutral-800 text-white font-bold py-2 px-4 rounded border border-stone-400 shadow"><span class="align-middle mr-1"><?=lang('Auth.loginWith')?></span><img src="<?=base_url()?>images/github.png" class="h-6 inline-block" alt=""></a>
            </div>
        </form>
    </div>


    <!-- <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Dropdown </button>
            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                </div>
            </div> -->