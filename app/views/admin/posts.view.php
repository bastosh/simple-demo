<?php require 'partials/head.php'; ?>

  <!-- CONTENT -->
  <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

    <?php require __DIR__ . '/../partials/message.php'; ?>

    <h2 class="text-center">Articles</h2>
    <hr>

    <a class="button" href="/posts/create">New Article</a>

    <table class="hover text-center">
      <thead>
      <tr>
        <th class="text-center">id</th>
        <th class="text-center">Title</th>
        <th class="text-center show-for-large">Created</th>
        <th class="text-center show-for-large">Last modified</th>
        <th class="text-center show-for-medium">Status</th>
        <th class="text-center show-for-medium">&nbsp;</th>
        <th class="text-center">&nbsp;</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($posts as $post) : ?>
        <tr>
          <td><?= $post->id; ?></td>
          <td><?= $post->title; ?></td>
          <td class="show-for-large">
            <?php
              $date = new DateTime($post->created_at);
              echo $date->format('y/m/d');
            ?>
          </td>
          <td class="show-for-large">
            <?php
              $date = new DateTime($post->updated_at);
              echo $date->format('y/m/d');
            ?>
          </td>
          <?php if ($post->published === "1") :?>
            <td class="show-for-medium">Published</td>
            <td class="show-for-medium">
              <form class="display-inline margin-left-1" action="/posts/<?= $post->id; ?>/unpublish" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="button small warning margin-bottom-0">Unpublish</button>
              </form>
            </td>
          <?php else: ?>
            <td class="show-for-medium">Unpublished</td>
            <td class="show-for-medium">
              <form class="display-inline margin-left-1" action="/posts/<?= $post->id; ?>/publish" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="button small margin-bottom-0">Publish</button>
              </form>
            </td>
          <?php endif; ?>
          <td>
            <a class="button small margin-bottom-0 show-for-large" href="/admin-posts/<?= $post->id; ?>">
              <i class="fas fa-eye"></i>
            </a>
            <a class="button small warning margin-bottom-0" href="/posts/<?= $post->id; ?>/edit">
              <i class="fas fa-edit"></i>
            </a>
            <button data-open="deletePost" class="button small alert margin-bottom-0">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

    <div class="reveal" id="deletePost" data-reveal>
      <p>The article will be permanently deleted.</p>
      <form class="padding-vertical-1 text-center" action="/posts/<?= $post->id; ?>" method="POST">
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


