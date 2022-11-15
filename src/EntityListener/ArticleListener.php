<?php

namespace App\EntityListener;

use App\Entity\Article;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;

class ArticleListener
{
    /** @var MailerInterface */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
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
    }
}
