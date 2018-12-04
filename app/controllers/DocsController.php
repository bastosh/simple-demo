<?php

namespace Simple\App\Controllers;

class DocsController extends Controller
{

  public function installation()
  {
    $page = 'Docs • Installation';
    return $this->render('docs.installation', compact('page'));
  }

  public function architecture()
  {
    $page = 'Docs • Architecture';
    return $this->render('docs.architecture', compact('page'));
  }

  public function basics()
  {
    $page = 'Docs • Basics';
    return $this->render('docs.basics', compact('page'));
  }

  public function views()
  {
    $page = 'Docs • Views';
    return $this->render('docs.views', compact('page'));
  }

  public function database()
  {
    $page = 'Docs • Database';
    return $this->render('docs.database', compact('page'));
  }

  public function security()
  {
    $page = 'Docs • Security';
    return $this->render('docs.security', compact('page'));
  }

  public function assets()
  {
    $page = 'Docs • Assets';
    return $this->render('docs.assets', compact('page'));
  }

}
