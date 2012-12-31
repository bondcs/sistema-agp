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

/**
 * Description of HabilitaProdutoType
 *
 * @author bondcs
 */
class HabilitaProdutoType extends AbstractType{
    
    protected $user;
    
    public function __construct($user) {
        $this->user = $user;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $user = $this->user;
        $builder
            ->add('lista', 'entity', array(
                'attr' => array("class" => "lista"),
                'required' => false,
                'empty_value' => "Selecione uma lista",
                'label' => 'Lista de preços',
                'class' => "AgpAdminBundle:ListaPreco",
                'property' => 'nome',
                'query_builder' => function(EntityRepository $er) use ($user){
                       return $er->createQueryBuilder('l')
                           ->Where("l.empresa = :empresa")
                           ->setParameters(array("empresa" => $user->getEmpresa()));
                },
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array();
    }

    public function getName()
    {
        return 'agp_adminbundle_habilitaprodutotype';
    }
}

?>
