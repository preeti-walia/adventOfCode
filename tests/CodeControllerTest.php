<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CodeControllerTest extends WebTestCase
{
    public function testday4(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/code/day4');

        $this->assertResponseIsSuccessful();

      //  $this->assertSelectorTextContains('h1', 'valid');
    }
    public function testday9(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/code/day9');

        $this->assertResponseIsSuccessful();

      //  $this->assertSelectorTextContains('h1', 'valid');
    }
}
