<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class SessionLocaleSubscriber implements EventSubscriberInterface
{
    /**
     * @var string[]
     */
    private $enabledLocales;

    public function __construct(array $enabledLocales)
    {
        $this->enabledLocales = $enabledLocales;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if ($newLocale = $request->query->get('_locale')) {
            if (in_array($newLocale, $this->enabledLocales)) {
                $request->getSession()->set('_locale', $newLocale);
            }
        }

        $sessionLocale = $request->getSession()->get('_locale');
        if ($sessionLocale) {
            $request->setLocale($sessionLocale);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.request' => ['onKernelRequest', 48],
        ];
    }
}
