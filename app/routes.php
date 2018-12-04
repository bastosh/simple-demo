<?php

// Routes for the static pages
$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');

// Routes for the resource Feature
$router->get('features', 'FeaturesController@index');
$router->get('features/create', 'FeaturesController@create');
$router->get('features/{id}', 'FeaturesController@show');
$router->post('features', 'FeaturesController@store');
$router->get('features/{id}/edit', 'FeaturesController@edit');
$router->put('features/{id}', 'FeaturesController@update');
$router->delete('features/{id}', 'FeaturesController@destroy');
$router->put('features/{id}/publish', 'FeaturesController@publish');
$router->put('features/{id}/unpublish', 'FeaturesController@unpublish');

// Routes for the resource Post
$router->get('posts', 'PostsController@index');
$router->get('posts/create', 'PostsController@create');
$router->get('posts/{id}', 'PostsController@show');
$router->post('posts', 'PostsController@store');
$router->get('posts/{id}/edit', 'PostsController@edit');
$router->put('posts/{id}', 'PostsController@update');
$router->delete('posts/{id}', 'PostsController@destroy');
$router->put('posts/{id}/publish', 'PostsController@publish');
$router->put('posts/{id}/unpublish', 'PostsController@unpublish');
$router->put('posts/{id}/image', 'PostsController@deleteImage');

// Routes for the demos
$router->get('demos', 'DemosController@index');
$router->get('demos/landing', 'DemosController@landing');
$router->get('demos/create', 'DemosController@create');
$router->get('demos/{id}', 'DemosController@show');
$router->post('demos', 'DemosController@store');
$router->get('demos/{id}/edit', 'DemosController@edit');
$router->put('demos/{id}', 'DemosController@update');
$router->delete('demos/{id}', 'DemosController@destroy');
$router->put('demos/{id}/publish', 'DemosController@publish');
$router->put('demos/{id}/unpublish', 'DemosController@unpublish');
$router->put('demos/{id}/image', 'DemosController@deleteImage');

// Routes for the docs
$router->get('docs', 'DocsController@installation');
$router->get('docs/installation', 'DocsController@installation');
$router->get('docs/basics', 'DocsController@basics');
$router->get('docs/architecture', 'DocsController@architecture');
$router->get('docs/views', 'DocsController@views');
$router->get('docs/database', 'DocsController@database');
$router->get('docs/security', 'DocsController@security');
$router->get('docs/assets', 'DocsController@assets');

// Routes for the administration
$router->get('admin', 'AdminController@dashboard');
$router->post('admin', 'AdminController@dashboard');
$router->get('logout', 'AdminController@logout');
$router->get('admin-features', 'AdminController@features');
$router->get('admin-features/{id}', 'AdminController@showFeature');
$router->get('admin-posts', 'AdminController@posts');
$router->get('admin-posts/{id}', 'AdminController@showPost');
$router->get('admin-demos', 'AdminController@demos');
$router->get('admin-demos/{id}', 'AdminController@showDemo');
