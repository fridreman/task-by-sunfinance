<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use App\DataFixtures\AuthFixtures;
use Doctrine\ORM\EntityManagerInterface;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

abstract class AbstractTest extends ApiTestCase
{
    private string $token;
    protected AbstractDatabaseTool $databaseTool;
    protected EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    protected function createClientWithCredentials(): Client
    {
        return $this->createClient([], ['headers' => ['authorization' => 'Bearer ' . $this->getToken()]]);
    }

    private function getToken(): string
    {
        if (isset($this->token) && $this->token) {
            return $this->token;
        }

        $this->databaseTool->loadFixtures([
            AuthFixtures::class,
        ]);

        $response = static::createClient()
            ->request(
                'POST',
                '/authentication_token',
                [
                    'json' => [
                        'email' => 'johndoe@example.com',
                        'password' => 'apassword',
                    ],
                    'headers' => ["Content-Type" => "application/json"]
                ]
            );

        $this->assertResponseIsSuccessful();

        $data = json_decode($response->getContent());
        $this->token = $data->token;

        return $this->token;
    }
}