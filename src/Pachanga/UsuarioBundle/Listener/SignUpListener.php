<?php

namespace Pachanga\UsuarioBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Pachanga\UsuarioBundle\Entity\Usuario;

class SignUpListener
{
  public function __construct()
  {
  }

  public function afterSignUp(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();
    $session = $event->getRequest()->getSession();

    if ($entity instanceof Usuario){
      $session->setFlash('info', '¡Enhorabuena! '.$entity->getNombre().'te has registrado correctamente en Pachanga');
    }
  }
}
