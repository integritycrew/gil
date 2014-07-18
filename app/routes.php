<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('create', function()
{
    $user = Sentry::createUser(array(
        'email'     => 'gil@integrity-crew.com',
        'password'  => 'secret',
        'activated' => true,
    ));

    return 'User Created';
});

Route::post('login',function()
{
    try
    {
        $user = Sentry::authenticate(Input::all(), false);

        $token = hash('sha256',Str::random(10),false);

        $user->api_token = $token;

        $user->save();

        return Response::json(array('token' => $token, 'user' => $user->toArray()));
    }
    catch(Exception $e)
    {
        App::abort(404,$e->getMessage());
    }
});

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.token'), function() {

    Route::get('/', function() {
        return "Protected resource";
    });

});