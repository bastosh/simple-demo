<?php require __DIR__.'/../partials/head.php'; ?>
  <h1 class="text-center margin-bottom-2">LOGIN</h1>
  <div class="grid-x align-center">
    <div class="small-8 medium-4">
      <form action="/admin" method="POST">
        <label>
          Username
          <input type="text" name="username">
        </label>
        <label>
          Password
          <input type="password" name="password">
        </label>
        <button type="submit" class="button expanded">Connexion</button>
      </form>
    </div>
  </div>
<?php require __DIR__.'/../partials/footer.php'; ?>



