<?php
    $data['title'] = lang('Errors.pageNotFound');
    $data['centerContent'] = true;
    echo view('templates/header', $data);
?>
    <div class="w-4/5 text-center mx-auto p-8 bg-opacity-50 bg-red-300 rounded-lg">
        <h1 class="text-5xl font-light mb-1">404</h1>

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
