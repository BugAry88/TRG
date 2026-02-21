<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/img/(:segment)/(:segment)', 'ImageController::serve/$1/$2');
$routes->get('/configurator', 'Configurator::index');
$routes->get('/test', 'Home::test');
$routes->post('/cart/add', 'CartController::addConfiguration');
$routes->get('/cart/summary', 'CartController::summary');
$routes->get('/cart/clear', 'CartController::clear');

// Admin routes
$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/login', 'AdminController::login');
$routes->post('/admin/login', 'AdminController::login');
$routes->get('/admin/logout', 'AdminController::logout');

// Levels management
$routes->get('/admin/levels', 'AdminController::levels');
$routes->get('/admin/create-level', 'AdminController::createLevel');
$routes->post('/admin/create-level', 'AdminController::createLevel');
$routes->get('/admin/edit-level/(:num)', 'AdminController::editLevel/$1');
$routes->post('/admin/edit-level/(:num)', 'AdminController::editLevel/$1');
$routes->get('/admin/delete-level/(:num)', 'AdminController::deleteLevel/$1');

// Categories management
$routes->get('/admin/categories', 'AdminController::categories');
$routes->get('/admin/create-category', 'AdminController::createCategory');
$routes->post('/admin/create-category', 'AdminController::createCategory');
$routes->get('/admin/edit-category/(:num)', 'AdminController::editCategory/$1');
$routes->post('/admin/edit-category/(:num)', 'AdminController::editCategory/$1');
$routes->get('/admin/delete-category/(:num)', 'AdminController::deleteCategory/$1');

// Components management
$routes->get('/admin/components', 'AdminController::components');
$routes->get('/admin/create-component', 'AdminController::createComponent');
$routes->post('/admin/create-component', 'AdminController::createComponent');
$routes->get('/admin/edit-component/(:num)', 'AdminController::editComponent/$1');
$routes->post('/admin/edit-component/(:num)', 'AdminController::editComponent/$1');
$routes->get('/admin/delete-component/(:num)', 'AdminController::deleteComponent/$1');

// Customer Auth routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/account', 'AuthController::account');
$routes->post('/account/update', 'AuthController::updateProfile');

// Checkout routes
$routes->get('/checkout', 'CheckoutController::index');
$routes->post('/checkout/place-order', 'CheckoutController::placeOrder');
$routes->get('/checkout/success', 'CheckoutController::success');

// Orders management
$routes->get('/admin/orders', 'AdminController::orders');
$routes->get('/admin/orders/(:num)', 'AdminController::viewOrder/$1');
$routes->post('/admin/orders/(:num)/status', 'AdminController::updateOrderStatus/$1');

// Compatibility management
$routes->get('/admin/compatibility', 'AdminController::compatibility');
$routes->post('/admin/add-compatibility', 'AdminController::addCompatibility');
$routes->get('/admin/remove-compatibility/(:num)', 'AdminController::removeCompatibility/$1');
