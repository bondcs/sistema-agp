<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProdutoListaType extends AbstractType
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
        $optionsHandler = $this->options;
        $builder
            ->add("codProdutoListaPreco", "hidden")
            ->add('produto', 'entity', array(
                  'empty_value' => 'Selecione um produto',
                  'label' => "Nome",
                  'attr' => array('placeholder' => 'Nome', 'class' => 'chzn-select'),
                  'class' => "AgpAdminBundle:Produto",
                  'query_builder' => function(EntityRepository $er) use ($context, $optionsHandler){
                       return $er->createQueryBuilder('p')
                           ->Where("p.empresa = :empresa")
                           ->setParameters(array("empresa" => $context->getToken()->getUser()->getEmpresa()));
                  },
            ))
            ->add('vlrProduto', 'text', array(
                  'label' => "Valor",  
                  'attr' => array('placeholder' => 'Valor',
                                  'class' => 'moeda')
            ))
            ->add('limiteVendas', 'integer', array(
                  'label' => "Limite de Vendas", 
                  'attr' => array('placeholder' => 'Limite de Vendas')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\ProdutoListaPreco'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_produtoListatype';
    }
}
