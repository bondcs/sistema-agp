<?php

namespace Agp\AdminBundle\Form\EventListerner;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TerminalEmpresaListerner implements EventSubscriberInterface
{
    private $factory;
    protected $container;
    protected $terminal;

    public function __construct(FormFactoryInterface $factory, $container, $terminal)
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->terminal = $terminal;
    }

    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::POST_BIND => 'postBindData');
    }

    public function postBindData(DataEvent $event)
    {
//        $data = $event->getData();
//        $form = $event->getForm();
//        $repository = $this->container->get("doctrine")->getEntityManager()->getRepository("AgpAdminBundle:TerminalEmpresa");
//       
//        // check if the product object is "new"
//        if (!$data->getId()) {
//            if ($repository->getCountTerminalAtivo($this->terminal) > 0){
//                $form->addError(new FormError("Este terminal já possui um vínculo ativo, desative primeiro."));
//            }
//        }
    }
}

?>
