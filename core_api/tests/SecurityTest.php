<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SecurityTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->find(1);

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        $this->assertResponseHeaderSame('Content-Type', 'application/json');


        // test e.g. the profile page
//        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('a', '');
    }
}
