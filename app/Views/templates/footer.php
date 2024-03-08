    </section> 
    <footer class="absolute bottom-0 w-full p-2 py-4 text-center text-white bg-zinc-900">
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

<script>lucide.createIcons();</script>