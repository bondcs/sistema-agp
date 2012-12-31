<?php

namespace Agp\AdminBundle\Form\Dummy;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Agp\AdminBundle\Form\Type\ProdutoListaType;

class ProdutoListaDummyType extends AbstractType
{
    protected $options;
    
    public function __construct($options = null) {
        $this->options = $options;
    }

        public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produtoListas', 'collection', array(
                        'type' => $this->options["produtoListaType"],
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
             ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Dummy\ProdutoListaDummy'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_produtodummytype';
    }
}
