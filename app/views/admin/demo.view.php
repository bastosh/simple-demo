<?php require __DIR__.'/../admin/partials/head.php'; ?>

  <!-- CONTENT -->
  <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

    <a href="/admin-demos"><i class="fas fa-long-arrow-alt-left"></i> Back</a>

    <h2 class="text-center"><?= $demo->title; ?></h2>
    <hr>
    <?php if($demo->image) : ?>
    <div class="grid-x align-center">
      <div class="medium-4">
        <img src="/img/<?= $demo->image; ?>" alt=""/>
      </div>
    </div>
    <?php endif; ?>

  </div>
  <!-- END CONTENT -->

<?php require __DIR__.'/../admin/partials/footer.php'; ?>
