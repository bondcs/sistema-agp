<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Agp\AdminBundle\Entity\Empresa;

class EmpresaType extends AbstractType
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
                  'label' => "Razão social",  
                  'attr' => array('placeholder' => 'Razão social')
            ))
            ->add('fantasia', 'text', array(
                  'label' => "Fantasia",  
                  'attr' => array('placeholder' => 'Fantasia')
            ))
            ->add('cnpj', 'text', array(
                  'label' => "Cnpj",  
                  'attr' => array('placeholder' => 'Cnpj', 'class' => 'cnpj')
            ))
            ->add('ie', 'text', array(
                  'label' => "Ie",  
                  'attr' => array('placeholder' => 'Ie', 'class' => 'ie')
            ))
            ->add('im', 'text', array(
                  'label' => "Im",  
                  'attr' => array('placeholder' => 'Im', 'class' => 'im')
            ))
            ->add('endereco', 'text', array(
                  'label' => "Endereço",  
                  'attr' => array('placeholder' => 'Endereço')
            ))
            ->add('complemento', 'text', array(
                  'label' => "Complemento",  
                  'attr' => array('placeholder' => 'Complemento')
            ))
            ->add('cep', 'text', array(
                  'label' => "Cep",  
                  'attr' => array('placeholder' => 'Cep', 'class' => 'cep')
            ))
            ->add('bairro', 'text', array(
                  'label' => "Bairro",  
                  'attr' => array('placeholder' => 'Bairro')
            ))
            ->add('cidade', 'entity', array(
                  'label' => "Cidade", 
                  'class' => 'AgpAdminBundle:Cidade',
                  'property' => 'nome',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Empresa'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_empresatype';
    }
}
