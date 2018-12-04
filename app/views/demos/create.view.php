<?php require __DIR__.'/../admin/partials/head.php'; ?>

  <!-- CONTENT -->
  <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

    <a href="/admin-demos"><i class="fas fa-long-arrow-alt-left"></i> Back</a>

    <h2 class="text-center">New Demo</h2>
    <hr>

    <?php require __DIR__ . '/../partials/message.php'; ?>

    <div class="grid-x margin-top-2 align-center">
      <div class="cell medium-8 large-6">
        <?php require __DIR__ . '/../partials/errors.php'; ?>
        <form action="/demos" method="POST" enctype="multipart/form-data"
          <?= \Simple\Core\App::get('data-abide') == true ? 'data-abide' : '' ?> novalidate>

          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">

          <div data-abide-error class="callout alert-callout-border alert" style="display: none;">
            <p><i class="fi-alert"></i> There are some errors in your form.</p>
          </div>

          <label for="image">Image</label>
          <div class="callout margin-bottom-1">
            <input type="file" name="image" id="image" required>
            <span class="form-error">
              An demo needs an image.
            </span>
          </div>

          <label>Name&thinsp;*
            <input name="title" type="text" placeholder="Name of the demo" required value="<?= isset($title) ? $title : ''; ?>">
            <span class="form-error">
              An demo needs a name.
            </span>
          </label>

          <div class="grid-x align-center margin-top-1">
            <input type="submit" class="button" value="Publish">
          </div>
        </form>
      </div>
    </div>

  </div>
  <!-- END CONTENT -->

  <?php require __DIR__.'/../partials/scripts.php'; ?>

  <script>
      $('[data-app-dashboard-toggle-shrink]').on('click', function(e) {
          e.preventDefault();
          $(this).parents('.app-dashboard').toggleClass('shrink-medium').toggleClass('shrink-large');
      });
  </script>

</body>
</html>


