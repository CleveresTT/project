<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsEventListener(event: 'kernel.response', method: 'onKernelResponse')]
class CorsListener
{
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();

        if ($this->params->get('kernel.environment') === 'dev')
        {
            $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:5173');
        }
    }
}
