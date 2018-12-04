<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $page; ?></title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
      }

      main {
        flex: 1;
      }
    </style>
  </head>

  <body>

    <?php include('nav.php'); ?>

    <main class="grid-y align-center">
