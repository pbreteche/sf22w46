<?php

namespace App\Tests\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $mainTitle = $crawler->filter('h1')->text();
        $this->assertEquals('Nous sommes dans le back office', $mainTitle);

        $this->assertSelectorTextContains('h1', 'Nous sommes dans le back office');
    }
}