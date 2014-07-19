<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        App::abort(404,'Not Found');
	}

    /**
     * Trying to login user.
     *
     * @return Response
     */
    public function login()
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
            return Response::json(
                array(
                    'error'   => true,
                    'message' => $e->getMessage(),
                    'code'    => 404
                )
            );
        }
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        App::abort(404,'Not Found');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(
            Input::all(),
            array(
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:8'
            )
        );

        if ($validator->fails())
        {
            return Response::json(
                array(
                    'error'   => true,
                    'message' => $validator->messages(),
                    'code'    => 403
                )
            );
        }

        $user = Sentry::createUser(
            array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password'),
                'activated' => true,
            )
        );

        return Response::json(
            array(
                'error'   => false,
                'message' => 'Account for '.$user->email.' was created',
                'code'    => 201
            )
        );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        App::abort(404,'Not Found');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        App::abort(404,'Not Found');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        App::abort(404,'Not Found');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $validator = Validator::make(
            array('id' => $id),
            array('id' => 'required|integer')
        );

        if ($validator->fails())
        {
            return Response::json(
                array(
                    'error'   => true,
                    'message' => $validator->messages(),
                    'code'    => 400
                )
            );
        }

        $user = User::where('email', '=', 'test@email.com')->first();
        $email = $user->email;
        $user->delete();

        return Response::json(
            array(
                'error'   => false,
                'message' => 'Account for '.$email.' was deleted',
                'code'    => 200
            )
        );
	}


}
