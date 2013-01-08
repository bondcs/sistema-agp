<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', array(
                  'label' => "Nome:",
                  'attr' => array('placeholder' => 'Nome')
            ))
            ->add('dtInicio', 'date', array(
                        'attr' => array("class" => "datepicker"),
                        'label' => 'Início:',
                        'input' => 'datetime',
                        'widget' => 'single_text',
                        'required' => true,
                        'format' => 'dd/MM/yyyy'
             ))
            ->add('dtTermino', 'date', array(
                        'attr' => array("class" => "datepicker"),
                        'label' => 'Término:',
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
            'data_class' => 'Agp\AdminBundle\Entity\Evento',
            'error_mapping' => array(
                'dateLegal' => 'dtInicio',
            ),
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_eventotype';
    }
}
