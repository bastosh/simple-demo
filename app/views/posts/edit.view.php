<?php require __DIR__.'/../admin/partials/head.php'; ?>

  <!-- CONTENT -->
  <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

    <div class="grid-x align-justify">
      <a href="/admin-posts"><i class="fas fa-long-arrow-alt-left"></i> Articles</a>
      <button data-open="deletePost" class="button small alert margin-bottom-0">
        <i class="fas fa-trash"></i>
        Delete article
      </button>
    </div>

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

    <h2 class="text-center">Edit «&thinsp;<?= $post->title; ?>&thinsp;»</h2>
    <hr>

    <?php require __DIR__ . '/../partials/message.php'; ?>

    <div class="grid-x margin-top-2 align-center">
      <div class="cell medium-10 large-8">
      <?php require __DIR__ . '/../partials/errors.php'; ?>

        <?php if($post->image) : ?>
          <div class="grid-x">
            <div class="small-4">
              <p class="margin-bottom-0">Cover image (<?= $post->image; ?>)</p>
              <figure>
                <img src="/img/<?= $post->image; ?>">
              </figure>
              <button data-open="deleteImage" class="button small expanded alert margin-bottom-2">
                <i class="fas fa-trash"></i> Delete this image
              </button>
            </div>
          </div>

          <div class="reveal" id="deleteImage" data-reveal>
            <p>The image will be permanently deleted.</p>
            <form class="padding-vertical-1 text-center" action="/posts/<?= $post->id; ?>/image" method="POST">
              <input type="hidden" name="_method" value="PUT">
              <button type="submit" class="button alert margin-bottom-0">Don’t worry, I am 100% sure.</button>
            </form>
            <button class="close-button" data-close aria-label="Close modal" type="button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <form action="/posts/<?= $post->id; ?>" method="POST" enctype="multipart/form-data"
          <?= \Simple\Core\App::get('data-abide') == true ? 'data-abide' : '' ?> novalidate>

          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">

          <div data-abide-error class="callout alert-callout-border alert" style="display: none;">
            <p><i class="fi-alert"></i> There are some errors in your form.</p>
          </div>

          <?php if(!$post->image) : ?>
            <label for="image">Image</label>
            <div class="callout margin-bottom-1">
              <input type="file" name="image" id="image">
            </div>
          <?php endif; ?>

          <label>Title
            <input name="title" type="text" placeholder="Title of the post" value="<?= $post->title; ?>" required pattern="^.{3,50}$">
            <span class="form-error">
              Title is required and must contain between 3 and 50 characters.
            </span>
          </label>

          <label>Content
            <textarea name="content" id="editor" placeholder="Content of the post" required><?= $post->content; ?></textarea>
            <span class="form-error">
              Content is required.
            </span>
          </label>

          <div class="grid-x align-center margin-top-1">
            <input type="submit" class="button margin-top-1" value="Update">
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

  <script src="https://cdn.ckeditor.com/4.11.1/standard-all/ckeditor.js"></script>

  <script>
      CKEDITOR.replace('editor', {
          // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
          // The standard preset from CDN which we used as a base provides more features than we need.
          // Also by default it comes with a 2-line toolbar. Here we put all buttons in a single row.
          toolbar: [
              { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
              { name: 'styles', items: [ 'Styles', 'Format' ] },
              { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
              { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ] },
              { name: 'links', items: [ 'Link', 'Unlink' ] },
              { name: 'insert', items: [ 'EmbedSemantic' ] },
              { name: 'tools', items: [ 'Maximize' ] },
              { name: 'editing', items: [ 'Scayt' ] }
          ],
          // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
          // One HTTP request less will result in a faster startup time.
          // For more information check http://docs.ckeditor.com/ckeditor4/docs/#!/api/CKEDITOR.config-cfg-customConfig
          customConfig: '',
          // Enabling extra plugins, available in the standard-all preset: http://ckeditor.com/presets-all
          extraPlugins: 'autoembed,embedsemantic',
          // Make the editing area bigger than default.
          // height: 600,
          // An array of stylesheets to style the WYSIWYG area.
          // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
          contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/standard-all/contents.css'],
          // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
          format_tags: 'p;h2;h3;pre',
          // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
          removeDialogTabs: 'link:advanced',
          // Define the list of styles which should be available in the Styles dropdown list.
          // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
          // (and on your website so that it rendered in the same way).
          // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
          // that file, which means one HTTP request less (and a faster startup).
          // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_styles
          stylesSet: [
              /* Inline Styles */
              { name: 'Cite',		element: 'cite' },
              { name: 'Quotation',	element: 'q' },
              /* Object Styles */
              {
                  name: 'Code',
                  element: 'code',
                  styles: {
                      padding: '5px 10px',
                      background: '#eee',
                      border: '1px solid #ccc'
                  }
              },
              {
                  name: 'Compact table',
                  element: 'table',
                  attributes: {
                      cellpadding: '5',
                      cellspacing: '0',
                      border: '1',
                      bordercolor: '#ccc'
                  },
                  styles: {
                      'border-collapse': 'collapse'
                  }
              },
              { name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
              { name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } },
              /* Widget Styles */
              // Media embed
              { name: '240p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-240p' } },
              { name: '360p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-360p' } },
              { name: '480p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-480p' } },
              { name: '720p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-720p' } },
              { name: '1080p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-1080p' } }
          ]
      } );
  </script>

  </body>
</html>


