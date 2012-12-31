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
 * Description of FilterVendasGeralType
 *
 * @author bondcs
 */
class FilterVendasGeralType extends AbstractType{
    
    protected $rep;

    public function __construct($rep, $pessoa) {
        $this->rep = $rep;
        $this->pessoa = $pessoa;
    }

        public function buildForm(FormBuilderInterface $builder, array $options)
    {
            
        $fechamento = $this->rep->getFechamento($this->pessoa);
        $terminal = $this->rep->getTerminal($this->pessoa);
        $builder
            ->add('terminal', 'choice', array(
                'attr' => array("class" => "terminal"),
                'required' => false,
                'empty_value' => "Todos",
                'label' => 'Terminal',
                'choices' => $terminal['options'],
            ))
            ->add('grupo', 'choice', array(
                'attr' => array("class" => "grupo"),
                'required' => false,
                'choices'   => array(
                    'n'   => 'Não Agrupado',
                    't' => 'Terminal',
                    'p'   => 'Produto',
                ),
                'expanded' => true
            )) 
           ->add('fechamento', 'choice', array(
                'attr' => array("class" => "fechamento"),
                'required' => false,
                'empty_value' => "Todos",
                'label' => 'Fechamento',
                'choices' => $fechamento['options'],
                'data' => $fechamento['max']
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array();
    }

    public function getName()
    {
        return 'agp_adminbundle_filtervendasgeraltype';
    }
}

?>
