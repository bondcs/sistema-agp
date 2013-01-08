<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Agp\AdminBundle\Entity\EntradaProduto;
use Doctrine\ORM\EntityRepository;

class EntradaProdutoType extends AbstractType
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
        $context = $this->container->get("security.context");
        $builder
            ->add('vlrCusto', 'text', array(
                  'label' => "Custo:",  
                  'attr' => array('placeholder' => 'Custo', 'class' => 'moeda')
            ))
            ->add('qtde', 'integer', array(
                  'label' => "Quantidade:",  
                  'attr' => array('placeholder' => 'Quantidade')
            ))
            ->add('fornecedor', 'entity', array(
                  'empty_value' => 'Selecione um fornecedor',
                  'label' => "Fornecedor:",
                  'attr' => array('placeholder' => 'Fornecedor', 'class' => 'chzn-select fornecedor'),
                  'class' => "AgpAdminBundle:Fornecedor",
                  'property' => 'razaoSocial',
                  'query_builder' => function(EntityRepository $er) use ($context){
                       return $er->createQueryBuilder('f')
                           ->where("f.empresa = :empresa")
                           ->setParameters(array("empresa" => $context->getToken()->getUser()->getEmpresa()));
                   }
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\EntradaProduto'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_entradaProdutotype';
    }
}
