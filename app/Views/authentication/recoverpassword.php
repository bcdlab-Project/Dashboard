<div id="init-form" class="relative self-center w-full p-6 px-8 mx-auto rounded-lg lg:px-6 lg:w-2/5 h-fit bg-zinc-300/50 dark:bg-zinc-950/50">
    <div id="waiting-mask" class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
    <h1 class="mb-2 text-3xl font-light text-center">Recover Password</h1>
    <form id="form" method="post" class="space-y-5">
        <p>Please Insert Your new password to finish the password recovery proccess.</p>
        <div>      
            <label class="font-medium">New Password</label>
            <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="password" name="password" id="password">
            <span class="text-red-500" id="password-error"></span>
        </div>
        <div>      
            <label class="font-medium">New Password (again)</label>
            <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="password" name="confpassword" id="confpassword">
            <span class="text-red-500" id="confpassword-error"></span>
        </div>
        <input type="hidden" name="id" value="<?=service('request')->getGet("id")?>">
        <input type="hidden" name="token" value="<?=service('request')->getGet("token")?>">
        <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700">Recover Password</button>
    </form>
</div>

<div id="final-message" class="self-center hidden w-full p-6 px-8 mx-auto text-center rounded-lg lg:px-6 lg:w-2/5 h-fit bg-zinc-300/50 dark:bg-zinc-950/50">
    <h1 class="mb-2 text-3xl font-light">Recover Password</h1>
    <p id="message" class="text-xl font-semibold data-[ok=true]:text-green-400 text-red-400" data-ok=false>Your Password has been recoverd with success!</p>
    <p class="mt-4 underline underline-offset-2"><a href="/authentication/forgotpassword">If something Went Wrong, try again!</a></p>
    <p class="mt-4 underline underline-offset-2"><a href="/authentication/login">Go to Login Page</a></p>
</div>