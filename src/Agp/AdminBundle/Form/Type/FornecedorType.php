<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FornecedorType extends AbstractType
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
            ->add('razaoSocial', 'text', array(
                  'label' => "Razão social:",  
                  'attr' => array('placeholder' => 'Razão social')
            ))
            ->add('fantasia', 'text', array(
                  'label' => "Fantasia: (opcional)",  
                  'attr' => array('placeholder' => 'Fantasia')
            ))
            ->add('telefone', 'text', array(
                  'label' => "Telefone: (opcional)",  
                  'attr' => array('placeholder' => 'Telefone', 'class' => 'telefone')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Fornecedor'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_fornecedortype';
    }
}
