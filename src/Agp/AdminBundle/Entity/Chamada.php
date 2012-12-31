<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agp\AdminBundle\Entity\Chamada
 *
 * @ORM\Table(name="chamada")
 * @ORM\Entity
 */
class Chamada
{
    /**
     * @var integer $codTerminal
     *
     * @ORM\Column(name="cod_terminal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $codTerminal;

    /**
     * @var integer $numChamadas
     *
     * @ORM\Column(name="num_chamadas", type="integer", nullable=false)
     */
    protected $numChamadas;

    /**
     * @var \DateTime $ultimaChamada
     *
     * @ORM\Column(name="ultima_chamada", type="datetime", nullable=false)
     */
    protected $ultimaChamada;



    /**
     * Get codTerminal
     *
     * @return integer 
     */
    public function getCodTerminal()
    {
        return $this->codTerminal;
    }

    /**
     * Set numChamadas
     *
     * @param integer $numChamadas
     * @return Chamada
     */
    public function setNumChamadas($numChamadas)
    {
        $this->numChamadas = $numChamadas;
    
        return $this;
    }

    /**
     * Get numChamadas
     *
     * @return integer 
     */
    public function getNumChamadas()
    {
        return $this->numChamadas;
    }

    /**
     * Set ultimaChamada
     *
     * @param \DateTime $ultimaChamada
     * @return Chamada
     */
    public function setUltimaChamada($ultimaChamada)
    {
        $this->ultimaChamada = $ultimaChamada;
    
        return $this;
    }

    /**
     * Get ultimaChamada
     *
     * @return \DateTime 
     */
    public function getUltimaChamada()
    {
        return $this->ultimaChamada;
    }
}