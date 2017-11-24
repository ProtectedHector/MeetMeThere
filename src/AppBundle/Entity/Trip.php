<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity()
 * @ORM\Table(name="trip")
 */
class Trip
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var Date
     *
     * @ORM\Column(type="date")
     */
    protected $fromDate;

    /**
     * @var Date
     *
     * @ORM\Column(type="date")
     */
    protected $toDate;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $confirmed;

    /**
     * @var Traveler
     *
     * @ORM\ManyToOne(targetEntity="Traveler", cascade="persist")
     */
    protected $traveler;

    /**
     * @var Collection|City[]
     *
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="City")
     */
    private $cities;

    /**
     * Trip constructor.
     */
    public function __construct() {
        $this->cities = new ArrayCollection();
    }

    /**
     * @param City $city
     */
    public function addCity(City $city)
    {
        if ($this->cities->contains($city)) {
            return ;
        }

        $this->cities->add($city);
        $city->addTrip($this);
    }

    /**
     * @param City $city
     */
    public function removeCity(City $city) {
        if (!$this->cities->contains($city)) {
            return ;
        }

        $this->cities->removeElement($city);
        $city->removeTrip($this);
    }
}