<?php
require_once 'vendor/autoload.php';
require_once 'controllers/ErrorController.php';
require_once 'controllers/IndexController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ProductosController.php';
require_once 'controllers/CategoriaController.php';
require_once 'config/parameters.php';
include 'models/Categoria.php';
include 'models/Productos.php';

session_start();

//indicamos que el directorio raiz sera la carpeta templates
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if (isset($_GET['controller'])) {
    $controller = ucfirst($_GET['controller']).'Controller'; //User controller

    if (class_exists($controller)) {
        $controller_object = new $controller();

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $controller_object->$action();
        }

    } else {
        ErrorController::_404();
    }
} else {
    $controller_default = controller_default;
    $action_default = action_default;
    $controller = new $controller_default();
    $controller::$action_default();
}
