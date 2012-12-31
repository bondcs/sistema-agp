<?php

namespace Agp\AdminBundle\Form\Dummy;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Agp\AdminBundle\Form\Type\ProdutoType;

class ProdutoDummyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produtos', 'collection', array(
                        'type' => new ProdutoType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
             ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Dummy\ProdutoDummy'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_produtodummytype';
    }
}
