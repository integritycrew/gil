<?php

class OrganizationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		if ( ! Sentry::check())
        {
            Return Response::json(array(
                'error' => true,
                'message' => "Login required",
                'status' => "401"
            ));
        } else {
            $user = Sentry::getUser();
        }
        
        $validator = Validator::make(
            Input::only('name'),
            array(
                'name'    => 'required|unique:organization,name,'.$user->getId(),
            )
        );
        
        if( $validator->fails() ) {
            return Response::json(array(
                'error' => true,
                'message' => $validator->messages(),
                'status' => '403'
            ));
        }
        
        
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
