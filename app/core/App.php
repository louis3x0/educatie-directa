<?php

use MyApp\Controller;
use MyApp\Router;

/**
 * App Class
 *
 * The main application class responsible for initializing and running the MVC application.
 */
class App {
    protected $router;

    /**
     * App constructor.
     * Initializes the router and defines application routes.
     */
    public function __construct() {
        $this->initRouter();
    }

    /**
     * Initializes and configures the router.
     */
    protected function initRouter() {
        // Initialize and configure your router
        $this->router = new Router();
        $this->defineRoutes();
    }

    /**
     * Defines application routes.
     */
    protected function defineRoutes() {
        // Home route 
        $this->router->addRoute('', 'HomeController@index');

        // Auth routes
        $this->router->addRoute('login', 'AuthController@login');
        $this->router->addRoute('register', 'AuthController@register');
        $this->router->addRoute('logout', 'AuthController@logout');

        // Profile routes
        $this->router->addRoute('profil', 'ProfileController@index');
        $this->router->addRoute('sesiuni', 'ProfileController@sessions');

        // Teacher routes
        $this->router->addRoute('{materie}/mediator-{nume}_{id}', 'TeacherController@index');
        $this->router->addRoute('cauta/{materie}/{locatie}', 'TeacherController@search');

        // Admin routes
        $this->router->addRoute('admin/login', 'AdminController@loginIndex');
        $this->router->addRoute('admin', 'AdminController@index');     

        $this->router->addRoute('admin/addMaterie/{nume}/{categorie}', 'AdminController@addMaterie');
        $this->router->addRoute('admin/addJudet/{nume}', 'AdminController@addJudet');

        $this->router->addRoute('admin/delete/{id}', 'AdminController@delete');   
        $this->router->addRoute('admin/deleteMaterie/{id}', 'AdminController@deleteMaterie');
        $this->router->addRoute('admin/deleteJudet/{id}', 'AdminController@deleteJudet');

        $this->router->addRoute('updateProfilePicture/{id}', 'ProfileController@updateProfilePicture');
    }

    /**
     * Runs the application.
     */
    public function run() {
        $path = trim($_SERVER['REQUEST_URI'], '/');
        $routeInfo = $this->router->route($path);

        if ($routeInfo) {
            $controllerAction = $routeInfo['controller'];
            $params = $routeInfo['params']; // Extract the parameters
    
            if (strpos($controllerAction, '@') !== false) {
                list($controllerName, $action) = explode('@', $controllerAction);
                require_once '../app/controllers/' . ucfirst($controllerName) . '.php';
    
                $controllerClassName = ucfirst($controllerName);
                $controllerInstance = new $controllerClassName();
    
                // Pass the parameters to the action method
                call_user_func_array([$controllerInstance, $action], $params);
            } else {
                // Handle the error - controller action string is not in the expected format
                $this->handleError();
            }
        } else {
            // Handle 404 or redirect to a default page
            $this->handle404();
        }
    }
    
    /**
     * Handles 404 errors.
     */
    protected function handle404() {
        // Handle 404 - You can show a custom 404 page or redirect to a default page
        $controller = new Controller();
        $controller->view('404');
    }

    protected function handleError() {
        // Handle the error - You can show a custom error page or redirect to a default page
        $controller = new Controller();
        $controller->view('error');
    }
    
}
