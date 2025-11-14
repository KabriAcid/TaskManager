    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

    <!-- Scripts -->
    <script src="<?php echo APP_URL; ?>/public/js/utils.js"></script>
    <script src="<?php echo APP_URL; ?>/public/js/app.js"></script>
    <?php if (isset($additionalScripts)) echo $additionalScripts; ?>

    <!-- Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
    </body>

    </html>