<div id="init-form" class="relative self-center w-full p-6 px-8 mx-auto rounded-lg lg:px-6 lg:w-2/5 h-fit bg-zinc-300/50 dark:bg-zinc-950/50">
    <div id="waiting-mask" class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
    <h1 class="mb-2 text-3xl font-light text-center">Password Recovery</h1>
    <form id="form" method="post" class="space-y-5">
        <p>To Recover Your password, please insert your Email Address and we will send You an Email with the next steps.</p>
        <div>      
            <label class="font-medium">Email Address</label>
            <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="email" name="email" id="email">
            <span class="text-red-500" id="email-error"></span>
        </div>

        <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 shadow btn hover:bg-blue-700">Recover Password</button>
    </form>
</div>

<div id="final-message" class="self-center hidden w-full p-6 px-8 mx-auto text-center rounded-lg lg:px-6 lg:w-2/5 h-fit bg-zinc-300/50 dark:bg-zinc-950/50">
    <h1 class="mb-2 text-3xl font-light">Password Recovery</h1>
    <p class="">Please check Your inbox for the password recovery Email!</p>
    <p>(In case you can't find our email check your spam inbox, or the Email Address may not be registered in our system.)</p>
    <p class="mt-4 font-semibold text-yellow-500">You have 15 minutes to recover Your Password!!</p>
    <p class="mt-4 underline underline-offset-2"><a href="/">Go Back to Home Page</a></p>
</div>