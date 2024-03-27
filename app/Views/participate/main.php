<?php 
        $request = \Config\Services::request();
        if (false)  { // esc($error)
            ?>
            <div class="flex items-center justify-center w-4/5 p-8 mx-auto my-8 bg-red-300 bg-opacity-50 rounded-lg animate-pulse">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                </svg>
            </span>
                <p>The Username or Password is Incorrect!!</p>
            </div>   
            <?php
        }
    ?>

<div id="init-form" class="relative self-center w-full p-6 px-8 mx-auto bg-opacity-50 rounded-lg lg:px-6 lg:w-3/5 xl:w-2/5 bg-zinc-300 dark:bg-opacity-50 dark:bg-zinc-950 h-fit">
    <div id="waiting-mask" class="absolute top-0 right-0 items-center justify-center hidden w-full h-full rounded-lg bg-overlay"><i class="animate-spin" data-lucide="loader-2" style="width: 40px; height: 40px;"></i></div>
    <h1 class="mb-2 text-3xl font-light text-center">Participate</h1>
    <p></p>
    <form id="form" method="post" novalidate>
        <div id="first" class="space-y-5">
            <div>
                <label class="font-medium">Username</label>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="text" name="requested_username" id="requested_username" required>
                <span class="text-red-500" id="requested_username-error"></span>
            </div>
            <div>
                <label class="font-medium">Email Address</label>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="email" name="requested_email" id="requested_email" required>
                <span class="text-red-500" id="requested_email-error"></span>
            </div>
            <div>
                <label class="font-medium">Password</label>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="password" name="requested_password" id="requested_password" required>
                <span class="text-red-500" id="requested_password-error"></span>
            </div>
            <div>
                <label class="font-medium">Password (again)</label>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="password" name="confpassword" id="confpassword" required>
                <span class="text-red-500" id="confpassword-error"></span>
            </div>

            <div class="flex items-center justify-end">
                <button id="Next" type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Next</button>
            </div>
        </div>

        <div id="second" class="hidden space-y-5">
            <div>
                <label class="font-medium">Why Participate</label>
                <textarea class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" name="why_participate" id="why_participate" rows="5" required></textarea>
                <span class="text-red-500" id="why_participate-error"></span>
            </div>
            <div>
                <label class="font-medium">Work Role</label>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="text" name="work_role" id="work_role">
                <span class="text-red-500" id="work_role-error"></span>
            </div>
            <div>
                <label class="font-medium">GitHub Profile</label>
                <input class="w-full px-3 py-2 mt-2 border rounded-lg shadow-sm outline-none" type="url" name="github_profile" id="github_profile">
                <span class="text-red-500" id="github_profile-error"></span>
            </div>
            <div class="flex items-center justify-between">
                <button id="Back" type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Previous</button>
                <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Request Registration</button>
            </div>
        </div>
    </form>
</div>

<div id="final-message" class="self-center hidden w-full p-6 px-8 mx-auto text-center rounded-lg lg:px-6 lg:w-2/5 h-fit bg-zinc-300/50 dark:bg-zinc-950/50">
    <h1 class="mb-2 text-3xl font-light">Participate</h1>
    <p class="">Please check Your inbox to confirm your email! (In case you can't find our email check your spam inbox)</p>
    <p class="mt-4 font-semibold text-yellow-500">You have 1 hour to confirm Your Email!!</p>
    <p class="mt-4 underline underline-offset-2"><a href="/">Go Back to Home Page</a></p>
</div>