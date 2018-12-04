<?php require __DIR__.'/../admin/partials/head.php'; ?>

  <!-- CONTENT -->
  <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

    <a href="/admin-features"><i class="fas fa-long-arrow-alt-left"></i> Back</a>

    <h2 class="text-center"><?= $feature->title; ?></h2>
    <hr>

    <div class="grid-x align-center margin-top-2">
      <div class="small-10  medium-6">
        <p class="text-center lead"><?= $feature->description; ?></p>
      </div>
    </div>

  </div>
  <!-- END CONTENT -->

<?php require __DIR__.'/../admin/partials/footer.php'; ?>
