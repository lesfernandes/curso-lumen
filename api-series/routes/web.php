<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Log;
use Monolog\Handler\TelegramBotHandler;

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

/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () {
    Log::debug('debug log');
    Log::info('info log');
    Log::notice('notice log');
    Log::warning('warning log');
    Log::error('error log');
    Log::critical('critical log');
    Log::alert('alert log');
    Log::emergency('emergency log');
});

$router->group(['prefix' => 'api', 'middleware' => 'autenticador'], function() use ($router) {
    $router->group(['prefix' => 'series'], function() use ($router) {
        $router->post('', 'SeriesController@store');
        $router->get('', 'SeriesController@index');
        $router->get('{id}', 'SeriesController@show');
        $router->put('{id}', 'SeriesController@update');
        $router->delete('{id}', 'SeriesController@destroy');

        $router->get('{serieId}/episodios', 'EpisodiosController@buscaPorSerie');
    });

    $router->group(['prefix' => 'episodios'], function() use ($router) {
        $router->post('', 'EpisodiosController@store');
        $router->get('', 'EpisodiosController@index');
        $router->get('{id}', 'EpisodiosController@show');
        $router->put('{id}', 'EpisodiosController@update');
        $router->delete('{id}', 'EpisodiosController@destroy');
    });
});

$router->post('api/login', 'TokenController@gerarToken');
