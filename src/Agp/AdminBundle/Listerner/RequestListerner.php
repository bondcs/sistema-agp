<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Listerner;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
/**
 * Description of RequestListernet
 *
 * @author bondcs
 */
class RequestListerner {
 
     public function onCoreException(GetResponseForExceptionEvent $event){

        $exception = $event->getException();
        $request = $event->getRequest();

        if ($request->isXmlHttpRequest()) {
            if ($exception instanceof AuthenticationException || $exception instanceof AccessDeniedException || $exception instanceof AuthenticationCredentialsNotFoundException) {
                 $event->setResponse(new Response('', 403));
            }

        }

    }
}

?>
