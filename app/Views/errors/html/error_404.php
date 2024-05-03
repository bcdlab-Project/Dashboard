<?php
    $data['title'] = lang('Errors.pageNotFound');
    $data['pageMargin'] = false;
    echo view('templates/header', $data);
?>
    <div class="self-center w-4/5 p-8 mx-auto text-center bg-red-300 bg-opacity-50 rounded-lg h-fit">
        <h1 class="mb-1 text-5xl font-light"><?=lang('Errors.pageNotFound')?></h1>

        <p class="mt-4 text-xl font-light">
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>
        <p class="mt-4 underline underline-offset-2"><a href="/">Go Back to Home Page</a></p>
    </div>
<?= view('templates/footer') ?>
