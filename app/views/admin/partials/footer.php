<?php require __DIR__.'/../../partials/scripts.php'; ?>
<script>
    $('[data-app-dashboard-toggle-shrink]').on('click', function(e) {
        e.preventDefault();
        $(this).parents('.app-dashboard').toggleClass('shrink-medium').toggleClass('shrink-large');
    });
</script>
</body>
</html>
