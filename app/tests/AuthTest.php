<?php

class AuthTest extends TestCase {

	public function testAuthFailure()
	{
        $response = $this->call('GET', 'api/v1');
        $this->assertEquals(403, json_decode($response->getContent())->code);
	}

    public function testCreateTestUser()
    {
        $user = array(
            'email'    => 'test@email.com',
            'password' => 'secret123'
        );
        $response = $this->call('POST', 'api/v1/user', $user);
        $this->assertEquals(201, json_decode($response->getContent())->code);
    }

    public function testCreateTestUserWithUsedEmailAddress()
    {
        $user = array(
            'email'    => 'test@email.com',
            'password' => 'secret123'
        );
        $response = $this->call('POST', 'api/v1/user', $user);
        $this->assertEquals(403, json_decode($response->getContent())->code);
    }

    public function testDeleteTestuser()
    {
        $response = $this->call('DELETE', 'api/v1/user/'.User::where('email', '=', 'test@email.com')->first()->id);
        $this->assertEquals(200, json_decode($response->getContent())->code);
    }

}
