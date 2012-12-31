<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Agp\AdminBundle\Entity\Terminal;

class TerminalType extends AbstractType
{
    protected $options;
    protected $container;


    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->options = array();
    }
    
    public function setOptions($options){
        $this->options = array_merge($this->options, $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('noSerie', 'text', array(
                  'label' => "Nº de série",  
                  'attr' => array('placeholder' => 'Número de série')
            ))
            ->add('fabricante', 'choice', array(
                  'label' => "Frabricante", 
                  'attr' => array('placeholder' => 'Frabricante'),
                  'choices' => Terminal::getFrabricanteList()
            ))
            ->add('versao', 'choice', array(
                  'label' => "Versão", 
                  'attr' => array('placeholder' => 'Versão'),
                  'choices' => Terminal::getVersaoList()
            ))
            ->add('situacao', 'choice', array(
                  'label' => "Situação", 
                  'attr' => array('placeholder' => 'Situação'),
                  'choices' => Terminal::getSituacaoList()
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Terminal'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_terminaltype';
    }
}
