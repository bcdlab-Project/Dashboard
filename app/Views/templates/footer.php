    </section> 
    <footer class="p-2 bg-zinc-100 dark:bg-zinc-900 text-center absolute bottom-0 w-full">
        <a href="https://github.com/bcdlab-Project" target="_blank">Copyright &copy; <?= date('Y')?> bcdlab Project</a>
    </footer>
    <?php
        if (isset($scripts)) {
            foreach (esc($scripts) as $script) {
                echo '<script src="'.base_url().'js/'.$script.'"></script>';
            }
        }

        if (isset($view)) {
            echo '<script src="'.base_url().'js/views/'.esc($view).'.js"></script>';
        }
    ?>

    <script src="<?=base_url()?>js/scrollLock.js"></script>

</body>
</html>

<script>feather.replace();</script>