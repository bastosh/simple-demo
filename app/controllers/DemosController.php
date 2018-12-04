<?php

namespace Simple\App\Controllers;

use Simple\App\Models\Feature;
use Simple\Core\App;
use Simple\Core\Flash;
use Simple\App\Models\Demo;

class DemosController extends Controller
{
  /**
   * Show all the demos
   * GET /demos
   * @return mixed
   * @throws \Exception
   */
  public function index()
  {

    $demos = App::get('database')->selectAllPublished('demos', Demo::class);
    $page = 'Demos';

    return $this->render('demos.index', compact('page', 'demos'));
  }

  public function landing()
  {

    $features = App::get('database')->selectAllPublished('features', Feature::class);
    $page = 'Demo Landing';
    return $this->render('demos.landing', compact('page', 'features'));
  }

  /**
   * Show the form to create a demo
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
      // Allow the user to create a new demo
      $page = 'New Demo';
      return view('demos.create', compact('page'));
    }
    else {
      // Ask for credentials
      $page = 'Connexion';
      return view('admin.login', compact('page'));
    }
  }

  /**
   * Store a demo into the database
   * POST /demos
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
    $page = 'New demo';

    if ($_FILES['image']['size'] > 0) {

      $uploadErrors = upload();

      if (count($uploadErrors)) {

        $_SESSION['errors'] = $uploadErrors;
        Flash::message('alert', 'The image could not be uploaded.');
        return view('demos.create', compact('page','title'));
      }

    }

    $errors = $this->validate([
      'title' => $title,
      'image' => $_FILES["image"]["name"]
      ]
    );

    if (count($errors)) {

      $_SESSION['errors'] = $errors;

      Flash::message('alert', 'There are errors in the form.');

      return view('demos.create', compact('title','page'));

    } else {

      App::get('database')->insert('demos', [
        'title' => clean($title),
        'image' => $_FILES["image"]["name"]
      ]);

      Flash::message('success', 'Demo successfully created.');

      return redirect('admin-demos');
    }
  }

  /**
   * Show a form to edit a given demo
   * GET /demos/{id}/edit
   * @param $id
   * @return mixed
   * @throws \Exception
   */
  public function edit($id)
  {
    // If the user is logged in
    if ((isset($_SESSION['username']) && isset($_SESSION['password']))
          && ($_SESSION['username'] === App::get('config')['admin']['username'])
          && (($_SESSION['password'] === App::get('config')['admin']['password'])))
    {
      // Allow the user to edit the demo
      $demo = App::get('database')->select('demos', $id, Demo::class);
      $page = 'Edit';
      return view('demos.edit', compact('page', 'demo'));
    }
    else {
      // Ask for credentials
      $page = 'Connexion';
      return view('admin.login', compact('page'));
    }
  }

  /**
   * Update a given demo
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

    $title = $_POST['title'];

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

      $uploadErrors = upload();

      if (count($uploadErrors)) {

        $_SESSION['errors'] = $uploadErrors;
        Flash::message('alert', 'The image could not be uploaded.');
        return redirect("demos/{$id}/edit");
      }

    }

    $errors = $this->validate([
        'title' => $title,
        'image' => $_FILES["image"]["name"]
      ]
    );

    if (count($errors)) {

      $_SESSION['errors'] = $errors;

      Flash::message('alert', 'There are errors in the form.');

      return redirect("demos/{$id}/edit");

    } else {

      App::get('database')
        ->update('demos', [
          'title' => clean($_POST['title'])
        ], $id);

      if (isset($_FILES['image'])) {
        App::get('database')
          ->update('demos', [
            'image' => $_FILES["image"]["name"]
          ], $id);
      }

      Flash::message('success', 'Demo successfully updated.');

      return redirect('admin-demos');

    }
  }

  /**
   * Delete a given demo
   * DELETE /demos/{id}
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

    $demo = App::get('database')->select('demos', $id, Demo::class);
    // Remove the images associated
    unlink('../public/img/'.$demo->image);

    App::get('database')->delete('demos', $id);

    Flash::message('success', 'Demo successfully deleted.');

    return redirect('admin-demos');
  }

  /**
   * Set the demo as published in the database
   * @param $id
   * @throws \Exception
   */
  public function publish($id)
  {

    App::get('database')->publish('demos', $id);

    Flash::message('success', 'Demo successfully published.');

    return redirect('admin-demos');

  }

  /**
   * Set the demo as unpublished in the database
   * @param $id
   * @throws \Exception
   */
  public function unpublish($id)
  {

    App::get('database')->unpublish('demos', $id);

    Flash::message('success', 'Demo successfully unpublished.');

    return redirect('admin-demos');

  }

  public function deleteImage($id)
  {

    $demo = App::get('database')->select('demos', $id, Demo::class);
    // Remove the image associated
    unlink('../public/img/'.$demo->image);

    App::get('database')->deleteImage('demos', $id);

    Flash::message('success', 'Image successfully deleted.');

    return redirect("demos/{$id}/edit");

  }

}
