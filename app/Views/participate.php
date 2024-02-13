<?php 
        $request = \Config\Services::request();
        if (false)  { // esc($error)
            ?>
            <div class="w-4/5 flex items-center justify-center mx-auto my-8 p-8 bg-opacity-50 bg-red-300 rounded-lg animate-pulse">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                </svg>
            </span>
                <p>The Username or Password is Incorrect!!</p>
            </div>   
            <?php
        }
    ?>

<div class="px-8 w-full lg:px-6 lg:w-3/5 mx-auto p-6 bg-opacity-50 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950 rounded-lg mt-16 mb-12">
        <h1 class="text-3xl font-light mb-2 text-center"><?=lang('CustomTerms.participate')?></h1>
        <p></p>
        <form action="" method="post">
            <div class="mb-4">
                <label class="block font-semibold" for="username"><?=lang('Auth.username')?></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="text" name="username" id="username" placeholder="..." value="<?=$request->getPost('username')?>">
            </div>
            <div class="mb-4">
                <label class="block font-semibold" for="email"><?=lang('Auth.email')?></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="email" name="email" id="email" placeholder="...@email.com">
            </div>
            <div class="mb-4">
                <label class="block font-semibold" for="password"><?=lang('Auth.password')?></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="password" name="password" id="password" placeholder="******************">
            </div>
            <div class="mb-4">
                <label class="block font-semibold" for="confpassword"><?=lang('Auth.password')?></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="password" name="confpassword" id="confpassword" placeholder="******************">
            </div>


            <div class="mb-4">
                <label class="block font-semibold" for="whyParticipate"><?=lang('CustomTerms.whyParticipate')?></label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" name="whyParticipate" id="whyParticipate" placeholder="<?=lang('CustomTerms.placeHolder_whyParticipate')?>" rows="5"></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold" for="workRole"><?=lang('CustomTerms.workRole')?></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="text" name="workRole" id="workRole" placeholder="<?=lang('CustomTerms.placeHolder_workRole')?>">
            </div>
            <div class="mb-4">
                <label class="block font-semibold" for="githubProfile"><?=lang('CustomTerms.githubProfile')?></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="url" name="githubProfile" id="githubProfile" placeholder="https://github.com/...">
            </div>

            


            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('Auth.requestRegistration')?></button>
            </div>
        </form>
    </div>