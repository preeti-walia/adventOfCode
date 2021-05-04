<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CodeControllerTest extends WebTestCase
{
    public function testday4a(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/code/day4/part1');

        $this->assertResponseIsSuccessful();

      //  $this->assertSelectorTextContains('h1', 'valid');
    }
    public function testday4b(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/code/day4/part2');

        $this->assertResponseIsSuccessful();

      //  $this->assertSelectorTextContains('h1', 'valid');
    }

    public function testday9a(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/code/day9/part1');

        $this->assertResponseIsSuccessful();

      //  $this->assertSelectorTextContains('h1', 'valid');
    }

    public function testday9b(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/code/day9/part2');

        $this->assertResponseIsSuccessful();

      //  $this->assertSelectorTextContains('h1', 'valid');
    }
}
