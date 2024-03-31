<?php
    $session = \Config\Services::session();
?>
<div class="py-5 space-y-5">
    <div>
        <h1 class="text-4xl font-medium">Update Profile</h1>
        <h3 class="text-2xl">Hii <?=$session->get('user_data')['username']?>, here is your Profile.</h3>
    </div>
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
        <!-- Username -->
        <form id="updateUsernameForm" class="relative col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50" novalidate>
            <div class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg waiting-mask bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
            <h1 class="text-2xl font-medium">Update Username</h1>
            <div>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="text" name="username" id="username" required value="<?=$session->get('user_data')['username']?>">
                <span class="text-red-500" id="username-error"></span>
            </div>
            <div class="flex items-center justify-end mt-5">
                <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
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
        <!-- Password -->
        <form id="updatePasswordForm" class="relative col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50" novalidate>
            <div class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg waiting-mask bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
            <h1 class="text-2xl font-medium">Update Password</h1>
            <div class="space-y-2">
                <div>
                    <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="password" name="password" id="password" required placeholder="Password">
                    <span class="text-red-500" id="password-error"></span>
                </div>
                <div>
                    <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="password" name="confpassword" id="confpassword" required placeholder="Password (again)">
                    <span class="text-red-500" id="confpassword-error"></span>
                </div>
            </div>
            <div class="flex items-center justify-end mt-5">
                <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
        <!-- Github -->
        <div class="col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50">
            <h1 class="text-2xl font-medium">Connect Github</h1>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 gap-x-4">
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>ConnectionStatus <span class="text-green-400 font-bold data-[githubconnected='false']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Connected</span><span class="text-red-400 font-bold data-[githubconnected='true']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Disconnected</span></p>
                    <div class="px-3 absolute top-0 right-0 data-[githubconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-githubconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Username: <span id="github-username"></span></p>
                    <div class="px-3 absolute top-0 right-0 data-[githubconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-githubconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Last Used Login: <span id="github-last-login"></span></p>
                    <div class="px-3 absolute top-0 right-0 data-[githubconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-githubconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Connected At: <span id="github-connected-at"></span></p>
                    <div class="px-3 absolute top-0 right-0 data-[githubconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-githubconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mt-5">
                <div class="bg-blue-700 text-white font-bold py-2 px-4 hidden rounded data-[githubconnected='NotActivated']:block" data-githubconnected=NotActivated><i class="animate-spin" data-lucide="loader-2"></i></div>
                <button onclick="connectGithub()" class="bg-github hover:bg-neutral-800 text-white border border-stone-400 font-bold py-2 px-4 rounded data-[githubconnected='true']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Connect Github</button>
                <button onclick="loadDisconnectModal('Github')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded data-[githubconnected='false']:hidden data-[githubconnected='NotActivated']:hidden" data-githubconnected=NotActivated>Disconnect</button>
            </div>
        </div>
        <!-- Discord -->
        <div class="col-span-1 p-4 rounded-2xl bg-zinc-300/50 dark:bg-zinc-950/50">
            <h1 class="text-2xl font-medium">Connect Discord</h1>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 gap-x-4">
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Connection Status: <span class="text-green-400 font-bold data-[discordconnected='false']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Connected</span><span class="text-red-400 font-bold data-[discordconnected='true']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Disconnected</span></p>
                    <div class="px-3 absolute top-0 right-0 data-[discordconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-discordconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Username: <span id="discord-username"></span></p>
                    <div class="px-3 absolute top-0 right-0 data-[discordconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-discordconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
                <div class="relative px-3 py-2 mt-2 overflow-hidden border rounded-lg shadow-sm outline-none like-input">
                    <p>Connected At: <span id="discord-connected-at"></span></p>
                    <div class="px-3 absolute top-0 right-0 data-[discordconnected='NotActivated']:flex hidden justify-end items-center h-full w-full bg-overlay" data-discordconnected="NotActivated">
                        <i class="animate-spin" data-lucide="loader-2"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mt-5">
                <div class="bg-blue-700 text-white font-bold py-2 px-4 hidden rounded data-[discordconnected='NotActivated']:block" data-discordconnected=NotActivated><i class="animate-spin" data-lucide="loader-2"></i></div>
                <button onclick="connectDiscord()"  class="bg-discord hover:bg-blue-800 text-white font-bold py-2 px-4 rounded data-[discordconnected='true']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Connect Discord</button>
                <button onclick="loadDisconnectModal('Discord')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded data-[discordconnected='false']:hidden data-[discordconnected='NotActivated']:hidden" data-discordconnected=NotActivated>Disconnect</button>
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
    var dataPass = {};
    dataPass["userId"]  = <?=$session->get('user_data')['id']?>;
</script>

<script>
    document.getElementById('updateUsernameForm').addEventListener('submit', function(e) {
        e.preventDefault();        
        forms.startMultipleWaiting();
        fetch('/profile/updateUsername', {
            method: 'POST',
            body: new FormData(document.getElementById("updateUsernameForm"))
        })
        .then(response => response.json())
        .then(data => {
            forms.stopMultipleWaiting();
            if (data.ok) {
                document.getElementById("username-error").innerHTML = " "
                document.getElementById("username").classList.remove('form-error')
                alert('Username Updated Successfully');
            } else {
                document.getElementById("username").classList.add('form-error')
                document.getElementById('username-error').innerText = data.username;
            }
        });
    });

    document.getElementById('updateEmailForm').addEventListener('submit', function(e) {
        e.preventDefault();        
        forms.startMultipleWaiting();
        fetch('/profile/updateEmail', {
            method: 'POST',
            body: new FormData(document.getElementById("updateEmailForm"))
        })
        .then(response => response.json())
        .then(data => {
            forms.stopMultipleWaiting();
            if (data.ok) {
                document.getElementById("email-error").innerHTML = " "
                document.getElementById("email").classList.remove('form-error')
                alert('Email Updated Successfully');
            } else {
                document.getElementById("email").classList.add('form-error')
                document.getElementById('email-error').innerText = data.username;
            }
        });
    });

    document.getElementById('updatePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();        
        forms.startMultipleWaiting();
        fetch('/profile/updatePassword', {
            method: 'POST',
            body: new FormData(document.getElementById("updatePasswordForm"))
        })
        .then(response => response.json())
        .then(data => {
            forms.stopMultipleWaiting();

            document.getElementById("password").classList.remove('form-error');
            document.getElementById('password-error').innerText = " ";
            document.getElementById("confpassword").classList.remove('form-error');
            document.getElementById('confpassword-error').innerText = " ";

            if (data.ok) {
                document.getElementById("password").value = "";
                document.getElementById("confpassword").value = "";
                alert('Password Updated Successfully');
            } else {
                if (data.password) {
                    document.getElementById("password").classList.add('form-error');
                    document.getElementById('password-error').innerText = data.password;
                }
                if (data.confpassword) {
                    document.getElementById("confpassword").classList.add('form-error');
                    document.getElementById('confpassword-error').innerText = data.confpassword;
                }
            }
        });
    });
</script>