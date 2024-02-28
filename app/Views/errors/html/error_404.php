<?php
    $data['title'] = lang('Errors.pageNotFound');
    $data['pageMargin'] = false;
    echo view('templates/header', $data);
?>
    <div class="w-4/5 text-center mx-auto h-fit self-center p-8 bg-opacity-50 bg-red-300 rounded-lg">
        <h1 class="text-5xl font-light mb-1"><?=lang('Errors.pageNotFound')?></h1>

        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>
        <p class="mt-4 underline underline-offset-2"><a href="/">Go Back to Home Page</a></p>
    </div>
<?= view('templates/footer') ?>
