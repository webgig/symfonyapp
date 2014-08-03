<?php

namespace Webgig\FridgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 */
class Ingredient
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \stdClass
     */
    private $item;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var string
     */
    private $unit;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set item
     *
     * @param \stdClass $item
     * @return Ingredient
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \stdClass 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Ingredient
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return Ingredient
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
