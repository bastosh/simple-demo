<div class="wrapper">
  <div class="grid-container padding-vertical-1">
    <div class="title-bar" data-responsive-toggle="menu" data-hide-for="medium">
      <button class="menu-icon" type="button" data-toggle="menu"></button>
      <div class="title-bar-title">Menu</div>
    </div>
    <nav class="top-bar" id="menu">
      <div class="top-bar-left">
        <ul class="vertical medium-horizontal menu" data-responsive-menu="accordion medium-dropdown">
          <li><a href="/">Home</a></li>
          <li><a href="/about">About</a></li>
          <li><a href="/features">Features</a></li>
          <li>
            <a href="/demos">Demos</a>
            <ul class="menu vertical">
              <li><a href="/demos/landing">landing</a></li>
            </ul>
          </li>
          <li><a href="/posts">Articles</a></li>
          <li><a href="/contact">Contact</a></li>
        </ul>
      </div>
      <div class="top-bar-right show-for-large">
        <ul class="menu padding-right-1">
          <li><a href="/docs">Docs</a></li>
          <?php if (isset($_SESSION['username'])) : ?>
            <li><a href="/admin">Dashboard</a></li>
            <li><a class="button hollow" href="/logout">Logout</a></li>
          <?php else: ?>
            <li><a class="button hollow" href="/admin">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </div>
</div>