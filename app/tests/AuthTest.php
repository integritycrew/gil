<?php

class AuthTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testAuthFailure()
	{
        $response = $this->call('GET', 'api/v1');
        $this->assertEquals('Protected resource', $response->getContent());
	}

}
