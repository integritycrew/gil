<?php

class AuthTest extends TestCase {

    private $userData = array(
        'email'    => 'test@email.com',
        'password' => 'secret123'
    );

	public function testAuthFailure()
	{
        $response = $this->call('GET', 'api/v1');
        $this->assertEquals(403, json_decode($response->getContent())->code);
	}

    public function testCreateTestUser()
    {
        $response = $this->call('POST', 'api/v1/user', $this->userData);
        $this->assertEquals(201, json_decode($response->getContent())->code);
    }

    public function testCreateTestUserWithUsedEmailAddress()
    {
        $response = $this->call('POST', 'api/v1/user', $this->userData);
        $this->assertEquals(403, json_decode($response->getContent())->code);
    }

    public function testDeleteTestuser()
    {
        $response = $this->call('DELETE', 'api/v1/user/'.User::where('email', '=', $this->userData['email'])->first()->id);
        $this->assertEquals(200, json_decode($response->getContent())->code);
    }

}

/*

Mam tabele 'playlists', 'users', ''

 */
