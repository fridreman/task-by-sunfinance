<?php

namespace App\Tests;

class AuthenticationTest extends AbstractTest
{
    public function testAuthentication(): void
    {
        parent::createClientWithCredentials()->request('GET', '/api/notifications?page=1');

        $this->assertResponseIsSuccessful();

        parent::createClient()->request('GET', '/api/notifications?page=1');

        $this->assertResponseStatusCodeSame(401);
    }
}