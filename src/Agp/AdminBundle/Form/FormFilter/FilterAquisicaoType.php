<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\FormFilter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Agp\AdminBundle\Entity\TerminalEmpresa;

/**
 * Description of HabilitaProdutoType
 *
 * @author bondcs
 */
class FilterAquisicaoType extends AbstractType{
    
    protected $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $user = $this->user;
        $builder
            ->add('produto', 'entity', array(
                'attr' => array("class" => "produto"),
                'required' => false,
                'empty_value' => "Produtos",
                'label' => 'Produtos:',
                'class' => "AgpAdminBundle:Produto",
                'property' => 'nome',
                'query_builder' => function(EntityRepository $er) use ($user){
                       return $er->createQueryBuilder('p')
                           ->Where("p.empresa = :empresa")
                           ->setParameters(array("empresa" => $user->getEmpresa()));
                },
            ))
            ->add('fornecedor', 'entity', array(
                'attr' => array("class" => "fornecedor"),
                'required' => false,
                'empty_value' => "Fornecedores",
                'label' => 'Fornecedores:',
                'class' => "AgpAdminBundle:Fornecedor",
                'property' => 'razaoSocial',
                'query_builder' => function(EntityRepository $er) use ($user){
                       return $er->createQueryBuilder('f')
                           ->Where("f.empresa = :empresa")
                           ->setParameters(array("empresa" => $user->getEmpresa()));
                },
            ))
            ->add('dtInicio', 'date', array(
                        'attr' => array("class" => "datepicker dtInicio"),
                        'label' => 'Início:',
                        'input' => 'datetime',
                        'widget' => 'single_text',
                        'required' => true,
                        'format' => 'dd/MM/yyyy',
                        'data' => new \Datetime("-1 month"),
                        
             ))
            ->add('dtTermino', 'date', array(
                        'attr' => array("class" => "datepicker dtTermino"),
                        'label' => 'Término:',
                        'input' => 'datetime',
                        'widget' => 'single_text',
                        'required' => true,
                        'format' => 'dd/MM/yyyy',
                        'data' => new \Datetime("+1 days"),
             ))
        ;
                
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array();
    }

    public function getName()
    {
        return 'agp_adminbundle_filteraquisicaotype';
    }
}

?>
