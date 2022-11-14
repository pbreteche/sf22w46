<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class PreferredLanguageListener
{
    /** @var string[] */
    private $enabledLocales;

    public function __construct(array $enabledLocales)
    {
        $this->enabledLocales = $enabledLocales;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $preferredLanguage = $request->getPreferredLanguage($this->enabledLocales);

        if ($preferredLanguage) {
            $request->setLocale($preferredLanguage);
        }
    }
}