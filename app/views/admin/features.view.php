<?php require 'partials/head.php'; ?>

    <!-- CONTENT -->
    <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

      <?php require __DIR__ . '/../partials/message.php'; ?>

      <h2 class="text-center">Features</h2>
      <hr>

      <a class="button" href="/features/create">New Feature</a>

      <table class="hover text-center">
        <thead>
        <tr>
          <th class="text-center">id</th>
          <th class="text-center">Title</th>
          <th class="text-center show-for-medium">Status</th>
          <th class="text-center show-for-medium">&nbsp;</th>
          <th class="text-center">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($features as $feature) : ?>
          <tr>
            <td><?= $feature->id; ?></td>
            <td><?= $feature->title; ?></td>
            <?php if ($feature->published === "1") :?>
              <td class="show-for-medium">Published</td>
              <td class="show-for-medium">
                <form class="display-inline margin-left-1" action="/features/<?= $feature->id; ?>/unpublish" method="POST">
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="button small warning margin-bottom-0">Unpublish</button>
                </form>
              </td>
            <?php else: ?>
              <td class="show-for-medium">Unpublished</td>
              <td class="show-for-medium">
                <form class="display-inline margin-left-1" action="/features/<?= $feature->id; ?>/publish" method="POST">
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="button small margin-bottom-0">Publish</button>
                </form>
              </td>
            <?php endif; ?>
            <td>
              <a class="button small margin-bottom-0 show-for-large" href="/admin-features/<?= $feature->id; ?>">
                <i class="fas fa-eye"></i>
              </a>
              <a class="button small warning margin-bottom-0" href="/features/<?= $feature->id; ?>/edit">
                <i class="fas fa-edit"></i>
              </a>
              <button data-open="deleteFeature" class="button small alert margin-bottom-0">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>

      <div class="reveal" id="deleteFeature" data-reveal>
        <p>The feature will be permanently deleted.</p>
        <form class="padding-vertical-1 text-center" action="/features/<?= $feature->id; ?>" method="POST">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
          <button type="submit" class="button alert margin-bottom-0">Don’t worry, I am 100% sure.</button>
        </form>
        <button class="close-button" data-close aria-label="Close modal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    </div>
    <!-- END CONTENT -->

<?php require __DIR__.'/../admin/partials/footer.php'; ?>


