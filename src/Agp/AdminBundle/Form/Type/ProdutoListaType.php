<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Agp\AdminBundle\Form\Handler\ProdutoListaHandler;

use Doctrine\ORM\Query\Expr;

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
        $lista = $this->container->get("agp.lista.manager")->findById($this->options["lista"]);
        $optionsHandler = $this->options;
        
        $builder
            ->add("codProdutoListaPreco", "hidden")
            ->add('produto', 'entity', array(
                  'empty_value' => 'Selecione um produto',
                  'label' => "Nome:",
                  'attr' => array('placeholder' => 'Nome', 'class' => 'chzn-select produto'),
                  'class' => "AgpAdminBundle:Produto",
                  'query_builder' => function(EntityRepository $er) use ($context, $optionsHandler, $lista){
                   if ($optionsHandler['estrategia'] == ProdutoListaHandler::UPDATE){
                       return $er->createQueryBuilder('p')
                           ->select("p")
                           ->where("p.empresa = :empresa")
                           ->setParameters(array("empresa" => $context->getToken()->getUser()->getEmpresa()));
                   }
                   
                   return $er->createQueryBuilder('p')
                           ->select("p")
                           ->leftJoin('p.produtoReference', 'plp', "WITH", "plp.listaPreco = :lista")
                           ->where("p.empresa = :empresa")
                           ->andWhere("plp.listaPreco is NULL")
                           ->setParameters(array("empresa" => $context->getToken()->getUser()->getEmpresa(),
                                                 "lista" => $lista
                                                 ));
                  },
            ))
            ->add('vlrProduto', 'text', array(
                  'label' => "Valor:",  
                  'attr' => array('placeholder' => 'Valor',
                                  'class' => 'moeda valor')
            ))
            ->add('limiteVendas', 'integer', array(
                  'label' => "Limite de Vendas: (opcional)", 
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
