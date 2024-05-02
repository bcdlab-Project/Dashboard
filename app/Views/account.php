<?php
    $session = \Config\Services::session();
?>
<div class="py-5 space-y-5">
    <div>
        <h1 class="text-4xl font-medium">Update Account</h1>
        <h3 class="mt-2 text-2xl">Hii <?=$session->get('user_data')['username']?>, here is your Account Data.</h3>
    </div>
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
        <!-- Username -->
        <form id="updateUsernameForm" class="relative col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50" novalidate>
            <div class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg waiting-mask bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
            <h1 class="text-2xl font-medium">Username</h1>
            <div>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="text" name="username" id="username" required value="<?=$session->get('user_data')['username']?>" disabled>
                <p class="px-2 pt-2 text-center">The Username cannot be Updated or Changed. If changing is needed, please contact Us.</p>
            </div>
            <div class="flex items-center justify-end mt-5">
                <!-- <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700" disabled>Update</button> -->
            </div>
        </form>
        <!-- Email -->
        <form id="updateEmailForm" class="relative col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50" novalidate>
            <div class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg waiting-mask bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
            <h1 class="text-2xl font-medium">Update Email</h1>
            <div>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="email" name="email" id="email" required value="<?=$session->get('user_data')['email']?>">
                <span class="text-red-500" id="email-error"></span>
            </div>
            <div class="flex items-center justify-end mt-5">
                <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
        <!-- Github -->
        <div class="col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50">
            <h1 class="text-2xl font-medium">Connect Github</h1>
            <div>
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Connection Status: <span class="text-green-400 font-bold data-[githubconnected='false']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Connected</span><span class="text-red-400 font-bold data-[githubconnected='true']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Disconnected</span></p>
                    <div class="px-3 absolute top-0 right-0 data-[githubconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-githubconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
                <div class="relative px-3 py-2 mt-4 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Username: <span id="github-username"></span></p>
                    <div class="px-3 absolute top-0 right-0 data-[githubconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-githubconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mt-5">
                <div class="bg-blue-700 text-white font-bold py-2 px-4 hidden rounded data-[githubconnected='NotActivated']:block" data-githubconnected=NotActivated><i class="animate-spin" data-lucide="loader-2"></i></div>
                <button id="connectGithub" class="bg-github hover:bg-neutral-800 text-white border border-stone-400 font-bold py-2 px-4 rounded data-[githubconnected='true']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Connect Github</button>
                <button id="disconnectGithub" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded data-[githubconnected='false']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Disconnect</button>
            </div>
        </div>
        <!-- Discord -->
        <div class="col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50">
            <h1 class="text-2xl font-medium">Connect Discord</h1>
            <div>
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Connection Status: <span class="text-green-400 font-bold data-[discordconnected='false']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Connected</span><span class="text-red-400 font-bold data-[discordconnected='true']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Disconnected</span></p>
                    <div class="px-3 absolute top-0 right-0 data-[discordconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-discordconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
                <div class="relative px-3 py-2 mt-4 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Username: <span id="discord-username"></span></p>
                    <div class="px-3 absolute top-0 right-0 data-[discordconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-discordconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mt-5">
                <div class="bg-blue-700 text-white font-bold py-2 px-4 hidden rounded data-[discordconnected='NotActivated']:block" data-discordconnected=NotActivated><i class="animate-spin" data-lucide="loader-2"></i></div>
                <button id="connectDiscord" class="bg-discord hover:bg-blue-800 text-white font-bold py-2 px-4 rounded data-[discordconnected='true']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Connect Discord</button>
                <button id="disconnectDiscord" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded data-[discordconnected='false']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Disconnect</button>
            </div>
        </div>
        <!-- Password -->
        <div class="relative col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50">
            <div class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg waiting-mask bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
            <h1 class="text-2xl font-medium">Update Password</h1>
            <p>To change or reset Your Password an Email will be sent to You to do it.</p>
            <div class="flex items-center justify-end mt-5">
                <button id="updatePassword" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Send Email</button>
            </div>
        </div>
        <!-- 2FA -->
        <div class="relative col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50">
            <div class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg waiting-mask bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
            <h1 class="text-2xl font-medium">2FA</h1>
            <p>To delete Your Account You can make a deletion request, and we will contact You to confirm the Deletion.</p>
            <div class="flex items-center justify-end mt-5">
                <button id="set2FA" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Set 2FA</button>
            </div>
        </div>
    </div>
</div>

<dialog id="disconnect_modal" class="modal">
  <div class="modal-box bg-zinc-300 dark:bg-zinc-900">
    <h3 id="disconnect_modal_name" class="text-lg font-bold"></h3>
    <p class="py-4">Are you sure you want to disconnect?</p>
    <div class="modal-action">
      <form method="dialog">
        <button class="px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700">Cancel</button>
        <button id="disconnect_modal_button" type="button" onclick="" class="px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700">Disconnect</button>
      </form>
    </div>
  </div>
</dialog>

<script>
    document.getElementById('set2FA').addEventListener('click', function() {
        fetch('/api/users/me/2fa', {
            method: 'POST',
        })
    });
</script>