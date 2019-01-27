<?php

namespace Simple\App\Controllers;

use Simple\Core\App;
use Simple\Core\Flash;
use Simple\App\Models\Post;

class PostsController extends Controller
{
  /**
   * Show all the posts
   * GET /posts
   * @return mixed
   * @throws \Exception
   */
  public function index()
  {

    $posts = App::get('database')->selectLastPublished('posts', Post::class, 3);
    $page = 'Articles';

    return $this->render('posts.index', compact('page', 'posts'));
  }

  /**
   * Show a given post
   * GET /posts/{id}
   * @param $id
   * @return mixed
   * @throws \Exception
   */
  public function show($id)
  {
    $post = App::get('database')->select('posts', $id, Post::class);
    if ($post) {
      $page = $post->title;
      return $this->render('posts.show', compact('page', 'post'));
    }

    return view('pages.error');
  }

  /**
   * Show the form to create a post
   * @return mixed
   * @throws \Exception
   */
  public function create()
  {
    // If the user is logged in
    if ((isset($_SESSION['username']) && isset($_SESSION['password']))
          && ($_SESSION['username'] === App::get('config')['admin']['username'])
          && (($_SESSION['password'] === App::get('config')['admin']['password'])))
    {
      // Allow the user to create a new post
      $page = 'New Post';
      return view('posts.create', compact('page'));
    }
    else {
      // Ask for credentials
      $page = 'Connexion';
      return view('admin.login', compact('page'));
    }
  }

  /**
   * Store a post into the database
   * POST /posts
   * @throws \Exception
   */
  public function store()
  {

    if(!isset($_POST['token'])){
      throw new \Exception('No token found!');
    }

    if(hash_equals($_POST['token'], $_SESSION['token']) === false){
      throw new \Exception('Token mismatch!');
    }


    $title = $_POST['title'];
    $content = $_POST['content'];
    $page = 'New Post';

    if ($_FILES['image']['size'] > 0) {

      $uploadErrors = resize(250, 500, 1000);

      if (count($uploadErrors)) {

        $_SESSION['errors'] = $uploadErrors;
        Flash::message('alert', 'The image could not be uploaded.');
        return view('posts.create', compact('page','title', 'content'));
      }

    }

    $errors = $this->validate([
        'title' => $title,
        'content' => $content
      ]);

    if (count($errors)) {

      $_SESSION['errors'] = $errors;
      Flash::message('alert', 'There are errors in the form.');
      return view('posts.create', compact('page','title', 'content'));

    } else {

      App::get('database')->insert('posts', [
        'title' => clean($title),
        'content' => $content,
        'image' => $_FILES["image"]["name"]
      ]);

      Flash::message('success', 'Article successfully created.');

      return redirect('admin-posts');
    }
  }

  /**
   * Show a form to edit a given post
   * GET /posts/{id}/edit
   * @param $id
   * @return mixed
   * @throws \Exception
   */
  public function edit($id)
  {
    // Check if the user is already logged in
    if ((isset($_SESSION['username']) && isset($_SESSION['password']))
          && ($_SESSION['username'] === App::get('config')['admin']['username'])
          && (($_SESSION['password'] === App::get('config')['admin']['password'])))
    {
      // Allow the user to edit a post
      $post = App::get('database')->select('posts', $id, Post::class);
      $page = 'Admin • '.$post->title;
      return view('posts.edit', compact('page', 'post'));
    }
    else {
      // Ask for credentials
      $page = 'Connexion';
      return view('admin.login', compact('page'));
    }
  }

  /**
   * Update a given post
   * @param $id
   * @throws \Exception
   */
  public function update($id)
  {

    if(!isset($_POST['token'])){
      throw new \Exception('No token found!');
    }

    if(hash_equals($_POST['token'], $_SESSION['token']) === false){
      throw new \Exception('Token mismatch!');
    }


    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

      $uploadErrors = resize(250, 500, 1000);

      if (count($uploadErrors)) {

        $_SESSION['errors'] = $uploadErrors;
        Flash::message('alert', 'The image could not be uploaded.');
        return redirect("posts/{$id}/edit");
      }

    }

    $title = $_POST['title'];
    $content = $_POST['content'];

    $errors = $this->validate([
        'title' => $title,
        'content' => $content
    ]);

    if (count($errors)) {

      $_SESSION['errors'] = $errors;

      Flash::message('alert', 'There are errors in the form.');

      return redirect("posts/{$id}/edit");

    } else {

      App::get('database')
        ->update('posts', [
          'title' => clean($title),
          'content' => $content
        ], $id);

      if (isset($_FILES['image'])) {
        App::get('database')
          ->update('posts', [
            'image' => $_FILES["image"]["name"]
          ], $id);
      }

      Flash::message('success', 'Article successfully updated.');

      return redirect('admin-posts');

    }
  }

  /**
   * Delete a given post
   * DELETE /features/{id}
   * @param $id
   * @throws \Exception
   */
  public function destroy($id)
  {

    if(!isset($_POST['token'])){
      throw new \Exception('No token found!');
    }

    if(hash_equals($_POST['token'], $_SESSION['token']) === false){
      throw new \Exception('Token mismatch!');
    }

    $post = App::get('database')->select('posts', $id, Post::class);

    if ($post->image) {
        // Remove the images associated
        unlink('../public/img/sm-'.$post->image);
        unlink('../public/img/'.$post->image);
        unlink('../public/img/lg-'.$post->image);
    }

    App::get('database')->delete('posts', $id);

    Flash::message('success', 'Article successfully deleted.');

    return redirect('admin-posts');
  }

  /**
   * Set the post as published in the database
   * @param $id
   * @throws \Exception
   */
  public function publish($id)
  {

    App::get('database')->publish('posts', $id);

    Flash::message('success', 'Article successfully published.');

    return redirect('admin-posts');

  }

  /**
   * Set the post as unpublished in the database
   * @param $id
   * @throws \Exception
   */
  public function unpublish($id)
  {

    App::get('database')->unpublish('posts', $id);

    Flash::message('success', 'Article successfully unpublished.');

    return redirect('admin-posts');

  }

  public function deleteImage($id)
  {

    $post = App::get('database')->select('posts', $id, Post::class);
    // Remove the images associated
    unlink('../public/img/sm-'.$post->image);
    unlink('../public/img/'.$post->image);
    unlink('../public/img/lg-'.$post->image);

    App::get('database')->deleteImage('posts', $id);

    Flash::message('success', 'Image successfully deleted.');

    return redirect("posts/{$id}/edit");

  }

}
