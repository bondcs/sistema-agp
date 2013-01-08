<?php

namespace Agp\AdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AgpAdminExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('produto.xml');
        $loader->load('lista.xml');
        $loader->load('produtoLista.xml');
        $loader->load('atendente.xml');
        $loader->load('evento.xml');
        $loader->load('terminal.xml');
        $loader->load('terminalEmpresa.xml');
        $loader->load('empresa.xml');
        $loader->load('habilitaProdutoTerminal.xml');
        $loader->load('empresaTerminal.xml');
        $loader->load('pessoa.xml');
        $loader->load('fornecedor.xml');
        $loader->load('entradaProduto.xml');
    }
}
