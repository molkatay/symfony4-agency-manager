<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
class PropertySearch{


    /*
     * @var int|null
     */
    private $maxPrice;
    /*
     * @var int|null
     * @Assert\Range(min=10, max=500)
     */
    private $minSurface;

    /*
     * @var ArrayCollection
     */
    private $options;

    /**
     * PropertySearch constructor.
     */
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * @param mixed $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     * @return PropertySearch
     */
    public function setOptions(ArrayCollection $options): PropertySearch
    {
        $this->options = $options;
        return $this;
    }


}