<?php

namespace Simple\App\Controllers;

use Simple\Core\App;
use Simple\Core\Flash;
use Simple\App\Models\Feature;

class FeaturesController extends Controller
{
  /**
   * Show all the features
   * GET /features
   * @return mixed
   * @throws \Exception
   */
  public function index()
  {

    $features = App::get('database')->selectAllPublished('features', Feature::class);
    $page = 'Features';

    return $this->render('features.index', compact('page', 'features'));
  }

  /**
   * Show a given feature
   * GET /features/{id}
   * @param $id
   * @return mixed
   * @throws \Exception
   */
  public function show($id)
  {
    $feature = App::get('database')->select('features', $id, Feature::class);
    if ($feature) {
      $page = $feature->title;
      return $this->render('features.show', compact('page', 'feature'));
    }

    return view('pages.error');
  }

  /**
   * Show the form to create a feature
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
      // Allow the user to create a new feature
      $page = 'New Feature';
      return view('features.create', compact('page'));
    }
    else {
      // Ask for credentials
      $page = 'Connexion';
      return view('admin.login', compact('page'));
    }
  }

  /**
   * Store a feature into the database
   * POST /features
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
    $description = $_POST['description'];
    $page = 'New feature';

    $errors = $this->validate([
      'title' => $title,
      'description' => $description]
    );

    if (count($errors)) {

      $_SESSION['errors'] = $errors;

      Flash::message('alert', 'There are errors in the form.');

      return view('features.create', compact('title', 'description', 'page'));

    } else {

      App::get('database')->insert('features', [
        'title' => clean($title),
        'description' => clean($description)
      ]);

      Flash::message('success', 'Feature successfully created.');

      return redirect('admin-features');
    }
  }

  /**
   * Show a form to edit a given feature
   * GET /features/{id}/edit
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
      // Allow the user to edit the feature
      $feature = App::get('database')->select('features', $id, Feature::class);
      $page = 'Edit';
      return view('features.edit', compact('page', 'feature'));
    }
    else {
      // Ask for credentials
      $page = 'Connexion';
      return view('admin.login', compact('page'));
    }
  }

  /**
   * Update a given feature
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
    $description = $_POST['description'];

    $errors = $this->validate([
        'title' => $title,
        'description' => $description]
    );

    if (count($errors)) {

      $_SESSION['errors'] = $errors;

      Flash::message('alert', 'There are errors in the form.');

      return redirect("features/{$id}/edit");

    } else {

      App::get('database')
        ->update('features', [
          'title' => clean($_POST['title']),
          'description' => clean($_POST['description'])
        ], $id);

      Flash::message('success', 'Feature successfully updated.');

      return redirect('admin-features');

    }
  }

  /**
   * Delete a given feature
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

    App::get('database')->delete('features', $id);

    Flash::message('success', 'Feature successfully deleted.');

    return redirect('admin-features');
  }

  /**
   * Set the feature as published in the database
   * @param $id
   * @throws \Exception
   */
  public function publish($id)
  {

    App::get('database')->publish('features', $id);

    Flash::message('success', 'Feature successfully published.');

    return redirect('admin-features');

  }

  /**
   * Set the feature as unpublished in the database
   * @param $id
   * @throws \Exception
   */
  public function unpublish($id)
  {

    App::get('database')->unpublish('features', $id);

    Flash::message('success', 'Feature successfully unpublished.');

    return redirect('admin-features');

  }

}
