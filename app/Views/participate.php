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
        <form id="form" method="post" novalidate>
            <div id="first">
                <div class="mb-2">
                    <label class="block font-semibold" for="username"><?=lang('Auth.username')?></label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="text" name="username" id="username" placeholder="..." required invalid>
                    <span class="text-red-500" id="username-error"></span>
                </div>
                <div class="mb-2">
                    <label class="block font-semibold" for="email"><?=lang('Auth.email')?></label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="email" name="email" id="email" placeholder="...@email.com" required>
                    <span class="text-red-500" id="email-error"></span>
                </div>
                <div class="mb-2">
                    <label class="block font-semibold" for="password"><?=lang('Auth.password')?></label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="password" name="password" id="password" placeholder="******************" required>
                    <span class="text-red-500" id="password-error"></span>
                </div>
                <div class="mb-2">
                    <label class="block font-semibold" for="confpassword"><?=lang('Auth.passwordConfirm')?></label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="password" name="confpassword" id="confpassword" placeholder="******************" required>
                    <span class="text-red-500" id="confpassword-error"></span>
                </div>

                <div class="flex justify-end items-center">
                    <button id="Next" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('Pager.next')?></button>
                </div>
            </div>

            <div id="second" class="hidden">
                <div class="mb-4">
                    <label class="block font-semibold" for="whyParticipate"><?=lang('CustomTerms.whyParticipate')?></label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none " name="whyParticipate" id="whyParticipate" placeholder="<?=lang('CustomTerms.placeHolder_whyParticipate')?>" rows="5" required></textarea>
                    <span class="text-red-500" id="whyParticipate-error"></span>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold" for="workRole"><?=lang('CustomTerms.workRole')?></label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="text" name="workRole" id="workRole" placeholder="<?=lang('CustomTerms.placeHolder_workRole')?>">
                    <span class="text-red-500" id="workRole-error"></span>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold" for="githubProfile"><?=lang('CustomTerms.githubProfile')?></label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none" type="url" name="githubProfile" id="githubProfile" placeholder="https://github.com/...">
                    <span class="text-red-500" id="githubProfile-error"></span>
                </div>

                <div class="flex justify-between items-center">
                    <button id="Back" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('Pager.previous')?></button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?=lang('Auth.requestRegistration')?></button>
                </div>
            </div>
        </form>
    </div>


<script>
    var form = document.getElementById("form");

    const submitting = async () => {
        if (document.getElementById("second").classList.contains('hidden')) {
            await goNext();
        } else if (await validate('second')) {
            form.submit();
        }
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation()
        submitting();



    })

    document.getElementById("Next").onclick=async() => {
        await goNext();
    };

    document.getElementById("Back").onclick=async() => {
        await goBack();
    };


    async function goBack() {
        var first = document.getElementById("first");
        var second = document.getElementById("second");

        first.classList.remove('hidden')
        second.classList.add('hidden')
    }

    async function goNext() {
        if (await validate('first')) {
            var first = document.getElementById("first");
            var second = document.getElementById("second");

            first.classList.add('hidden')
            second.classList.remove('hidden')
        }
    }



    async function validate(part) {
        var formDT = new FormData(document.getElementById("form"))
        var response = await fetch('/participate/validate/' + part, {
        method: 'POST',
        body: formDT
        })

        var resp = await response.json()

        var endResu = true;


        for (const field of formDT.entries()) {
            if (resp[field[0]] !== undefined && resp[field[0]] !== null) {
                endResu = false;
                document.getElementById(field[0] + "-error").innerHTML = resp[field[0]]
                document.getElementById(field[0]).classList.add('form-error')
            } else {
                document.getElementById(field[0] + "-error").innerHTML = ""
                document.getElementById(field[0]).classList.remove('form-error')
            } 
        }

        return endResu;
    }
</script>