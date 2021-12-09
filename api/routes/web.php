<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {return 'use /api';});

$router->group(['prefix' => 'api'], function () use ($router){
    $router->post('/login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router){
        $router->post('/logout', 'AuthController@logout');
        $router->get('/', function (){return 'api documentation';});
        $router->get('/employees', 'EmployeeController@index');
        $router->get('/manager/{id}/employees', 'EmployeeController@managerEmployees');
        $router->get('/employees/{position}', 'EmployeeController@employeesByPosition');
        $router->put('/employee', 'EmployeeController@create');
        $router->post('/employee/{id}', 'EmployeeController@update');
        $router->delete('/employee/{id}', 'EmployeeController@delete');
    });
});
