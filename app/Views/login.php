    <div id="error" class="<?=esc($error?"":"hidden")?> w-4/5 flex items-center justify-center mx-auto mt-24 my-8 p-8 bg-opacity-50 bg-red-300 rounded-lg animate-pulse absolute">
        <span class="mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
            </svg>
        </span>
        <p><?= lang('Auth.badAttempt')?></p> 
    </div>  
    <div class="px-8 w-full lg:px-6 lg:w-2/5 mx-auto h-fit self-center p-6 bg-opacity-50 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950 rounded-lg">
        <h1 class="text-3xl font-light mb-2 text-center"><?=lang('Auth.login')?></h1>
        <form id="form" method="post" class="space-y-5">
            <div>      
                <label class="font-medium"><?=lang('Auth.username')?></label>
                <input class="w-full mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg" type="text" name="username" id="username">
            </div>
            <div>
                <label class="font-medium"><?=lang('Auth.password')?></label>
                <input class="w-full mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg" type="password" name="password" id="password">
            </div>
            <div>
                <label class="font-medium">
                    <input type="checkbox" name="remember" id="remember" class="mr-2"><?=lang('Auth.rememberMe')?>
                </label>
            </div>

            <button type="submit" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 shadow w-full"><?=lang('Auth.login')?></button>
            <button onclick="loginGithub()" type="button" class="btn bg-github hover:bg-neutral-800 text-white font-bold py-2 px-4 border border-stone-400 shadow w-full"><?=lang('Auth.loginWith')?><i data-feather="github"></i></button>
            <div class="text-sm text-center w-full">
                <a class="text-blue-500 hover:text-blue-800" href="/authentication/forgotpassword"><?=lang('Auth.forgotPassword')?></a>
            </div>
        </form>
    </div>