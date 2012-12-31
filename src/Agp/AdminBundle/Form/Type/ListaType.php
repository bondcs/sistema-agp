<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', array(
                  'label' => "Nome",
                  'attr' => array('placeholder' => 'Nome')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\ListaPreco'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_listatype';
    }
}
