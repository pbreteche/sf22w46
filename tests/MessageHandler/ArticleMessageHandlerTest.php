<?php

namespace App\Tests\MessageHandler;

use App\Entity\Article;
use App\Message\ArticleMessage;
use App\MessageHandler\ArticleMessageHandler;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleMessageHandlerTest extends KernelTestCase
{
    public function testInvoke()
    {
//        $logger = $this->createMock(LoggerInterface::class);
//        $logger->expects(self::once())
//            ->method('info')
//            ->with('Nouvel article : Test title')
//        ;
//
//        static::getContainer()->set(LoggerInterface::class, $logger);

        $articleMessageHandler = static::getContainer()->get(ArticleMessageHandler::class);
        $articleMessage = new ArticleMessage((new Article())->setTitle('Test title'));

        $articleMessageHandler($articleMessage);
    }
}
