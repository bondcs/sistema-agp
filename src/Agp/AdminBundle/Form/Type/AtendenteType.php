<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AtendenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', array(
                  'label' => "Nome:",
                  'attr' => array('placeholder' => 'Nome')
            ))
            ->add('senha', 'password', array(
                  'label' => "Senha: (opcional)",  
                  'attr' => array('placeholder' => 'Senha')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Atendente'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_atendentetype';
    }
}
