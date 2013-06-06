<?php

namespace Pachanga\UsuarioBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;

class LoginListener
{
  private $router, $context;

  public function __construct($router, $context)
  {
    $this->router = $router;
    $this->context = $context;
  }

  public function onKernelRequest(GetResponseEvent $event)
  {

    if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
      // don't do anything if it's not the master request
      return;
    }
    $accountRouteName = "usuario_login";

    // authenticated (NON anonymous)
    if ($this->context->isGranted('IS_AUTHENTICATED_FULLY') ){
      $routeName = $event->getRequest()->get('_route');
      if ($routeName == $accountRouteName) {
        $url = $this->router->generate('portada');
        $event->setResponse(new RedirectResponse($url));
      }
    }
  }
}
