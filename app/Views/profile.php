<?php
    $session = \Config\Services::session();
?>
<div class="py-5 space-y-5">
    <div>
        <h1 class="font-medium text-4xl"><?=lang('CustomTerms.updateProfile')?></h1>
        <h3 class="text-2xl">Hii Nerexbcd, here is your Profile.</h3>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <form id="updateUsernameForm" class="col-span-1 rounded-2xl p-4 bg-opacity-50 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950" novalidate>
            <h1 class="font-medium text-2xl"><?=lang('CustomTerms.update')?> <?=lang('Auth.username')?></h1>
            <div>
                <input class="w-full mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg" type="text" name="username" id="username" required value="<?=$session->get('user_data')['username']?>">
                <span class="text-red-500" id="username-error"></span>
            </div>
            <div class="flex justify-end items-center mt-5">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('CustomTerms.update')?></button>
            </div>
        </form>
        <form id="updateEmailForm" class="col-span-1 rounded-2xl p-4 bg-opacity-50 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950" novalidate>
            <h1 class="font-medium text-2xl"><?=lang('CustomTerms.update')?> <?=lang('Auth.email')?></h1>
            <div>
                <input class="w-full mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg" type="email" name="email" id="email" required value="<?=$session->get('user_data')['email']?>">
                <span class="text-red-500" id="email-error"></span>
            </div>
            <div class="flex justify-end items-center mt-5">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('CustomTerms.update')?></button>
            </div>
        </form>
        <form id="updatePasswordForm" class="col-span-1 rounded-2xl p-4 bg-opacity-50 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950" novalidate>
            <h1 class="font-medium text-2xl"><?=lang('CustomTerms.update')?> <?=lang('Auth.password')?></h1>
            <div class="space-y-2">
                <div>
                    <input class="w-full mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg" type="password" name="password" id="password" required placeholder="<?=lang('Auth.password')?>">
                    <span class="text-red-500" id="password-error"></span>
                </div>
                <div>
                    <input class="w-full mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg" type="password" name="confpassword" id="confpassword" required placeholder="<?=lang('Auth.passwordConfirm')?>">
                    <span class="text-red-500" id="confpassword-error"></span>
                </div>
            </div>
            <div class="flex justify-end items-center mt-5">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('CustomTerms.update')?></button>
            </div>
        </form>
        <div class="col-span-1 rounded-2xl p-4 bg-opacity-50 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950">
            <h1 class="font-medium text-2xl"><?=lang('CustomTerms.connect')?> Github</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 gap-x-4">
                <div>
                    <p class="mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg like-input">Connection Status: <span class="text-green-400 font-bold data-[githubconnected='false']:hidden" data-githubconnected=false>Connected</span> <span class="text-red-400 font-bold data-[githubconnected='true']:hidden" data-githubconnected=false>Disconnected</span></p>
                </div>
                <div>
                    <p class="mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg like-input">Account Username: <span>Nerexbcd</span></p>
                </div>
                <div>
                    <p class="mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg like-input">Last Used Login: <span>20/02/2024 21:23</span></p>
                </div>
                <div>
                    <p class="mt-2 px-3 py-2 outline-none border shadow-sm rounded-lg like-input">Connected At: <span>20/02/2024 19:43</span></p>
                </div>
            </div>
            <div class="flex justify-end items-center mt-5">
                <button class="bg-github hover:bg-neutral-800 text-white border border-stone-400 font-bold py-2 px-4 rounded data-[githubconnected='true']:hidden" data-githubconnected=false><?=lang('CustomTerms.connect')?> Github</button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded data-[githubconnected='false']:hidden" data-githubconnected=false><?=lang('CustomTerms.disconnect')?></button>
            </div>
        </div>
    </div>
</div>

<script>
    [...document.querySelectorAll('[data-githubconnected]')].forEach(function (el){
        el.setAttribute('data-githubconnected',false)
        });
</script>


