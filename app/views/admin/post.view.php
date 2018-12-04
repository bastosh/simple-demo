<?php require __DIR__.'/../admin/partials/head.php'; ?>

  <!-- CONTENT -->
  <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

    <a href="/admin-posts"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
    <hr>

    <div class="grid-x align-center">
      <article class="small-10 medium-8 large-6">
        <h1 class="margin-top-2" style="line-height: 1"><?= $post->title; ?></h1>
        <p class="lead font-italic margin-bottom-2">
          <time>
            <?php
            $date = new DateTime($post->created_at);
            echo $date->format('M d, Y');
            ?>
          </time>
          by John Doe
        </p>
        <?php if($post->image) : ?>
          <picture>
            <source media="(min-width: 768px)"
                    srcset="/img/<?= $post->image; ?> 1x,
                            /img/lg-<?= $post->image; ?> 2x">
            <img src="/img/sm-<?= $post->image; ?>"
                 srcset="/img/<?= $post->image; ?> 2x"
                 alt="" style="width: 100%">
          </picture>
        <?php endif; ?>
        <div class="margin-top-2"><?= $post->content; ?></div>
      </article>
    </div>
  </div>
  <!-- END CONTENT -->

<?php require __DIR__.'/../admin/partials/footer.php'; ?>
