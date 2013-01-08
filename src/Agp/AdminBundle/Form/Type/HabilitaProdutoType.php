<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Type;

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
class HabilitaProdutoType extends AbstractType{
    
    protected $user;
    protected $terminalEmpresa;


    public function __construct($user, $terminalEmpresa = null) {
        $this->user = $user;
        $this->terminalEmpresa = $terminalEmpresa;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $user = $this->user;
        $data = null;
        
        if ($this->terminalEmpresa != null){
            if (!$this->terminalEmpresa->getHabilitaProdutoTerminalList()->isEmpty()){
                $data = $this->terminalEmpresa->getHabilitaProdutoTerminalList()->get(0)->getProdutoListaPreco()->getListaPreco();
            }
        }
        
        $builder
            ->add('lista', 'entity', array(
                'attr' => array("class" => "lista"),
                'required' => false,
                'empty_value' => "Selecione uma lista",
                'label' => 'Lista de preços:',
                'class' => "AgpAdminBundle:ListaPreco",
                'property' => 'nome',
                'query_builder' => function(EntityRepository $er) use ($user){
                       return $er->createQueryBuilder('l')
                           ->Where("l.empresa = :empresa")
                           ->setParameters(array("empresa" => $user->getEmpresa()));
                },
                'data' => $data,
            ))
            ->add('terminais', 'entity', array(
                'attr' => array("class" => "terminais", "checked" => "checked"),
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'empty_value' => "Selecione os terminais",
                'label' => 'Lista de terminais:',
                'class' => "AgpAdminBundle:TerminalEmpresa",
                'query_builder' => function(EntityRepository $er) use ($user){
                       return $er->createQueryBuilder('te')
                           ->Where("te.empresa = :empresa")
                           ->andWhere("te.situacao = :situacao")
                           ->setParameters(array("empresa" => $user->getEmpresa(),
                                                 "situacao" => TerminalEmpresa::SIT_ATIVO));
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
