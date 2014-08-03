<?php

namespace Webgig\FridgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 */
class Item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
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
     * @var \DateTime
     */
    private $use_by;


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
     * @param string $item
     * @return Item
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Item
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
     * @return Item
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

    /**
     * Set use_by
     *
     * @param \DateTime $useBy
     * @return Item
     */
    public function setUseBy($use_by)
    {
        $this->use_by = $use_by;

        return $this;
    }

    /**
     * Get use_by
     *
     * @return \DateTime
     */
    public function getUseBy()
    {
        return $this->use_by;
    }
}
