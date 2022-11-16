<?php

namespace App\Tests\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AuthoringControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/article/new');

        $buttonNode = $crawler->selectButton('Enregistrer');

        $form = $buttonNode->form();
        $form['article[publishedAt]'] = '2022-11-14';
        $form['article[title]'] = 'Le titre du contenu';

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_UNPROCESSABLE_ENTITY);

        $form['article[body]'] = 'Le corps du contenu';
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}