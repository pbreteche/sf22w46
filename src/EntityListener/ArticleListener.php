<?php

namespace App\EntityListener;

use App\Entity\Article;
use App\Message\ArticleMessage;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;

class ArticleListener
{
    /** @var MailerInterface */
    private $mailer;
    /** @var MessageBusInterface */
    private $bus;

    public function __construct(
        MailerInterface $mailer,
        MessageBusInterface $bus
    ) {
        $this->mailer = $mailer;
        $this->bus = $bus;
    }

    public function postPersist(Article $article)
    {
        $message = (new Email())
            ->to('recipient@example.com')
            ->from('noreply@example.com')
            ->subject('My subject')
            ->text('some text '.$article->getTitle())
        ;

        $this->mailer->send($message);

        $this->bus->dispatch(new ArticleMessage($article));
    }
}
