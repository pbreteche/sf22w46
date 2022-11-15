<?php

namespace App\MessageHandler;

use App\Message\ArticleMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ArticleMessageHandler implements MessageHandlerInterface
{
    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ArticleMessage $message)
    {
        $this->logger->info('Nouvel article : '.$message->getArticle()->getTitle());
    }
}
