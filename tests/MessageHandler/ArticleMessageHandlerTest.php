<?php

namespace App\Tests\MessageHandler;

use App\Entity\Article;
use App\Message\ArticleMessage;
use App\MessageHandler\ArticleMessageHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleMessageHandlerTest extends KernelTestCase
{
    public function testInvoke()
    {
        $articleMessageHandler = static::getContainer()->get(ArticleMessageHandler::class);
        $articleMessage = new ArticleMessage((new Article())->setTitle('Test title'));

        $articleMessageHandler($articleMessage);
    }
}
