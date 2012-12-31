<?php

namespace Agp\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Agp\AdminBundle\Entity\Pessoa;
use Agp\AdminBundle\Form\Handler\PessoaHandler;

class PessoaType extends AbstractType
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
            ->add('nome', 'text', array(
                  'label' => "Nome",  
                  'attr' => array('placeholder' => 'Nome')
            ))
            ->add('cpf', 'text', array(
                  'label' => "Cpf",  
                  'attr' => array('placeholder' => 'cpf', 'class' => 'cpf')
            ))
            ->add('rg', 'text', array(
                  'label' => "Rg",  
                  'attr' => array('placeholder' => 'Rg')
            ))
            ->add('dtNascimento', 'date', array(
                        'attr' => array("class" => "datepicker"),
                        'label' => 'Data de Nascimento',
                        'input' => 'datetime',
                        'widget' => 'single_text',
                        'required' => true,
                        'format' => 'dd/MM/yyyy'
             ))
             ->add('email', 'email', array(
                  'label' => "Email",  
                  'attr' => array('placeholder' => 'Email')
             )) 
//            ->add('senha', 'repeated', array(
//                'type' => 'password',
//                'invalid_message' => 'As senhas não combinam.',
//                'options' => array('always_empty' => false),
//                'required' => true,
//                'first_options'  => array('label' => 'Senha'),
//                'second_options' => array('label' => 'Repita a senha'),
//            ))
            ->add('grupos', 'entity', array(
                  'label' => 'Permissão', 
                  'class' => 'AgpAdminBundle:Grupo',
                  'property' => 'Nome',
                  'attr' => array('class' => 'chzn-select','data-placeholder' => "Escolha as permissões"),
                  'multiple' => true
            ))
        ;
        
        if ($this->options["estrategia"] == PessoaHandler::INSERT){
            $builder->add('senha', 'password', array(
                  'label' => "Senha",  
                  'always_empty' => false,
            ));
        }
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Agp\AdminBundle\Entity\Pessoa'
        ));
    }

    public function getName()
    {
        return 'agp_adminbundle_pessoatype';
    }
}
