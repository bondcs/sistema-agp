<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Agp\AdminBundle\Entity\TerminalEmpresa;
use Agp\AdminBundle\Form\EventListerner\TerminalEmpresaListerner;
use Symfony\Component\Form\FormInterface;

class TerminalEmpresaType extends AbstractType
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
            ->add('empresa', 'entity', array(
                  'empty_value' => 'Selecione um empresa',
                  'label' => "Empresa",  
                  'attr' => array('class' => 'chzn-select'),
                  'class' => 'AgpAdminBundle:Empresa',
                  'property' => 'fantasia',
            ))
            ->add('liberacao', 'text', array(
                  'label' => "Liberação", 
                  'attr' => array('placeholder' => 'Liberação')
            ))
            ->add('tipoVinculo', 'choice', array(
                  'label' => 'Tipo de vínculo',
                  'attr' => array('class' => 'vinculo'),
                  'choices' => TerminalEmpresa::getTipoVinculoList(),
            ))
            ->add('bloquear', 'choice', array(
                  'label' => "Bloqueio", 
                  'choices' => TerminalEmpresa::getBloqueioList()
            ))
            ->add('dtInicio', 'date', array(
                        'attr' => array("class" => "datepicker"),
                        'label' => 'Início',
                        'input' => 'datetime',
                        'widget' => 'single_text',
                        'required' => true,
                        'format' => 'dd/MM/yyyy'
             ))
            ->add('dtTermino', 'date', array(
                        'attr' => array("class" => "datepicker"),
                        'label' => 'Término',
                        'input' => 'datetime',
                        'widget' => 'single_text',
                        'required' => true,
                        'format' => 'dd/MM/yyyy'
            ))
        ;
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\TerminalEmpresa',
            'validation_groups' => function(FormInterface $form) {
                $data = $form->getData();
                if ($data->getTipoVinculo() == TerminalEmpresa::TIPO_TEMPORARIO) {
                    return array("Default", "temporario", "empresa");
                } else {
                    return array("Default", "empresa");
                }
            },
            'error_mapping' => array(
                'dateLegal' => 'dtInicio',
            ),
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_terminalEmpresatype';
    }
}
