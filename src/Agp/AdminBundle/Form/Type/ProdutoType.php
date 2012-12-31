<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProdutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codProduto', 'hidden')
            ->add('nome', 'text', array(
                  'label' => "Nome",
                  'attr' => array('placeholder' => 'Nome')
            ))
            ->add('vlrBase', 'text', array(
                  'label' => "Valor",  
                  'attr' => array('placeholder' => 'Valor',
                                  'class' => 'moeda')
            ))
            ->add('qtdeMinimo', 'integer', array(
                  'label' => "Quantidade Mínimo", 
                  'attr' => array('placeholder' => 'Quantidade Mínimo')
            ))
            ->add('qtdeAtual', 'integer', array(
                  'label' => "Quantidade Atual",
                  'attr' => array('placeholder' => 'Quantidade Atual')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Produto'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_produtotype';
    }
}
