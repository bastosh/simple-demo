<?php if (isset($_SESSION['flash_message'])) : ?>
  <?php
  $error = $_SESSION['flash_message'];
  $level = key($error);
  unset($_SESSION['flash_message']);
  ?>
  <div data-closable class="callout alert-callout-border <?= $level; ?>">
    <strong><?= ucfirst($level); ?>!</strong> - <?= $error[$level]; ?>
    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

