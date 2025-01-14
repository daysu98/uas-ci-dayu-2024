<?php
 namespace Config;
 $routes = Services::routes();
 $routes->setDefaultNamespace('App\Controllers');
 $routes->setDefaultController('Home');
 $routes->setDefaultMethod('index');
 $routes->setTranslateURIDashes(false);
 $routes->set404Override();
 $routes->setAutoRoute(true);
 
 // Landing Page
 $routes->get('/', 'Home::index');
 
 // Authentication
 $routes->get('/login', 'Auth::login');
 $routes->post('/login', 'Auth::login');
 $routes->get('/register', 'Auth::register');
 $routes->post('/register-post', 'Auth::register');
 
 // Tasks
 $routes->get('/tasks', 'Tasks::index');
 $routes->get('/tasks/add', 'Tasks::add');
 $routes->post('/tasks/add', 'Tasks::add');
 $routes->get('/tasks/edit/(:num)', 'Tasks::edit/$1');
 $routes->post('/tasks/update/(:num)', 'Tasks::update/$1');


 $routes->get('/tasks/delete/(:num)', 'Tasks::delete/$1');
 
 // Profile
 $routes->get('/profile/edit', 'Profile::edit');
 $routes->post('/profile/edit', 'Profile::edit');
 
 ?>
