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
        <h1 class="text-3xl font-light mb-2 text-center"><?=lang('Pages.participate')?></h1>
        <p></p>
        <form id="form" method="post" novalidate>
            <div id="first">
                <div class="mb-2">
                    <label id="username-label" class="input input-bordered flex items-center shadow">
                        <input class="grow" type="text" name="username" id="username" placeholder="<?=lang('Auth.username')?>" required>
                    </label>
                    <span class="text-red-500" id="username-error"></span>
                </div>
                <div class="mb-2">
                    <label id="email-label" class="input input-bordered flex items-center shadow">
                        <input class="grow" type="email" name="email" id="email" placeholder="<?=lang('Auth.email')?>" required>
                    </label>
                    <span class="text-red-500" id="email-error"></span>
                </div>
                <div class="mb-2">
                    <label id="password-label" class="input input-bordered flex items-center shadow">
                        <input class="grow" type="password" name="password" id="password" placeholder="<?=lang('Auth.password')?>" required>
                    </label>
                    <span class="text-red-500" id="password-error"></span>
                </div>
                <div class="mb-2">
                    <label id="confpassword-label" class="input input-bordered flex items-center shadow">
                        <input class="grow" type="password" name="confpassword" id="confpassword" placeholder="<?=lang('Auth.passwordConfirm')?>" required>
                    </label>
                    <span class="text-red-500" id="confpassword-error"></span>
                </div>

                <div class="flex justify-end items-center">
                    <button id="Next" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('Pager.next')?></button>
                </div>
            </div>

            <div id="second" class="hidden">
                <div class="mb-2">
                    <textarea id="whyParticipate-label" class="textarea textarea-bordered shadow w-full" name="whyParticipate" id="whyParticipate" placeholder="<?=lang('CustomTerms.whyParticipate')?>" rows="5" required></textarea>
                    <span class="text-red-500" id="whyParticipate-error"></span>
                </div>
                <div class="mb-2">
                    <label id="workRole-label" class="input input-bordered flex items-center shadow">
                        <input class="grow" type="text" name="workRole" id="workRole" placeholder="<?=lang('CustomTerms.workRole')?>">
                    </label>
                    <span class="text-red-500" id="workRole-error"></span>
                </div>
                <div class="mb-2">
                    <label id="githubProfile-label" class="input input-bordered flex items-center shadow">
                        <input class="grow" type="url" name="githubProfile" id="githubProfile" placeholder="<?=lang('CustomTerms.githubProfile')?>">
                    </label>
                    <span class="text-red-500" id="githubProfile-error"></span>
                </div>

                <div class="flex justify-between items-center">
                    <button id="Back" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('Pager.previous')?></button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('Auth.requestRegistration')?></button>
                </div>
            </div>
        </form>
    </div>